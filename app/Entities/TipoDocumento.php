<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documento';

    protected $primaryKey = 'id_tipo_documento';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_tipo_documento", "abreviatura_tipo_documento", "nombre_tipo_documento", "estado_tipo_documento", "fecha_creacion", "id_usuario_creacion", "eliminado"
    ];
}
