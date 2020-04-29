<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';

    protected $primaryKey = 'id_documento';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_documento", "nombre_documento", "obligatoriedad_documento", "estado_documento", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
