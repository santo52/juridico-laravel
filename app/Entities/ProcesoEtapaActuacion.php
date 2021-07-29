<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\Usuario;
use App\Entities\Actuacion;
use App\Entities\ProcesoEtapa;

class ProcesoEtapaActuacion extends BaseModel
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
        'entidad_profirio_respuesta', 'fecha_audiencia', 'lugar_audiencia', 'apela_resultado', "valor_pago",
        'fecha_creacion', 'fecha_actualizacion', 'id_usuario_creacion', 'id_usuario_actualizacion',
        "id_usuario_asigna", 'resultado_actuacion', 'fecha_actuacion_rama', 'fecha_notificacion_rama',
        'fecha_inicio_termino_rama', 'anotacion_rama', 'historico', 'fecha_resultado'
    ];

    public function cobro() {
        return $this->belongsTo('App\Entities\Cobro', 'id_proceso_etapa_actuacion', 'id_proceso_etapa_actuacion');
    }

    public function procesoEtapa()
    {
        return $this->belongsTo('App\Entities\ProcesoEtapa', 'id_proceso_etapa', 'id_proceso_etapa');
    }

    public function actuacion()
    {
        return $this->hasOne('App\Entities\Actuacion', 'id_actuacion', 'id_actuacion');
    }

    public function usuarioResponsable()
    {
        return $this->hasOne('App\Entities\Usuario', 'id_usuario', 'id_usuario_responsable');
    }

    public function usuarioAsigna()
    {
        return $this->hasOne('App\Entities\Usuario', 'id_usuario', 'id_usuario_asigna');
    }

    public function getFechaInicioString()
    {
        return date('d/m/Y h:i A', strtotime($this->fecha_inicio));
    }

    public function getFechaResultadoString()
    {
        return date('d/m/Y', strtotime($this->fecha_resultado));
    }

    public function getFechaVencimientoString()
    {
        $actuacion = $this->actuacion;
        $multiplicador = $actuacion->dias_vencimiento_unidad == 2 ? 30 : 1;
        $dias = $actuacion && $actuacion->dias_vencimiento ? $actuacion->dias_vencimiento : 0;
        $dias *= $multiplicador;
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

        if(!$this->diasVencimiento) return 'verde';

        $hoy = date('Y-m-d');
        $vencimiento = strtotime("+{$this->diasVencimiento} days {$this->fecha_inicio}");

        if ($this->finalizado == 0) {
            if (strtotime('now') > $vencimiento) {
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

        return 'negro';
    }

    public function getResponsable()
    {
        $usuario = $this->usuarioResponsable;
        return $usuario ? $usuario->getNombreCompleto() : 'Sin responsable';
    }

    public function getAsignadoPor()
    {
        $usuario = $this->usuarioAsigna;
        return $usuario ? $usuario->getNombreCompleto() : 'Por el sistema';
    }

    public function getSeguimientoId() {
        return $this->procesoEtapa->id_proceso;
    }

    public function getValorCobrado() {
        $cobrado = 0;
        if($this->cobro) {
            $cobrado = $this->cobro->valor;
        }
        return $cobrado;
    }

    public function getValorPagado() {
        $pagado = 0;
        if($this->cobro && $this->cobro->pago) {
            $pagado = $this->cobro->getPagado();
        }
        return $pagado;
    }
}
