<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Usuario;

class ProcesoEtapaBitacora extends Model
{
    protected $table = 'proceso_etapa_bitacora';

    protected $primaryKey = 'id_proceso_etapa_bitacora';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_etapa_bitacora', 'id_usuario', 'comentario',
        'fecha_creacion', 'fecha_actualizacion', 'proceso_etapa', 'sesion_id'
    ];

    public function getFechaCreacion() {
        return date('d/m/Y h:i A', strtotime($this->fecha_creacion));
    }

    public function getNombreCompleto() {
        $usuario = Usuario::find($this->id_usuario);
        return $usuario->getNombreCompleto();
    }
}
