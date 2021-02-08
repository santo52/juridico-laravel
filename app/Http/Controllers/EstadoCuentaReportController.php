<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Entities\Cliente;
use \App\Entities\TipoProceso;
use \App\Entities\Actuacion;

class EstadoCuentaReportController extends Controller
{
    public function index() {
        $clientes = Cliente::where('eliminado', 0)->get();
        $tiposProceso = TipoProceso::where('eliminado', 0)->get();
        $actuaciones = Actuacion::where('eliminado', 0)->get();
        return $this->renderSection('reportes.estado_cuenta_procesos.listar', [
            'clientes' => $clientes,
            'tiposProceso' => $tiposProceso,
            'actuaciones' => $actuaciones
        ]);
    }

    public function pdf(Request $request) {
        $pdf = \PDF::loadView('reportes.estado_cuenta_procesos.pdf', ['request' => $request->all()])->setPaper('a4', 'landscape');
        return $pdf->download('informe_estado_cuenta_procesos.pdf');
    }

    public function html() {
        return view('reportes.estado_cuenta_procesos.pdf');
    }
}
