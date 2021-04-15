<?php

namespace App\Entities;

use \App\BaseModel;

class Estado extends BaseModel
{
    protected $table = 'estado';

    protected $primaryKey = 'id_estado';

    public $timestamps = false;

    protected $fillable = [
        "id_estado", "id_clase_estado", "codigo_estado", "nombre_estado"
    ];
}
