<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_persona', 'id_perfil', 'nombre_usuario', 'contrasena',
        'estado_usuario', 'fecha_creacion', 'id_usuario_creacion',
        'fecha_actualizacion', 'id_usuario_actualizacion',
    ];

    protected $hidden = [
        'contrasena'
    ];
}

