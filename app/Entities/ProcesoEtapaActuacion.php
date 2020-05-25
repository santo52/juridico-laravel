<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Usuario;
use App\Entities\Actuacion;
use App\Entities\ProcesoEtapa;

class ProcesoEtapaActuacion extends Model
{
    protected $table = 'proceso_etapa_actuacion';

    protected $primaryKey = 'id_proceso_etapa_actuacion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    private $diasVencimiento;

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
        return date('d/m/Y h:i A', strtotime($this->fecha_inicio));
    }

    public function getFechaVencimientoString()
    {
        $actuacion = Actuacion::find($this->id_actuacion);
        $dias = $actuacion && $actuacion->dias_vencimiento ? $actuacion->dias_vencimiento : 0;
        $this->diasVencimiento = $dias;
        return date('d/m/Y h:i A', strtotime("+{$dias} days {$this->fecha_inicio}"));
    }

    public function getFechaFinString()
    {
        return $this->fecha_fin ? date('d/m/Y h:i A', strtotime($this->fecha_fin)) : 'En proceso';
    }

    public function getEstado()
    {
        return $this->finalizado == 1 ? 'Finalizado' : 'En proceso';
    }

    public function getEstadoColor()
    {
        $hoy = date('Y-m-d');
        $vencimiento = strtotime("+{$this->diasVencimiento} days {$this->fecha_inicio}");

        if ($this->finalizado == 0) {
            if ($hoy === date('Y-m-d', $vencimiento)) {
                return 'rojo';
            } else {

                $limitDays = $this->diasVencimiento * 0.75 * 24;
                $limitDate = strtotime("+{$limitDays} hours {$this->fecha_inicio}");
                if(strtotime('now') > $limitDate) {
                    return 'amarillo';
                }

                return 'verde';
            }
        }

        return 'gris';
    }

    public function getResponsable()
    {
        $usuario = Usuario::find($this->id_usuario_responsable);
        return $usuario ? $usuario->getNombreCompleto() : 'Sin responsable';
    }

    public function getSeguimientoId() {
        return 20;
        $procesoEtapa = ProcesoEtapa::find($this->id_proceso_etapa);
        return $procesoEtapa->id_proceso;
    }
}
