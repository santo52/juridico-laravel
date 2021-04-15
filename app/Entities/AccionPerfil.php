<?php

namespace App\Entities;

use \App\BaseModel;

class AccionPerfil extends BaseModel
{
    protected $table = 'accion_perfil';

    protected $primaryKey = 'id_accion_perfil';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_accion_perfil", "id_accion", "id_perfil", "inactivo", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
