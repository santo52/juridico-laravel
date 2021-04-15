<?php

namespace App\Entities;

use \App\BaseModel;

class ClaseEstado extends BaseModel
{
    protected $table = 'clase_estado';

    protected $primaryKey = 'id_clase_estado';

    public $timestamps = false;

    protected $fillable = [
        "id_clase_estado", "nombre_clase_estado"
    ];
}
