<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcesoEtapaActuacion extends Model
{
    protected $table = 'proceso_etapa_actuacion';

    protected $primaryKey = 'id_proceso_etapa_actuacion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa_actuacion','id_proceso_etapa', 'id_actuacion', 'fecha_inicio',
        'fecha_fin', 'fecha_radicado', 'numero_radicado', 'fecha_vencimiento',
        'fecha_respuesta', 'id_entidad_justicia', 'nombre_juez', 'numero_proceso',
        'instancia', 'resultado', 'fecha_notificacion', 'tipo_resultado', 'motivo', 'comentario',
        'entidad_profirio_respuesta', 'fecha_audiencia', 'lugar_audiencia', 'apela_resultado',
        'fecha_creacion', 'fecha_actualizacion', 'id_usuario_creacion', 'id_usuario_actualizacion'
    ];
}
