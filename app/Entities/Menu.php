<?php

namespace App\Entities;

use \App\BaseModel;
use App\Collection\MenuCollection;
use Illuminate\Support\Facades\Auth;
use App\Builders\Builder;

class Menu extends BaseModel
{
    protected $table = 'menu';

    protected $primaryKey = 'id_menu';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_menu", "nombre_menu", "ruta_menu", "parent_id", "tipo_menu", "orden_menu", "inactivo", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "estado"
    ];

    public static function getMenuWithChildren($orderBy = 'orden_menu', $validateAdmin = false) {

        $idProfile = Auth::user()->id_perfil;
        $menuItems = [];

        $menu = Menu::where([
            ['estado', 1],
            ['parent_id', '0']
        ])->orderBy($orderBy)->get();

        foreach($menu as $key => $parent){
            $children = Menu::
            select('menu.*')
            ->leftjoin('menu_perfil as p', 'p.id_menu', 'menu.id_menu')
            ->where([
                ['estado', 1],
                ['parent_id', $parent->id_menu]
            ]);

            // Si el usuario no es administrador se verifica el perfil
            if($validateAdmin && $idProfile !== env('PROFILE_ADMIN_ID', 1)) {
                $children = $children->where('id_perfil', $idProfile);
            }

            $children = $children->groupBy('menu.id_menu')->orderBy($orderBy)->get();

            if($children->count() > 0) {
                $menu[$key]['children'] = $children;
                $menuItems[] = $menu[$key];
            }
        }

        return $menuItems;
    }

    public function newCollection(array $models = []) {
        return new MenuCollection($models);
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }
}
