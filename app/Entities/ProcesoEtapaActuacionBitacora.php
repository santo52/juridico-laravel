<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\Usuario;

class ProcesoEtapaActuacionBitacora extends BaseModel
{
    protected $table = 'proceso_etapa_actuacion_bitacora';

    protected $primaryKey = 'id_proceso_etapa_actuacion_bitacora';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa_actuacion_bitacora', 'id_usuario', 'comentario',
        'fecha_creacion', 'fecha_actualizacion', 'id_proceso_etapa_actuacion',
        'sesion_id'
    ];

    public function usuario()
    {
        return $this->hasOne('App\Entities\Usuario', 'id_usuario', 'id_usuario');
    }

    public function getFechaCreacion() {
        return date('d/m/Y h:i A', strtotime($this->fecha_creacion));
    }

    public function getNombreCompleto() {
        return $this->usuario->getNombreCompleto();
    }
}
