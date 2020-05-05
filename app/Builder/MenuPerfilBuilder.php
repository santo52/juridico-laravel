<?php

namespace App\Builder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Entities\Accion;

class MenuPerfilBuilder extends Builder
{
    public function getByProfile($idProfile){
        $this->leftjoin('menu as m', 'm.id_menu', '=', 'menu_perfil.id_menu')
            ->where([
            ['id_perfil', $idProfile],
            ['m.parent_id', '<>', 0],
            ['m.estado', 1]
        ]);

        return $this;
    }



    public function getWithActions(){

        $menuPerfil = $this->get();

        foreach ($menuPerfil as $key => $menu) {
            $acciones = Accion::
                select('accion.id_accion', 'nombre_accion', DB::raw("(select count(*) from accion_menu_perfil amp where amp.id_accion = accion.id_accion and id_menu_perfil = {$menu->id_menu_perfil} limit 1 ) as selected"))
                ->whereRaw('not eliminado and (id_menu = ? or `global`)', [$menu->id_menu])
                ->get();

            $menuPerfil[$key]['acciones'] = $acciones;
        }

        return $menuPerfil;
    }
}
