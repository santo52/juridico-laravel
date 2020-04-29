<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id_menu';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_menu", "nombre_menu", "ruta_menu", "parent_id", "tipo_menu", "orden_menu", "inactivo", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
