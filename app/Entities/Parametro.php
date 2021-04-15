<?php

namespace App\Entities;

use \App\BaseModel;

class Parametro extends BaseModel
{
    protected $table = 'parametro';

    protected $primaryKey = 'id_parametro';

    public $timestamps = false;

    protected $fillable = [
        "id_parametro", "id_clase_parametro", "codigo_parametro", "nombre_parametro", "valor_parametro"
    ];
}
