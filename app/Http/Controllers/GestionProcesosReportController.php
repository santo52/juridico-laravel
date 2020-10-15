<?php

namespace App\Http\Controllers;

use App\Entities\Actuacion;
use App\Entities\EntidadJusticia;
use App\Entities\EtapaProceso;
use App\Entities\TipoProceso;
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
        return response()->json($request->all());
    }

    public function excel(Request $request) {
        return response()->json($request->all());
    }

    public function templates() {
        return view('reportes.gestion_procesos_activos.pdf', []);
    }
}
