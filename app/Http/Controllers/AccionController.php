<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\Accion;

class AccionController extends Controller
{
    public function get($id){
        $accion = Accion::find($id);
        return response()->json($accion);
    }

    public function upsert(Request $request) {
        $id = $request->get('id_accion');
        $data = $request->all();
        if(empty($id)) {
            $data['id_usuario_creacion'] = Auth::id();
        }

        $data['id_usuario_actualizacion'] = Auth::id();
        $saved = Accion::updateOrCreate(['id_accion' => $id], $data);
        return response()->json($saved);
    }

    public function delete($id) {
        $menu = Accion::find($id);
        $menu->eliminado = 1;
        $deleted = $menu->save();
        return response()->json(['deleted' => $deleted]);
    }

}
