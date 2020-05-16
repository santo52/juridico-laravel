<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\EntidadDemandada;

class EntidadDemandadaController extends Controller
{

    public function index() {
        $entidades = EntidadDemandada::where('eliminado', 0)->get();
        return $this->renderSection('entidad_demandada.listar', [
            'entidades' => $entidades
        ]);
    }

    public function get($id) {
        $entidad = EntidadDemandada::find($id);
        return response()->json([ 'entidadDemandada' => $entidad ]);
    }

    public function delete($id) {
        $entidad = EntidadDemandada::find($id);
        $deleted = $entidad->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function getEntidad($id, $name) {
        if($id) {
            $type = 'update';
            $entidades = EntidadDemandada::where([
                ['id_entidad_demandada', '<>',  $id],
                ['nombre_entidad_demandada', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $entidades = EntidadDemandada::where('nombre_entidad_demandada', $name);
        }

        return [
            'exists' => $entidades->exists(),
            'entidades' => $entidades->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_entidad_demandada');
        $name = $request->get('nombre_entidad_demandada');
        $entidad = $this->getEntidad($id, $name);
        $data = $request->all();
        $data['nombre_entidad_demandada'] = $name;
        $data['estado_entidad_demandada'] = empty($data['estado']) ? 2 : 1;

        if ($entidad['exists']) {

            $entidades = $entidad['entidades'];
            if($entidad['type'] === 'update' || $entidades->estado_entidad_demandada === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_entidad_demandada'] = 1;
            $data['id_entidad_demandada'] = $entidades->id_entidad_demandada;
            $id = $entidades->id_entidad_demandada;
        }

        $data['id_usuario_actualizacion'] = Auth::id();
        if(empty($id)) {
            $data['id_usuario_creacion'] = Auth::id();
        }

        $saved = EntidadDemandada::updateOrCreate(['id_entidad_demandada' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }
}
