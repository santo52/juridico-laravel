<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'proceso';

    protected $primaryKey = 'id_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_proceso", "id_cliente", "id_tipo_proceso", "id_entidad_demandada", "id_usuario_responsable", "valor_estudio", "fecha_retiro_servicio", "id_ultima_entidad_servicio", "id_acto_administrativo_retiro", "id_municipio", "normatividad_aplicada_caso", "observaciones_caso", "codigo_indice_archivos", "estado_proceso", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", 'eliminado'
    ];
}
