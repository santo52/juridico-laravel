<?php

namespace App\Http\Controllers;

use App\Entities\Municipio;

class MunicipioController extends Controller
{
    public function get($id){
        $municipio = Municipio::find($id);
        return response()->json($municipio);
    }
}
