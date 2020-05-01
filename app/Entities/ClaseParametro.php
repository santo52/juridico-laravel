<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaseParametro extends Model
{
    protected $table = 'clase_parametro';

    protected $primaryKey = 'id_clase_parametro';

    public $timestamps = false;

    protected $fillable = [
        "id_clase_parametro", "nombre_clase_parametro"
    ];
}
