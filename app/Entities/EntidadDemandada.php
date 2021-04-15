<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;

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
        "id_usuario_actualizacion", "eliminado", "email_entidad_demandada", "id_municipio"
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
