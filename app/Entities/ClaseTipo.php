<?php

namespace App\Entities;

use \App\BaseModel;

class ClaseTipo extends BaseModel
{
    protected $table = 'clase_tipo';

    protected $primaryKey = 'id_clase_tipo';

    public $timestamps = false;

    protected $fillable = [
        "id_clase_tipo", "nombre_clase_tipo"
    ];
}
