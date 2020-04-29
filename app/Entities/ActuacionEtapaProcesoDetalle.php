<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ActuacionEtapaProcesoDetalle extends Model
{
    protected $table = 'actuacion_etapa_proceso_detalle';

    protected $primaryKey = 'id_actuacion_etapa_proceso_detalle';

    protected $timestamps = false;

    protected $fillable = [
        "id_actuacion_etapa_proceso_detalle", "id_actuacion_etapa_proceso_maestro", "id_actuacion_proxima", "tiempo_maximo_proxima_actuacion", "unidad_tiempo_proxima_actuacion"
    ];
}
