<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcesoEtapaBitacora extends Model
{
    protected $table = 'proceso_etapa_bitacora';

    protected $primaryKey = 'id_proceso_etapa_bitacora';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa_bitacora', 'id_usuario', 'comentario',
        'fecha_creacion', 'fecha_actualizacion', 'proceso_etapa'
    ];
}
