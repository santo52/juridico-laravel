<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Usuario;

class ProcesoEtapaActuacionBitacora extends Model
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

    public function getFechaCreacion() {
        return date('d/m/Y h:i A', strtotime($this->fecha_creacion));
    }

    public function getNombreCompleto() {
        $usuario = Usuario::find($this->id_usuario);
        return $usuario->getNombreCompleto();
    }
}
