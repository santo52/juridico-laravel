<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';

    protected $primaryKey = 'id_pago';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_pago', 'fecha_pago', 'forma_pago', 'id_entidad_financiera', 'referencia',
        'valor_pago', 'eliminado', 'fecha_creacion', 'fecha_actualizacion', 'id_usuario_actualizacion',
        'id_usuario_creacion', 'id_cobro'
    ];

    public function cobro() {
        return $this->belongsTo('App\Entities\Cobro', 'id_cobro', 'id_cobro');
    }

    public function entidadFinanciera() {
        return $this->hasOne('App\Entities\EntidadFinanciera', 'id_cobro', 'id_cobro');
    }
}
