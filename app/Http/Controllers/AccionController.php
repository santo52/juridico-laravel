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

        if(empty($data['id_menu'])) {
            $data['id_menu'] = 0;
        }

        $saved = Accion::updateOrCreate(['id_accion' => $id], $data);
        return response()->json($saved);
    }

    public function delete($id) {
        $menu = Accion::find($id);
        if($menu->id_menu) {
            $menu->eliminado = 1;
            $deleted = $menu->save();
        } else {
            $deleted = $menu->delete();
        }

        return response()->json(['deleted' => $deleted]);
    }
}
