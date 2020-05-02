<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Perfil;

class PerfilController extends Controller
{
    public function index(){
        $perfil = new Perfil;
        $list = $perfil
            ->where('inactivo', '0')
            ->orderBy('id_perfil', 'desc')
            ->get();

        return $this->renderSection('perfil.listar', [
            'perfiles' => $list
        ]);
    }
}
