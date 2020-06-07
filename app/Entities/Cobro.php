<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $table = 'cobro';

    protected $primaryKey = 'id_cobro';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_cobro', 'id_proceso_etapa_actuacion', 'concepto', 'valor', 'fecha_cobro',
        'id_cliente', 'id_usuario_creacion', 'id_usuario_actualizacion', 'fecha_creacion',
        'fecha_actualizacion', 'cerrado', 'eliminado'
    ];

    public function procesoEtapaActuacion() {
        return $this->hasOne('App\Entities\ProcesoEtapaActuacion', 'id_proceso_etapa_actuacion', 'id_proceso_etapa_actuacion');
    }

    public function cliente() {
        return $this->hasOne('App\Entities\Cliente', 'id_cliente', 'id_cliente');
    }

    public function pago() {
        return $this->hasOne('App\Entities\Pago', 'id_cobro', 'id_cobro');
    }

    public function getFechaCobro() {
        $timestamp = strtotime($this->fecha_cobro);
        return date('d/m/Y', $timestamp);
    }

    public function getFechaCreacion() {
        $timestamp = strtotime($this->fecha_creacion);
        return date('d/m/Y h:i A', $timestamp);
    }


}
