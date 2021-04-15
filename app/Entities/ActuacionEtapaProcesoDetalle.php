<?php

namespace App\Entities;

use \App\BaseModel;

class ActuacionEtapaProcesoDetalle extends BaseModel
{
    protected $table = 'actuacion_etapa_proceso_detalle';

    protected $primaryKey = 'id_actuacion_etapa_proceso_detalle';

    public $timestamps = false;

    protected $fillable = [
        "id_actuacion_etapa_proceso_detalle", "id_actuacion_etapa_proceso_maestro", "id_actuacion_proxima", "tiempo_maximo_proxima_actuacion", "unidad_tiempo_proxima_actuacion"
    ];
}
