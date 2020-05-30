<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\Persona;

class Intermediario extends BaseModel
{
    protected $table = 'intermediario';

    protected $primaryKey = 'id_intermediario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_intermediario", "id_persona", "estado_intermediario", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "eliminado", "retencion"
    ];

    public function persona()
    {
        return $this->hasOne('App\Entities\Persona', 'id_persona', 'id_persona');
    }

    public function getNombreCompleto(){
        return $this->persona->getNombreCompleto();
    }
}
