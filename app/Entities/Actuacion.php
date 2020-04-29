<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Actuacion extends Model
{
    protected $table = 'actuacion';

    protected $primaryKey = 'id_actuacion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_actuacion", "nombre_actuacion", "genera_alertas", "aplica_control_vencimiento", "dias_vencimiento", "requiere_estudio_favorabilidad", "actuacion_tiene_cobro", "valor_actuacion", "actuacion_creacion_cliente", "mostrar_datos_radicado", "mostrar_datos_juzgado", "mostrar_datos_respuesta", "mostrar_datos_apelacion", "mostrar_datos_cobros", "programar_audiencia", "control_entrega_documentos", "generar_documentos", "estado_actuacion", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion"
    ];
}
