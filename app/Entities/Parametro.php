<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametro';

    protected $primaryKey = 'id_parametro';

    protected $timestamps = false;

    protected $fillable = [
        "id_parametro", "id_clase_parametro", "codigo_parametro", "nombre_parametro", "valor_parametro"
    ];
}
