<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Intermediario extends Model
{
    protected $table = 'intermediario';

    protected $primaryKey = 'id_intermediario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_intermediario", "id_persona", "estado_intermediario", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "eliminado", "retencion"
    ];
}
