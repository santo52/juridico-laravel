<?php

namespace App\Entities;

use App\BaseModel;

class PlantillaDocumento extends BaseModel
{
    protected $table = 'plantilla_documento';

    protected $primaryKey = 'id_plantilla_documento';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_plantilla_documento", "nombre_plantilla_documento", "contenido_plantilla_documento", "estado_plantilla_documento", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "eliminado"
    ];
}
