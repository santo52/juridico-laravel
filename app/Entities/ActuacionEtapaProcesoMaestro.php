<?php

namespace App\Entities;

use \App\BaseModel;

class ActuacionEtapaProcesoMaestro extends BaseModel
{
    protected $table = 'actuacion_etapa_proceso_maestro';

    protected $primaryKey = 'id_actuacion_etapa_proceso_maestro';

    public $timestamps = false;

    protected $fillable = [
        "id_actuacion_etapa_proceso_maestro", "id_actuacion", "id_etapa_proceso"
    ];
}
