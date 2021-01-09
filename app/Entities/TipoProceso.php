<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;

class TipoProceso extends BaseModel
{
    protected $table = 'tipo_proceso';

    protected $primaryKey = 'id_tipo_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_tipo_proceso", "nombre_tipo_proceso", "estado_tipo_proceso", "eliminado", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];

    public function etapas(){
        return $this->belongsToMany('App\Entities\EtapaProceso', 'etapas_proceso_tipo_proceso', 'id_tipo_proceso', 'id_etapa_proceso')->withPivot('order', 'id_usuario_creacion');
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }

    public static function getEtapas($id, $where = false) {

        $conditional = [
            ['tipo_proceso.eliminado', 0],
            ['estado_tipo_proceso', '1'],
            ['ep.eliminado', 0],
            ['estado_etapa_proceso', '1'],
            ['tipo_proceso.id_tipo_proceso', $id]
        ];

        if(is_array($where)) {
            $conditional = array_merge($conditional, $where);
        }

        return self::select('ep.*')
        ->leftjoin('etapas_proceso_tipo_proceso as eptp', 'eptp.id_tipo_proceso', 'tipo_proceso.id_tipo_proceso')
        ->leftjoin('etapa_proceso as ep', 'ep.id_etapa_proceso', 'eptp.id_etapa_proceso')
        ->where($conditional)->orderBy('eptp.order');
    }
}
