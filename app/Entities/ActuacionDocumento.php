<?php

namespace App\Entities;

use \App\BaseModel;

class ActuacionDocumento extends BaseModel
{
    protected $table = 'actuacion_documento';

    protected $primaryKey = 'id_actuacion_documento';

    public $timestamps = false;

    protected $fillable = [
        "id_actuacion_documento", "id_actuacion", "id_documento"
    ];
}
