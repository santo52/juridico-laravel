<?php

namespace App\Http\Controllers;

use App\Entities\Usuario;
use App\Entities\EntidadJusticia;
use App\Entities\TipoProceso;
use App\Entities\EtapaProceso;
use Illuminate\Http\Request;

class GestionOrganizacionalReportController extends Controller
{
    public function index() {

        $responsables = Usuario::where([ 'eliminado' => 0, 'estado_usuario' => '1'])->get();
        $entidades = EntidadJusticia::where('eliminado', 0)->get();
        $tiposProceso = TipoProceso::where('eliminado', 0)->get();
        $etapasProceso = EtapaProceso::where('eliminado', 0)->get();
        return $this->renderSection('reportes.gestion_organizacional.listar', [
            'responsables' => $responsables,
            'entidades' => $entidades,
            'tiposProceso' => $tiposProceso,
            'etapasProceso' => $etapasProceso,
        ]);
    }

    public function pdf(Request $request) {
        $pdf = \PDF::loadView('reportes.gestion_organizacional.pdf', ['request' => $request->all()])->setPaper('a4', 'landscape');
        return $pdf->download('informe_gestion_organizacional.pdf');
    }

    public function html() {
        return view('reportes.gestion_organizacional.pdf');
    }
}
