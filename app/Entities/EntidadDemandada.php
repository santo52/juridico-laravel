<?php

namespace App\Entities;

use \App\BaseModel;

class EntidadDemandada extends BaseModel
{
    protected $table = 'entidad_demandada';

    protected $primaryKey = 'id_entidad_demandada';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_entidad_demandada", "nombre_entidad_demandada",
        "estado_entidad_demandada", "fecha_creacion",
        "id_usuario_creacion", "fecha_actualizacion",
        "id_usuario_actualizacion", "eliminado", "email_entidad_demandada"
    ];
}
