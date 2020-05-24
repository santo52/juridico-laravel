<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcesoEtapa extends Model
{
    protected $table = 'proceso_etapa';

    protected $primaryKey = 'id_proceso_etapa';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa', 'id_etapa_proceso', 'id_proceso', 'porcentaje',
        'fecha_creacion', 'fecha_actualizacion', 'id_usuario_creacion', 'id_usuario_actualizacion'
    ];
}
