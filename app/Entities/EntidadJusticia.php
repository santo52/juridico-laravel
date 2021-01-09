<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;

class EntidadJusticia extends BaseModel
{
    protected $table = 'entidad_justicia';

    protected $primaryKey = 'id_entidad_justicia';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_entidad_justicia", "nombre_entidad_justicia", "aplica_primera_instancia",
        "aplica_segunda_instancia", "estado_entidad_justicia", "fecha_creacion", "id_usuario_creacion",
        "fecha_actualizacion", "id_usuario_actualizacion", "eliminado", "id_municipio", "email_entidad_justicia"
    ];

    public function municipio()
    {
        return $this->hasOne('App\Entities\Municipio', 'id_municipio', 'id_municipio');
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }

    public function getMunicipio(){
        $municipio = $this->municipio;
        return $municipio ? $municipio->nombre_municipio : '';
    }

    public function getDepartamento(){
        $municipio = $this->municipio;
        return $municipio ? $municipio->getDepartamento() : '';
    }

    public function getPais(){
        $municipio = $this->municipio;
        return $municipio ? $municipio->getPais() : '';
    }
}
