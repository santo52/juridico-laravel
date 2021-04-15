<?php

namespace App\Entities;

use \App\BaseModel;

class Variable extends BaseModel
{
    protected $table = 'variables';

    protected $primaryKey = 'id_variable';

    public $timestamps = false;

    protected $fillable = [
        "id_variable", "nombre_variable", "valor_variable", "estado_variable", "orden", "function_variable"
    ];
}
