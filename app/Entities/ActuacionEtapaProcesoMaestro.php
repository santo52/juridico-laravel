<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ActuacionEtapaProcesoMaestro extends Model
{
    protected $table = 'actuacion_etapa_proceso_maestro';

    protected $primaryKey = 'id_actuacion_etapa_proceso_maestro';

    protected $timestamps = false;

    protected $fillable = [
        "id_actuacion_etapa_proceso_maestro", "id_actuacion", "id_etapa_proceso"
    ];
}
