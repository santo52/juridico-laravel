<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;

class Documento extends BaseModel
{
    protected $table = 'documento';

    protected $primaryKey = 'id_documento';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_documento", "nombre_documento", "obligatoriedad_documento", "estado_documento", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "eliminado"
    ];

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }
}
