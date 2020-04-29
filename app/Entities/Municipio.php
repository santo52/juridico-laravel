<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';

    protected $primaryKey = 'id_municipio';

    protected $timestamps = false;

    protected $fillable = [
        "id_municipio", "id_departamento", "nombre_municipio"
    ];
}
