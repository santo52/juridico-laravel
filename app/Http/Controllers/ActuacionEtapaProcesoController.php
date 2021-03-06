<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\ActuacionEtapaProceso;
use App\Entities\Actuacion;
use App\Entities\EtapaProceso;
use Illuminate\Support\Facades\Auth;

class ActuacionEtapaProcesoController extends Controller
{

    public function index() {
        $actuacionEtapasProceso = ActuacionEtapaProceso::


        where('eliminado', 0)->get();



        return $this->renderSection('actuacionetapaproceso.listar', [
            'etapas' => $actuacionEtapasProceso
        ]);
    }

    public function get($id) {
        $etapaProceso = EtapaProceso::find($id);
        return response()->json([ 'etapaProceso' => $etapaProceso ]);
    }

    public function delete($id) {
        $etapaProceso = EtapaProceso::find($id);
        $deleted = $etapaProceso->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function getEtapa($id, $name) {
        if($id) {
            $type = 'update';
            $etapas = EtapaProceso::where([
                ['id_etapa_proceso', '<>',  $id],
                ['nombre_etapa_proceso', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $etapas = EtapaProceso::where('nombre_etapa_proceso', $name);
        }

        return [
            'exists' => $etapas->exists(),
            'etapas' => $etapas->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_etapa_proceso');
        $name = $request->get('nombre_etapa_proceso');
        $etapa = $this->getEtapa($id, $name);
        $data = $request->all();
        $data['nombre_etapa_proceso'] = $name;
        $data['estado_etapa_proceso'] = empty($data['estado']) ? 2 : 1;

        if ($etapa['exists']) {

            $etapas = $etapa['etapas'];
            if($etapa['type'] === 'update' || $etapas->estado_etapa_proceso === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_etapa_proceso'] = 1;
            $data['id_etapa_proceso'] = $etapas->id_etapa_proceso;
            $id = $etapas->id_etapa_proceso;
        }

        $saved = EtapaProceso::updateOrCreate(['id_etapa_proceso' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }
}
