<?php

namespace App\Entities;

use \App\BaseModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Entities\Persona;
class Usuario extends Authenticatable
{
    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_persona', 'id_perfil', 'nombre_usuario', 'contrasena',
        'estado_usuario', 'fecha_creacion', 'id_usuario_creacion', 'id_area',
        'fecha_actualizacion', 'id_usuario_actualizacion', 'password', 'eliminado'
    ];

    protected $hidden = [
        'contrasena', 'password'
    ];

    public function persona()
    {
        return $this->hasOne('App\Entities\Persona', 'id_persona', 'id_persona');
    }

    public function area()
    {
        return $this->hasOne('App\Entities\Area', 'id_area', 'id_area');
    }

    public function getNombreCompleto() {
        $persona = $this->persona;
        return $persona ? $persona->getNombreCompleto() : $this->nombre_usuario;
    }
}

