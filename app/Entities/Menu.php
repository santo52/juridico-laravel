<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Collection\MenuCollection;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id_menu';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_menu", "nombre_menu", "ruta_menu", "parent_id", "tipo_menu", "orden_menu", "inactivo", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "estado"
    ];

    public static function getMenuWithChildren($orderBy = 'orden_menu') {
        $menu = Menu::where([
            ['estado', 1],
            ['parent_id', '0']
        ])->orderBy($orderBy)->get();

        foreach($menu as $key => $parent){
            $children = Menu::where([
                ['estado', 1],
                ['parent_id', $parent->id_menu]
            ])->orderBy($orderBy)->get();

            $menu[$key]['children'] = $children;
        }

        return $menu;
    }

    public function newCollection(array $models = []) {
        return new MenuCollection($models);
    }
}
