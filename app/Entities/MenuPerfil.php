<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuPerfil extends Model
{
    protected $table = 'menu_perfil';

    protected $primaryKey = 'id_menu_perfil';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_menu_perfil", "id_menu", "id_perfil", "inactivo", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
