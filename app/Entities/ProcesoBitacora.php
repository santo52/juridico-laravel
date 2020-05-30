<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\Usuario;
use Illuminate\Support\Facades\Session;

class ProcesoBitacora extends BaseModel
{
    protected $table = 'proceso_bitacora';

    protected $primaryKey = 'id_proceso_bitacora';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_bitacora', 'id_usuario', 'comentario',
        'fecha_creacion', 'fecha_actualizacion', 'id_proceso', 'sesion_id'
    ];

    public function usuario() {
        return $this->hasOne('App\Entities\Usuario', 'id_usuario', 'id_usuario');
    }

    public function getFechaCreacion() {
        $timestamp = strtotime($this->fecha_creacion);
        return date('d/m/Y h:i A', $timestamp);
    }

    public function getNombreCompleto() {
        return $this->usuario->getNombreCompleto();
    }

    public function canEdit() {
        return $this->sesion_id === Session::getId();
    }

}
