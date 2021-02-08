<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Usuario;
use App\Entities\Intermediario;
use App\Entities\TipoProceso;

class HonorariosGastosReportController extends Controller
{
    public function index() {
        $clientes = Usuario::where([ 'eliminado' => 0, 'estado_usuario' => '1'])->get();
        $intermediarios = Intermediario::where([ 'eliminado' => 0, 'estado_intermediario' => '1'])->get();
        $tiposProceso = TipoProceso::where('eliminado', 0)->get();
        return $this->renderSection('reportes.honorarios_gastos_procesales.listar', [
            'tiposProceso' => $tiposProceso,
            'intermediarios' => $intermediarios,
            'clientes' => $clientes,
        ]);
    }

    public function pdf(Request $request) {
        $pdf = \PDF::loadView('reportes.honorarios_gastos_procesales.pdf', [
            'request' => $request->all()
        ])->setPaper('a4', 'landscape');
        return $pdf->download('honorarios_gastos_procesales.pdf');
    }

    public function html() {
        return view('reportes.honorarios_gastos_procesales.pdf');
    }
}
