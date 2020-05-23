<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class GrupoVariable extends Model
{
    protected $table = 'grupos_variables';

    protected $primaryKey = 'id_grupo_variable';

    public $timestamps = false;

    protected $fillable = [
        "id_grupo_variable", "nombre_grupo_variable", "estado_grupo_variable", "orden"
    ];
}
