<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = 'variables';

    protected $primaryKey = 'id_variable';

    public $timestamps = false;

    protected $fillable = [
        "id_variable", "nombre_variable", "valor_variable", "estado_variable", "orden"
    ];
}
