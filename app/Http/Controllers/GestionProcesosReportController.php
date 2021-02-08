<?php

namespace App\Http\Controllers;

use App\Entities\Actuacion;
use App\Entities\EntidadJusticia;
use App\Entities\EtapaProceso;
use App\Entities\TipoProceso;
use Facade\FlareClient\View;
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
        $etapas = EtapaProceso::where('eliminado', 0)->get();
        $pdf = \PDF::loadView('reportes.gestion_procesos_activos.pdf', ["etapas" => $etapas, 'request' => $request->all()])->setPaper('a4', 'landscape');
        return $pdf->download('informe_gestion_procesos_activos.pdf');
    }

    public function html() {
        return view('reportes.gestion_procesos_activos.pdf');
    }
}
