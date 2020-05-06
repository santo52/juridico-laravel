<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Intermediario;
use Illuminate\Support\Facades\Auth;

class IntermediarioController extends Controller
{
    public function index() {
        $intermediarios = Intermediario::where('eliminado', 0)->get();
        return $this->renderSection('intermediario.listar', [
            'entidades' => $intermediarios
        ]);
    }

    public function get($id) {
        $intermediario = Intermediario::find($id);
        return response()->json([ 'intermediario' => $intermediario ]);
    }

    public function delete($id) {
        $intermediario = Intermediario::find($id);
        $deleted = $intermediario->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function getEntidad($id, $name) {
        if($id) {
            $type = 'update';
            $intermediarios = Intermediario::where([
                ['id_entidad_justicia', '<>',  $id],
                ['nombre_entidad_justicia', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $intermediarios = Intermediario::where('nombre_entidad_justicia', $name);
        }

        return [
            'exists' => $intermediarios->exists(),
            'entidades' => $intermediarios->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_entidad_justicia');
        $name = strtoupper($request->get('nombre_entidad_justicia'));
        $intermediario = $this->getEntidad($id, $name);
        $data = $request->all();
        $data['nombre_entidad_justicia'] = $name;
        $data['estado_entidad_justicia'] = empty($data['estado']) ? 2 : 1;

        if ($intermediario['exists']) {

            $intermediarios = $intermediario['entidades'];
            if($intermediario['type'] === 'update' || $intermediarios->estado_entidad_justicia === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_entidad_justicia'] = 1;
            $data['id_entidad_justicia'] = $intermediarios->id_entidad_justicia;
            $id = $intermediarios->id_entidad_justicia;
        }

        $data['aplica_primera_instancia'] = empty($data['primera_instancia']) ? 2 : 1;
        $data['aplica_segunda_instancia'] = empty($data['segunda_instancia']) ? 2 : 1;
        $data['id_usuario_actualizacion'] = Auth::id();
        if(empty($id)) {
            $data['id_usuario_creacion'] = Auth::id();
        }

        $saved = Intermediario::updateOrCreate(['id_entidad_justicia' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }
}
