<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Usuario;
use Illuminate\Support\Facades\Session;

class ProcesoBitacora extends Model
{
    protected $table = 'proceso_bitacora';

    protected $primaryKey = 'id_proceso_bitacora';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_bitacora', 'id_usuario', 'comentario',
        'fecha_creacion', 'fecha_actualizacion', 'id_proceso', 'sesion_id'
    ];

    public function getFechaCreacion() {
        return date('Y-m-d h:i:s', strtotime($this->fecha_creacion));
    }

    public function getNombreCompleto() {
        $usuario = Usuario::find($this->id_usuario);
        return $usuario->getNombreCompleto();
    }

    public function canEdit() {
        return $this->sesion_id === Session::getId();
    }
}
