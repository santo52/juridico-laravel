<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\UsuarioContrato;

class UsuarioContratoController extends Controller
{
    public function getAll($id) {
        $usuarioContratos = UsuarioContrato::where('id_usuario', $id)->orderBy('fecha_inicio', 'ASC')->get();
        foreach($usuarioContratos as $key => $value) {
            $usuarioContratos[$key]->tipo_contrato = $value->getTipoContrato();
            $usuarioContratos[$key]->fecha_inicio = $value->getFechaInicio();
            $usuarioContratos[$key]->fecha_fin = $value->getFechaFin();
        }
        return response()->json([
            'contratos' => $usuarioContratos,
            'permissions' => parent::getPermissions()
        ]);
    }

    public function get($id) {
        $usuarioContrato = UsuarioContrato::find($id);
        return response()->json([
            'contrato' => $usuarioContrato
        ]);
    }

    public function upsert(Request $request) {
        $id_usuario_contrato = $request->get('id_usuario_contrato');
        $saved = UsuarioContrato::updateOrCreate(['id_usuario_contrato' => $id_usuario_contrato], $request->all());
        return response()->json(['saved' => $saved ]);
    }

    public function delete($id) {
        $deleted = false;
        $usuarioContrato = UsuarioContrato::find($id);
        if($usuarioContrato) {
            $deleted = $usuarioContrato->delete();
        }
        return response()->json([ 'deleted' => $deleted ]);
    }
}
