<?php

namespace App\Entities;

use \App\BaseModel;

class Contacto extends BaseModel
{
    protected $table = 'contacto';

    protected $primaryKey = 'id_contacto';

    public $timestamps = false;

    protected $fillable = [
        "id_contacto", "nombre_contacto", "parentesco", "direccion", "barrio", "nombre_municipio", "celular", "telefono", "correo_electronico", "id_municipio", 'informacion_adicional', 'numero_documento'
    ];

    public function municipio()
    {
        return $this->hasOne('App\Entities\Municipio', 'id_municipio', 'id_municipio');
    }

    public function getMunicipio()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->nombre_municipio : '';
    }

    public function getDepartamento()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->departamento->nombre_departamento : '';
    }

    public function getPais()
    {
        return 'Colombia';
    }
}
