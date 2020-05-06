<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EtapaProceso extends Model
{
    protected $table = 'etapa_proceso';

    protected $primaryKey = 'id_etapa_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_etapa_proceso", "nombre_etapa_proceso", "posicion_etapa_proceso", "eliminado", "id_etapa_proceso_anterior", "id_etapa_proceso_siguiente", "estado_etapa_proceso", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
