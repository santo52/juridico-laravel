<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadoCuentaReportController extends Controller
{
    public function index() {
        return $this->renderSection('reportes.estado_cuenta_procesos.listar', [
            'resultados' => []
        ]);
    }
}
