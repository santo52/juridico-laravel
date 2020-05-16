<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\Proceso;

class ProcesoController extends Controller
{
    public function index() {
        $procesos = Proceso::
            leftjoin('tipo_proceso as tp', 'tp.id_tipo_proceso', 'proceso.id_tipo_proceso')
            ->leftjoin('entidad_demandada as ed', 'ed.id_entidad_demandada', 'proceso.id_entidad_demandada')
            ->leftjoin('municipio as m', 'm.id_municipio', 'proceso.id_municipio')
            // ->leftjoin('entidad_justicia as ej', 'ej.id_entidad_justicia', 'proceso.id_ultima_entidad_servicio')
            ->leftjoin('usuario as u', 'u.id_usuario', 'proceso.id_usuario_responsable')
            ->leftjoin('cliente as c', 'c.id_cliente', 'proceso.id_cliente')
            ->leftjoin('persona as p', 'p.id_persona', 'c.id_persona')
            ->get();

        return $this->renderSection('proceso.listar', [
            'procesos' => $procesos
        ]);
    }
}
