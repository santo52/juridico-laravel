<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcesoBitacora extends Model
{
    protected $table = 'proceso_bitacora';

    protected $primaryKey = 'id_proceso_bitacora';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_proceso_bitacora', 'id_usuario', 'comentario',
        'fecha_creacion', 'fecha_actualizacion', 'id_proceso'
    ];
}