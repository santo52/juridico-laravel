<?php

namespace App\Entities;

use \App\BaseModel;

class ActuacionPlantillaDocumento extends BaseModel
{
    protected $table = 'actuacion_plantilla_documento';

    protected $primaryKey = 'id_actuacion_plantilla_documento';

    public $timestamps = false;

    protected $fillable = [
        "id_actuacion_plantilla_documento", "id_actuacion", "id_plantilla_documento"
    ];
}
