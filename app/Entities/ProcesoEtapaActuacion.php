<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Usuario;

class ProcesoEtapaActuacion extends Model
{
    protected $table = 'proceso_etapa_actuacion';

    protected $primaryKey = 'id_proceso_etapa_actuacion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa_actuacion', 'id_proceso_etapa', 'id_actuacion', 'fecha_inicio',
        'fecha_fin', 'fecha_radicado', 'numero_radicado', 'fecha_vencimiento', 'id_usuario_responsable',
        'fecha_respuesta', 'id_entidad_justicia', 'nombre_juez', 'numero_proceso', 'finalizado',
        'instancia', 'resultado', 'fecha_notificacion', 'tipo_resultado', 'motivo', 'comentario',
        'entidad_profirio_respuesta', 'fecha_audiencia', 'lugar_audiencia', 'apela_resultado',
        'fecha_creacion', 'fecha_actualizacion', 'id_usuario_creacion', 'id_usuario_actualizacion'
    ];

    public function getFechaInicioString()
    {
        return date('Y-m-d h:i:s', strtotime($this->fecha_inicio));
    }

    public function getFechaVencimientoString()
    {
        return date('Y-m-d h:i:s', strtotime("+{$this->dias_vencimiento} days {$this->fecha_inicio}"));
    }

    public function getFechaFinString()
    {
        return $this->fecha_fin ? date('Y-m-d h:i:s', strtotime($this->fecha_fin)) : 'En proceso';
    }

    public function getEstado()
    {
        return $this->finalizado == 1 ? 'Finalizado' : 'En proceso';
    }

    public function getResponsable()
    {
        $usuario = Usuario::find($this->id_usuario_responsable);
        return $usuario ? $usuario->getNombreCompleto() : 'Sin responsable';
    }
}
