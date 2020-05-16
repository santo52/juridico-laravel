<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Perfil;
use App\Entities\Menu;
use App\Entities\MenuPerfil;

use App\Entities\AccionMenuPerfil;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index() {
        $perfil = new Perfil;
        $list = $perfil->where([
            ['id_perfil', '<>', 1],
            ['eliminado', 0]
        ])->orderBy('id_perfil', 'desc')->get();


        return $this->renderSection('perfil.listar', [
            'perfiles' => $list
        ]);
    }

    public function get($id) {

        $perfil = Perfil::find($id);

        $menus = Menu::where([
            ['parent_id', '<>', 0],
            ['estado', 1]
        ])->whereNotIn('id_menu',
            MenuPerfil::where('id_perfil', $id)->pluck('id_menu')
        )->get();

        $selectedMenus = MenuPerfil::getByProfile($id)->getWithActions();
        return response()->json([
            'menus' => $menus,
            'selectedMenus' => $selectedMenus,
            'perfil' => $perfil
        ]);
    }

    private function getPerfil($id, $name) {

        if ($id) {
            $type = 'update';
            $perfiles = Perfil::where([
                ['id_perfil', '<>', $id],
                ['nombre_perfil', '=', $name],
            ]);
        }
        else {
            $type = 'create';
            $perfiles = Perfil::where('nombre_perfil', $name);
        }

        return [
            'exists' => $perfiles->exists(),
            'perfil' => $perfiles->first(),
            'type' => $type
        ];
    }

    public function create(Request $request) {
        $data = $request->all();

        $id = $request->get('id_perfil');
        $data['nombre_perfil'] = $request->get('nombre_perfil');
        $perfil = $this->getPerfil($id, $data['nombre_perfil']);
        $data['inactivo'] = empty($data['estado']) ? 1 : 2;
        $data['eliminado'] = 0;

        if ($perfil['exists']) {

            $perfil = $perfil['perfil'];
            if ($perfil['type'] === 'update' || $perfil->inactivo === 0) {
                return response()->json(['exists' => true]);
            }

            $data['inactivo'] = 2;
            $data['id_perfil'] = $perfil->id_perfil;
            $id = $perfil->id_perfil;
        }

        if (empty($id)) {
            $data['id_usuario_creacion'] = Auth::id();
        }
        $data['id_usuario_actualizacion'] = Auth::id();
        $saved = Perfil::updateOrCreate(['id_perfil' => $id], $data);

        MenuPerfil::where([
            'id_perfil' => 0,
            'id_usuario_creacion' => Auth::id()
        ])->update(['id_perfil' => $saved->id_perfil]);

        return response()->json([$saved, $data]);
    }

    public function delete($id) {
        $updated = Perfil::find($id)->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $updated ]);
    }

    public function insertMenu(Request $request) {
        $data = $request->all();

        $data['id_usuario_creacion'] = Auth::id();
        $data['id_usuario_actualizacion'] = Auth::id();
        $menuPerfil = MenuPerfil::create($data);
        $saved = $menuPerfil->save();

        return response()->json([
            'saved' => $saved
        ]);
    }

    public function deleteMenu($id) {
        $menuPerfil = MenuPerfil::find($id);
        $deleted = $menuPerfil->delete();

        if ($deleted) {
            AccionMenuPerfil::
                where('id_menu_perfil', $id)
                ->delete();
        }

        $menuItem = Menu::find($menuPerfil->id_menu);
        return response()->json([
            'deleted' => $deleted,
            'menuItem' => $menuItem
        ]);
    }

    public function addOrRemovePermission(Request $request) {
        $data = [
            'id_menu_perfil' => $request->get('id_menu_perfil'),
            'id_accion' => $request->get('id_accion')
        ];

        if ($request->get('add') === 'true') {
            $accionMenuPerfil = AccionMenuPerfil::create($data);
            $accionMenuPerfil->save();
        }
        else {
            $accionMenuPerfil = AccionMenuPerfil::where($data);
            $accionMenuPerfil->delete();
        }

        return response()->json(['saved' => true]);
    }
}
