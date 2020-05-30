<?php

namespace App\Entities;

use \App\BaseModel;

class EtapaProceso extends BaseModel
{
    protected $table = 'etapa_proceso';

    protected $primaryKey = 'id_etapa_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_etapa_proceso", "nombre_etapa_proceso", "posicion_etapa_proceso", "eliminado", "id_etapa_proceso_anterior", "id_etapa_proceso_siguiente", "estado_etapa_proceso", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];

    public static function getActuaciones($id)
    {
        return self::select('a.*', 'aep.*')
            ->leftjoin('actuacion_etapa_proceso as aep', 'aep.id_etapa_proceso', 'etapa_proceso.id_etapa_proceso')
            ->leftjoin('actuacion as a', 'a.id_actuacion', 'aep.id_actuacion')
            ->where([
                'etapa_proceso.eliminado' => 0,
                'estado_etapa_proceso' => '1',
                'a.eliminado' => 0,
                'estado_actuacion' => '1',
                'etapa_proceso.id_etapa_proceso' => $id
            ])->orderBy('aep.order');
    }

    public function getTiempoMaximo(){
        return $this->tiempo_maximo_proxima_actuacion . ' ' . $this->getUnidadTiempoMaximo();
    }

    public function getUnidadTiempoMaximo(){
        $value = $this->unidad_tiempo_proxima_actuacion;
        switch($value) {
            case 1: return 'días';
            case 2: return 'semanas';
            case 3: return 'meses';
            case 4: return 'años';
            default: return 'días';
        }
    }
}
