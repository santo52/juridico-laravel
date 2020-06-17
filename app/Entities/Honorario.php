<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Honorario extends Model
{
    protected $table = 'honorario';

    protected $primaryKey = 'id_honorario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_honorario", "id_proceso", "id_cliente", "numero_caso", "valor_pagado_cliente",
        "id_intermediario", "fecha_pago", "observacion", "porcentaje_honorarios",
        "valor_honorarios", "valor_comision", "eliminado",
        "fecha_actualizacion", "id_usuario_actualizacion",
        "fecha_creacion", "id_usuario_creacion"
    ];

    public function pagoHonorario() {
        return $this->belongsTo('App\Entities\PagoHonorario', 'id_honorario', 'id_honorario');
    }

    public function cliente() {
        return $this->belongsTo('App\Entities\Cliente', 'id_cliente', 'id_cliente');
    }

    public function getValorAPagar() {
        return $this->valor_comision;
    }

    public function getValorPagado() {
        return 0;
    }
}
