<?php

namespace App\Entities;

use \App\BaseModel;

class SedeOperativa extends BaseModel
{
    protected $table = 'sede_operativa';

    protected $primaryKey = 'id_sede_operativa';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_sede_operativa", "nombre_sede_operativa", "estado_sede_operativa", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
