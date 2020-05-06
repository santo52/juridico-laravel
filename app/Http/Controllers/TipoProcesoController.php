<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\TipoProceso;

class TipoProcesoController extends Controller {
    public function index() {

        $tiposProceso = TipoProceso::where('eliminado', 0)->get();
        return $this->renderSection('tipoproceso.listar', [
            'tiposProceso' => $tiposProceso
        ]);
    }
}
