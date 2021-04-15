<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\TipoDocumento;
use App\Entities\Municipio;

class Persona extends BaseModel
{
    protected $table = 'persona';

    protected $primaryKey = 'id_persona';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_persona", "id_tipo_documento", "numero_documento", "primer_apellido",
        "segundo_apellido", "primer_nombre", "segundo_nombre", "direccion", "barrio",
        "id_municipio", "celular", "telefono", "correo_electronico", "estado_persona",
        "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion",
        "id_usuario_actualizacion", "id_lugar_expedicion"
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Entities\Cliente');
    }

    public function intermediario()
    {
        return $this->belongsTo('App\Entities\Intermediario');
    }

    public function tipoDocumento()
    {
        return $this->hasOne('App\Entities\TipoDocumento', 'id_tipo_documento', 'id_tipo_documento');
    }

    public function municipio()
    {
        return $this->hasOne('App\Entities\Municipio', 'id_municipio', 'id_municipio');
    }

    public function lugarExpedicionDocumento()
    {
        return $this->hasOne('App\Entities\Municipio', 'id_municipio', 'id_lugar_expedicion');
    }

    public function getNombreCompleto($desc = true)
    {
        $nombreCompleto = [];
        if($desc) {
            if ($this->primer_apellido) $nombreCompleto[] = ucwords(strtolower($this->primer_apellido));
            if ($this->segundo_apellido) $nombreCompleto[] = ucwords(strtolower($this->segundo_apellido));
        }

        if ($this->primer_nombre) $nombreCompleto[] = ucwords(strtolower($this->primer_nombre));
        if ($this->segundo_nombre) $nombreCompleto[] = ucwords(strtolower($this->segundo_nombre));

        if(!$desc) {
            if ($this->primer_apellido) $nombreCompleto[] = ucwords(strtolower($this->primer_apellido));
            if ($this->segundo_apellido) $nombreCompleto[] = ucwords(strtolower($this->segundo_apellido));
        }

        return implode(' ', $nombreCompleto);
    }

    public function getTipoDocumento()
    {
        if ($this->tipoDocumento) {
            return $this->tipoDocumento->nombre_tipo_documento;
        }

        return 'Sin tipo de documento';
    }

    public function getSiglasTipoDocumento()
    {
        if ($this->tipoDocumento) {
            return $this->tipoDocumento->abreviatura_tipo_documento;
        }
        return 'Ninguno';
    }

    public function getDepartamento()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->departamento->nombre_departamento : '';
    }

    public function getMunicipio()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->nombre_municipio : '';
    }

    public function getPais()
    {
        return 'Colombia';
    }

    public function getIndicativo()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->indicativo : '';
    }

    public function getLugarExpedicionDocumento()
    {
        $municipio = $this->lugarExpedicionDocumento;
        return $municipio ? $municipio->nombre_municipio : '';
    }
}
