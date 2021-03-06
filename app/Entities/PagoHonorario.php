<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PagoHonorario extends Model
{
    protected $table = 'pago_honorario';

    protected $primaryKey = 'id_pago_honorario';

    public $timestamps = false;

    protected $fillable = [
        "id_pago_honorario", "fecha_consignacion", "id_entidad_financiera",
        "numero_cuenta", "valor_pago", "eliminado", "id_honorario", "forma_pago"
    ];

    public function honorario() {
        return $this->belongsTo('App\Entities\Honorario', 'id_honorario', 'id_honorario');
    }
}
