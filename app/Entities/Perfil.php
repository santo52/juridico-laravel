<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;

class Perfil extends BaseModel
{
    protected $table = 'perfil';

    protected $primaryKey = 'id_perfil';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_perfil", "nombre_perfil", "inactivo", "eliminado", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }
}
