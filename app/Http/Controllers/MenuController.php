<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Menu;
use Illuminate\Support\Facades\Auth;
use App\Entities\Accion;

class MenuController extends Controller
{
    public function index() {
        $parents = Menu::getMenuWithChildren('orden_menu')->toHuman();
        return $this->renderSection('menu.listar', [
            'parents' => $parents
        ]);
    }

    public function getParents() {
        $parents = Menu::where([
            ['estado', 1],
            ['parent_id', 0]
        ])->get();

        return response()->json([
            'parents' => $parents
        ]);
    }

    public function get($id) {
        $menu = Menu::find($id);
        $acciones = Accion::where([
            'id_menu' => $id,
            'eliminado' => 0
        ])->get();
        $menu['acciones'] = $acciones;
        return response()->json($menu);
    }

    private function getMenu($id, $name) {

        if($id) {
            $type = 'update';
            $menus = Menu::where([
                ['id_menu', '<>',  $id],
                ['nombre_menu', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $menus = Menu::where('nombre_menu', $name);
        }

        return [
            'exists' => $menus->exists(),
            'menus' => $menus->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_menu');
        $name = $request->get('nombre_menu');
        $menu = $this->getMenu($id, $name);
        $data = $request->all();
        $data['estado'] = empty($data['estado']) ? 0 : 1;

        if ($menu['exists']) {

            $menus = $menu['menus'];
            if($menu['type'] === 'update' || $menus->estado === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado'] = 1;
            $data['id_menu'] = $menus->id_menu;
            $id = $menus->id_menu;
        }

        $data['id_usuario_actualizacion'] = Auth::id();
        if(empty($data['parent_id'])) {
            $data['parent_id'] = 0;
        }

        if (!$id) {
            $data['id_usuario_creacion'] = Auth::id();
        }

        $data['ruta_menu'] = $data['parent_id'] !== 0 ? $data['ruta_menu'] : '';
        $saved = Menu::updateOrCreate(['id_menu' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }

    public function delete($id) {
        $menu = Menu::find($id);
        $menu->estado = 0;
        $deleted = $menu->save();
        return response()->json(['deleted' => $deleted, $menu]);
    }

}
