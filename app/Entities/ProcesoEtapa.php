<?php

namespace App\Entities;

use \App\BaseModel;

class ProcesoEtapa extends BaseModel
{
    protected $table = 'proceso_etapa';

    protected $primaryKey = 'id_proceso_etapa';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa', 'id_etapa_proceso', 'id_proceso', 'porcentaje',
        'fecha_creacion', 'fecha_actualizacion', 'id_usuario_creacion', 'id_usuario_actualizacion'
    ];

    public function proceso() {
        return $this->belongsTo('App\Entities\Proceso', 'id_proceso', 'id_proceso');
    }

    public function procesoEtapaActuaciones() {
        return $this->hasMany('App\Entities\ProcesoEtapaActuacion', 'id_proceso_etapa', 'id_proceso_etapa');
    }

    public function etapaProceso() {
        return $this->hasOne('App\Entities\EtapaProceso', 'id_etapa_proceso', 'id_etapa_proceso');
    }
}
