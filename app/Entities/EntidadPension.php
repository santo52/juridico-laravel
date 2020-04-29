<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EntidadPension extends Model
{
    protected $table = 'entidad_pension';

    protected $primaryKey = 'id_entidad_pension';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_entidad_pension", "nombre_entidad_pension", "estado_entidad_pension", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
