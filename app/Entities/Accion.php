<?php

namespace App\Entities;

use \App\BaseModel;

class Accion extends BaseModel
{
    protected $table = 'accion';

    protected $primaryKey = 'id_accion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_menu", "nombre_accion", "observacion", "inactivo", "global", "fecha_creacion", "id_usuario_creacion", 'fecha_actualizacion'
    ];
}
