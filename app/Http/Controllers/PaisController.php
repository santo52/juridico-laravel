<?php

namespace App\Http\Controllers;

use App\Entities\Departamento;
use App\Entities\Municipio;

class PaisController extends Controller
{
    public function getDepartamentos($id){
        $departamentos = Departamento::where('id_pais', $id)->get();
        return response()->json($departamentos);
    }

    // public function index(){
    //     $url = 'https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.json';
    //     $json = file_get_contents($url);
    //     $json_data = json_decode($json, true);
    //     foreach($json_data as $key => $value) {
    //         Departamento::create([
    //             'id_departamento' => ($key + 5),
    //             'id_pais' => 1,
    //             'nombre_departamento' => $value['departamento']
    //         ]);
    //         foreach($value['ciudades'] as $k => $val) {
    //             Municipio::create([
    //                 'id_departamento' => ($key + 5),
    //                 'nombre_municipio' => $val
    //             ]);
    //         }
    //     }
    //     return response()->json([$json_data]);
    // }
}
