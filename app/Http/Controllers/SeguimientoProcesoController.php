<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entities\Proceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\TipoProceso;
use App\Entities\EtapaProceso;
use App\Entities\Usuario;


class SeguimientoProcesoController extends Controller
{
    public function index()
    {
        $procesos = Proceso::getAll()->orderBy('id_proceso', 'desc')->get();
        return $this->renderSection('proceso.listar', [
            'procesos' => $procesos,
            'seguimiento' => true
        ]);
    }

    public function setEtapa(Request $request)
    {
        $proceso = Proceso::find($request->get('id_proceso'));
        $data = $proceso->createFirstActuacion();
        if ($data) $proceso->update(['id_etapa_proceso' => $request->get('id_etapa_proceso')]);
        return response()->json(['proceso_etapa_actuacion' => $data]);
    }

    public function detalle($id)
    {
        $proceso = Proceso::get($id);
        if (empty($proceso)) {
            return response()->json(['redirect' => 'seguimiento-procesos']);
        }

        $etapas = TipoProceso::getEtapas($proceso->id_tipo_proceso)->get();

        foreach ($etapas as $key => $value) {
            $actuaciones = EtapaProceso::getActuaciones($value->id_etapa_proceso)->get();
            $value->actuaciones = $actuaciones;
            $etapas[$key] = $this->addProcesoEtapa($proceso->id_proceso, $value);
        }

        return $this->renderSection('seguimiento_proceso.detalle', [
            'proceso' => $proceso,
            'etapas' => $etapas
        ]);
    }

    private function addProcesoEtapa($id_proceso, $etapa)
    {

        $hasData = false;
        $procesoEtapa = ProcesoEtapa::where([
            'id_proceso' => $id_proceso,
            'id_etapa_proceso' => $etapa->id_etapa_proceso
        ])->first();

        $actuaciones = $etapa->actuaciones;

        if (!empty($procesoEtapa)) {
            $etapa->porcentaje = $procesoEtapa->porcentaje;
            $hasData = true;
            foreach ($actuaciones as $key => $actuacion) {
                $actuaciones[$key] = $this->addProcesoEtapaActuacion($procesoEtapa->id_proceso_etapa, $actuacion);
            }
        }

        $etapa->actuaciones = $actuaciones;
        $etapa->hasData =  $hasData;
        return $etapa;
    }

    private function addProcesoEtapaActuacion($id_proceso_etapa, $actuacion)
    {
        $hasData = false;
        $actuacion->fechaInicio = 'Sin iniciar';
        $actuacion->fechaVencimiento = 'Sin iniciar';
        $actuacion->fechaFin = 'Sin iniciar';
        $actuacion->responsable = 'Sin asignar';
        $actuacion->estado = 'Pendiente';

        $procesoEtapaActuacion = ProcesoEtapaActuacion::where([
            'id_proceso_etapa' => $id_proceso_etapa,
            'id_actuacion' => $actuacion->id_actuacion
        ])->first();

        if (!empty($procesoEtapaActuacion)) {
            $hasData = true;
            $actuacion->procesoEtapaActuacion = $procesoEtapaActuacion;
            $actuacion->tiempoMaximo = $actuacion->getTiempoMaximo();
            $actuacion->responsable = $procesoEtapaActuacion->getResponsable();
            $actuacion->fechaInicio = $procesoEtapaActuacion->getFechaInicioString();
            $actuacion->fechaVencimiento = $procesoEtapaActuacion->getFechaVencimientoString();
            $actuacion->fechaFin = $procesoEtapaActuacion->getFechaFinString();
            $actuacion->estado = $procesoEtapaActuacion->getEstado();
        }

        $actuacion->hasData = $hasData;
        return $actuacion;
    }

    // 23 caracteres id proceso
    /**
     * 12 caracteres id carpeta
     *
     * actuaciones
     *
     * rojo: desde el dia de vencimiento hacia atras
     * verde: 0% hasta el 75%;
     * amarillo: 76% al día anterior.
     * terminado en gris,
     */
}
