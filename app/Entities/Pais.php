<?php

namespace App\Entities;

use \App\BaseModel;

class Pais extends BaseModel
{
    protected $table = 'pais';

    protected $primaryKey = 'id_pais';

    public $timestamps = false;

    protected $fillable = [
        "id_pais", "nombre_pais"
    ];

    public function departamentos()
    {
        return $this->belongsTo('App\Entities\Departamento');
    }
}
