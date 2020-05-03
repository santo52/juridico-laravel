<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'accion';

    protected $primaryKey = 'id_accion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_menu", "nombre_accion", "observacion", "inactivo", "global", "fecha_creacion", "id_usuario_creacion", 'fecha_actualizacion'
    ];
}
