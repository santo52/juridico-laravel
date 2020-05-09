<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\EtapaProceso;
use App\Entities\Actuacion;
use App\Entities\ActuacionEtapaProceso;
use Illuminate\Support\Facades\Auth;

class EtapaProcesoController extends Controller {

    public function index() {
        $etapasProceso = EtapaProceso::where('eliminado', 0)->get();
        return $this->renderSection('etapaproceso.listar', [
            'etapas' => $etapasProceso
        ]);
    }

    public function detalle($id) {
        $etapaProceso = EtapaProceso::find($id);

        $selectedActuaciones = ActuacionEtapaProceso::
            leftjoin('actuacion as a', 'a.id_actuacion', 'actuacion_etapa_proceso.id_actuacion')
            ->where([ 'id_etapa_proceso' => $id])
            ->orderBy('actuacion_etapa_proceso.order')
            ->get();

        $selectedActuacionesID = [];

        foreach($selectedActuaciones as $value) {
            $selectedActuacionesID[] = $value->id_actuacion;
        }

        $actuaciones = Actuacion::
        whereNotIn('id_actuacion', $selectedActuacionesID)
        ->where('estado_actuacion', 1)->get();

        return $this->renderSection('etapaproceso.detalle', [
            'etapaProceso' => $etapaProceso,
            'selectedActuaciones' => $selectedActuaciones,
            'actuaciones' => $actuaciones
        ]);
    }

    public function get($id) {
        $etapaProceso = EtapaProceso::find($id);

        $selectedActuaciones = ActuacionEtapaProceso::
            leftjoin('actuacion as a', 'a.id_actuacion', 'actuacion_etapa_proceso.id_actuacion')
            ->where([ 'id_etapa_proceso' => $id])
            ->orderBy('actuacion_etapa_proceso.order')
            ->get();

        $selectedActuacionesID = [];

        foreach($selectedActuaciones as $value) {
            $selectedActuacionesID[] = $value->id_actuacion;
        }

        $actuaciones = Actuacion::
        whereNotIn('id_actuacion', $selectedActuacionesID)
        ->where('estado_actuacion', 1)->get();

        return response()->json([
            'etapaProceso' => $etapaProceso,
            'selectedActuaciones' => $selectedActuaciones,
            'actuaciones' => $actuaciones
        ]);
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
        $name = strtoupper($request->get('nombre_etapa_proceso'));
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

        $data['id_usuario_actualizacion'] = Auth::id();
        if(empty($id)) {
            $data['id_usuario_creacion'] = Auth::id();
        }

        $saved = EtapaProceso::updateOrCreate(['id_etapa_proceso' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }
}
