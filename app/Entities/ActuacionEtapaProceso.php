<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ActuacionEtapaProceso extends Model
{
    protected $table = 'actuacion_etapa_proceso';

    protected $primaryKey = 'id_actuacion_etapa_proceso';

    public $timestamps = false;

    protected $fillable = [
        "id_actuacion_etapa_proceso", "id_etapa_proceso", "id_actuacion", "tiempo_maximo_proxima_actuacion", "unidad_tiempo_proxima_actuacion", "id_usuario_creacion", "order"
    ];
}
