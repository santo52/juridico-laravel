<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Builders\Builder;

class Honorario extends Model
{
    protected $table = 'honorario';

    protected $primaryKey = 'id_honorario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_honorario", "id_proceso", "porcentaje_honorarios", "valor_comision",
        "retefuente", "reteica", "fecha_actualizacion", "id_usuario_actualizacion",
        "fecha_creacion", "id_usuario_creacion", "eliminado", "valor_factura", "numero_factura", "cerrado"
    ];

    public function proceso(){
        return $this->belongsTo('App\Entities\Proceso', 'id_proceso', 'id_proceso');
    }

    public function pagoHonorario() {
        return $this->hasMany('App\Entities\PagoHonorario', 'id_honorario', 'id_honorario');
    }

    public function pagoHonorarios() {
        return $this->hasMany('App\Entities\PagoHonorario', 'id_honorario', 'id_honorario');
    }

    public function cliente() {
        return $this->belongsTo('App\Entities\Cliente', 'id_cliente', 'id_cliente');
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }

    public function getValorAPagar() {
        return $this->getTotalHonorarios() + $this->getTotalComisiones();
    }

    public function getValorPagado() {
        $total = 0;
        if($this->pagoHonorarios) {
            foreach($this->pagoHonorarios as $pago) {
                $total += $pago->valor_pago;
            }
        }
        return $total;
    }

    public function getTotalRetefuente() {
        if($this->valor_comision && $this->retefuente) {
            return $this->valor_comision * $this->retefuente / 100;
        }
        return 0;
    }

    public function getTotalReteica() {
        if($this->valor_comision && $this->reteica) {
            return $this->valor_comision * $this->reteica / 100;
        }
        return 0;
    }

    public function getTotalComisiones() {
        if($this->valor_comision) {
            return $this->valor_comision - $this->getTotalRetefuente() - $this->getTotalReteica();
        }
        return 0;
    }

    public function getTotalHonorarios() {
        if($this->proceso->valor_final_sentencia && $this->porcentaje_honorarios) {
            return $this->proceso->valor_final_sentencia * $this->porcentaje_honorarios / 100;
        }

        return 0;
    }
}
