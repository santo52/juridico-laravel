<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';

    protected $primaryKey = 'id_departamento';

    public $timestamps = false;

    protected $fillable = [
        "id_departamento", "id_pais", "nombre_departamento"
    ];
}
