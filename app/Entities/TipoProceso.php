<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
    protected $table = 'tipo_proceso';

    protected $primaryKey = 'id_tipo_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_tipo_proceso", "nombre_tipo_proceso", "estado_tipo_proceso", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
