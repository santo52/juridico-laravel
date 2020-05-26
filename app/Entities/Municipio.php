<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Departamento;

class Municipio extends Model
{
    protected $table = 'municipio';

    protected $primaryKey = 'id_municipio';

    public $timestamps = false;

    protected $fillable = [
        "id_municipio", "id_departamento", "nombre_municipio", 'indicativo'
    ];

    public function getDepartamento() {
        $departamento = Departamento::find($this->id_departamento);
        return $departamento ? $departamento->nombre_departamento : '';
    }
}
