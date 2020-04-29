<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EntidadJusticia extends Model
{
    protected $table = 'entidad_justicia';

    protected $primaryKey = 'id_entidad_justicia';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_entidad_justicia", "nombre_entidad_justicia", "aplica_primera_instancia", "aplica_segunda_instancia", "estado_entidad_justicia", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
