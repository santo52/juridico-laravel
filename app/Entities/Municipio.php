<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\Departamento;

class Municipio extends BaseModel
{
    protected $table = 'municipio';

    protected $primaryKey = 'id_municipio';

    public $timestamps = false;

    protected $fillable = [
        "id_municipio", "id_departamento", "nombre_municipio", 'indicativo'
    ];

    public function departamento()
    {
        return $this->hasOne('App\Entities\Departamento', 'id_departamento', 'id_departamento');
    }

    public function getDepartamento() {
        $departamento = $this->departamento;
        return $departamento ? $departamento->nombre_departamento : '';
    }

    public function getPais() {
        $departamento = $this->departamento;
        return $departamento ? $departamento->getPais() : '';
    }
}
