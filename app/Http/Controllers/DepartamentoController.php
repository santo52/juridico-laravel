<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Municipio;

class DepartamentoController extends Controller
{
    function getMunicipios($id) {
        $municipios = Municipio::where('id_departamento', $id)->get();
        return response()->json($municipios);
    }
}
