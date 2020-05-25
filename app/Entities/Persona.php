<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

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
}
