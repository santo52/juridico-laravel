<?php

namespace App\Entities;

use App\BaseModel;
use App\Builders\ProcesoEtapaActuacionPlantillasBuilder;

class ProcesoEtapaActuacionPlantillas extends BaseModel
{
    protected $table = 'proceso_etapa_actuacion_plantillas';

    protected $primaryKey = 'id_proceso_etapa_actuacion_plantillas';

    public $timestamps = false;

    protected $fillable = [
        "id_proceso_etapa_actuacion_plantillas", "id_proceso_etapa_actuacion",
        "id_proceso_etapa", "id_proceso", "id_plantilla_documento"
    ];

    public function newEloquentBuilder($builder)
    {
        return new ProcesoEtapaActuacionPlantillasBuilder($builder, $this);
    }

    public function plantillaDocumento() {
        return $this->hasOne('App\Entities\PlantillaDocumento', 'id_plantilla_documento', 'id_plantilla_documento');
    }

    public function proceso() {
        return $this->hasOne('App\Entities\Proceso', 'id_proceso', 'id_proceso');
    }

    public function getNombrePlantilla() {
        return $this->plantillaDocumento->nombre_plantilla_documento;
    }
}
