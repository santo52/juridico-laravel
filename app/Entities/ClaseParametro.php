<?php

namespace App\Entities;

use \App\BaseModel;

class ClaseParametro extends BaseModel
{
    protected $table = 'clase_parametro';

    protected $primaryKey = 'id_clase_parametro';

    public $timestamps = false;

    protected $fillable = [
        "id_clase_parametro", "nombre_clase_parametro"
    ];
}
