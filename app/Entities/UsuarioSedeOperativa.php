<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UsuarioSedeOperativa extends Model
{
    protected $table = 'usuario_sede_operativa';

    protected $primaryKey = 'id_tipo_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_usuario_sede_operativa", "id_usuario", "id_sede_operativa", "estado_usuario_sede_operativa", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
