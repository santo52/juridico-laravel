<?php

namespace App\Http\Controllers;

use App\Entities\Actuacion;
use App\Entities\EntidadJusticia;
use App\Entities\EtapaProceso;
use App\Entities\TipoProceso;
use App\Entities\TipoResultado;
use App\Entities\Proceso;
use Illuminate\Http\Request;

class GestionProcesosReportController extends Controller
{
    public function index() {
        $entidades = EntidadJusticia::where('eliminado', 0)->get();
        $tiposProceso = TipoProceso::where('eliminado', 0)->get();
        $actuaciones = Actuacion::where('eliminado', 0)->get();
        $etapasProceso = EtapaProceso::where('eliminado', 0)->get();
        return $this->renderSection('reportes.gestion_procesos_activos.listar', [
            'entidades' => $entidades,
            'tiposProceso' => $tiposProceso,
            'actuaciones' => $actuaciones,
            'etapasProceso' => $etapasProceso
        ]);
    }

    public function pdf(Request $request) {
        $tiposResultado = TipoResultado::where('eliminado', 0)->get();
        $procesos = Proceso::getAll()->where('estado_proceso', '1')->get();
        foreach($procesos as $key => $proceso) {
            $etapas = TipoProceso::getEtapas($proceso->id_tipo_proceso)->get();
            foreach ($etapas as $key2 => $value) {
                $actuaciones = EtapaProceso::getActuaciones($value->id_etapa_proceso)->get();
                $value->actuaciones = $actuaciones;
                $etapas[$key2] = SeguimientoProcesoController::addProcesoEtapa($proceso->id_proceso, $value);
            }
            $procesos[$key]->etapas = $etapas;
        }

        $tiposActuacion = [
            1 => 'Interno',
            2 => 'Externo',
            3 => 'Rama'
        ];

        $responsable = [
            1 => 'Recepción',
            2 => 'Administración',
            3 => 'Agotamientos de via',
            4 => 'Sustantación',
            5 => 'Dependencia',
            6 => 'Mensajeria'
        ];

        $pdf = \PDF::loadView('reportes.gestion_procesos_activos.pdf', [
            'procesos' => $procesos,
            'tiposResultado' => $tiposResultado,
            'tiposActuacion' => $tiposActuacion,
            'responsable' => $responsable,
            'request' => $request->all()
        ])->setPaper('a4', 'landscape');
        return $pdf->download('informe_gestion_procesos_activos.pdf');
    }

    public function html() {
        $tiposResultado = TipoResultado::where('eliminado', 0)->get();
        $procesos = Proceso::getAll()->where('estado_proceso', '1')->get();
        foreach($procesos as $key => $proceso) {
            $etapas = TipoProceso::getEtapas($proceso->id_tipo_proceso)->get();
            foreach ($etapas as $key2 => $value) {
                $actuaciones = EtapaProceso::getActuaciones($value->id_etapa_proceso)->get();
                $value->actuaciones = $actuaciones;
                $etapas[$key2] = SeguimientoProcesoController::addProcesoEtapa($proceso->id_proceso, $value);
            }
            $procesos[$key]->etapas = $etapas;
        }

        $tiposActuacion = [
            1 => 'Interno',
            2 => 'Externo',
            3 => 'Rama'
        ];

        $responsable = [
            1 => 'Recepción',
            2 => 'Administración',
            3 => 'Agotamientos de via',
            4 => 'Sustantación',
            5 => 'Dependencia',
            6 => 'Mensajeria'
        ];

        // return response()->json($procesos);

        return view('reportes.gestion_procesos_activos.pdf', [
            'procesos' => $procesos,
            'tiposResultado' => $tiposResultado,
            'tiposActuacion' => $tiposActuacion,
            'responsable' => $responsable
        ]);
    }
}
