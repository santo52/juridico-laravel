<?php

namespace App\Entities;

use \App\BaseModel;

class Departamento extends BaseModel
{
    protected $table = 'departamento';

    protected $primaryKey = 'id_departamento';

    public $timestamps = false;

    protected $fillable = [
        "id_departamento", "id_pais", "nombre_departamento"
    ];

    public function municipios()
    {
        return $this->belongsTo('App\Entities\Municipio');
    }

    public function pais()
    {
        return $this->hasOne('App\Entities\Pais', 'id_pais', 'id_pais');
    }
}
