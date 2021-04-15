<?php

namespace App\Entities;

use \App\BaseModel;

class EtapasProcesoTipoProceso extends BaseModel
{
    protected $table = 'etapas_proceso_tipo_proceso';

    protected $primaryKey = 'id_etapas_proceso_tipo_proceso';

    public $timestamps = false;

    protected $fillable = [
        "id_etapas_proceso_tipo_proceso", "id_tipo_proceso", "id_etapa_proceso", "order", "id_usuario_creacion"
    ];
}
