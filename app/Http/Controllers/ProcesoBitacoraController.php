<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\ProcesoBitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProcesoBitacoraController extends Controller
{
    public function upsert(Request $request) {
        $id = $request->get('id_proceso_bitacora');
        $procesoBitacora = ProcesoBitacora::find($id);
        if($procesoBitacora && $procesoBitacora->sesion_id === Session::getId()) {
            $procesoBitacora->update([ "comentario" =>  $request->get('comentario') ]);
        } else {
            $procesoBitacora = ProcesoBitacora::create([
                'comentario' => $request->get('comentario'),
                'id_proceso' => $request->get('id_proceso'),
                'id_usuario' => Auth::id(),
                'sesion_id' => Session::getId()
            ]);
        }

        $procesoBitacora->fechaCreacion = $procesoBitacora->getFechaCreacion();
        $procesoBitacora->nombreUsuario = $procesoBitacora->getNombreCompleto();
        return response()->json(['saved' => $procesoBitacora ]);
    }

    public function get($id) {
        $procesoBitacora = ProcesoBitacora::find($id);
        return response()->json($procesoBitacora);
    }

    public function delete($id) {
        $procesoBitacora = ProcesoBitacora::find($id);
        $deleted = $procesoBitacora && Session::getId() === $procesoBitacora->sesion_id ? $procesoBitacora->delete() : false;
        return response()->json(['deleted' => $deleted]);
    }
}
