<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\TipoDocumento;
use App\Entities\Municipio;

class Persona extends Model
{
    protected $table = 'persona';

    protected $primaryKey = 'id_persona';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_persona", "id_tipo_documento", "numero_documento", "primer_apellido", "segundo_apellido", "primer_nombre", "segundo_nombre", "direccion", "barrio", "id_municipio", "celular", "telefono", "correo_electronico", "estado_persona", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];

    public function getNombreCompleto(){
        $nombreCompleto = [];

        if($this->primer_nombre) $nombreCompleto[] = ucwords(strtolower($this->primer_nombre));
        if($this->segundo_nombre) $nombreCompleto[] = ucwords(strtolower($this->segundo_nombre));
        if($this->primer_apellido) $nombreCompleto[] = ucwords(strtolower($this->primer_apellido));
        if($this->segundo_apellido) $nombreCompleto[] = ucwords(strtolower($this->segundo_apellido));

        return implode(' ', $nombreCompleto);
    }

    public function getTipoDocumento() {
        $tipoDocumento = TipoDocumento::find($this->id_tipo_documento);
        if($tipoDocumento) {
            return $tipoDocumento->nombre_tipo_documento;
        }

        return 'Sin tipo de documento';
    }

    public function getSiglasTipoDocumento() {
        $tipoDocumento = TipoDocumento::find($this->id_tipo_documento);
        if($tipoDocumento) {
            return $tipoDocumento->abreviatura_tipo_documento;
        }

        return 'Ninguno';
    }

    public function getDepartamento() {
        $municipio = Municipio::find($this->id_municipio);
        return $municipio ? $municipio->getDepartamento() : '';
    }

    public function getMunicipio() {
        $municipio = Municipio::find($this->id_municipio);
        return $municipio ? $municipio->nombre_municipio : '';
    }
}
