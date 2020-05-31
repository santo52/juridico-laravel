<?php

namespace App\Entities;

use \App\BaseModel;
use App\Collection\ActuacionCollection;


class Actuacion extends BaseModel
{
    protected $table = 'actuacion';

    protected $primaryKey = 'id_actuacion';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_actuacion", "nombre_actuacion", "genera_alertas", "aplica_control_vencimiento",
        "dias_vencimiento", "requiere_estudio_favorabilidad", "actuacion_tiene_cobro",
        "valor_actuacion", "actuacion_creacion_cliente", "mostrar_datos_radicado",
        "mostrar_datos_juzgado", "mostrar_datos_respuesta", "mostrar_datos_apelacion",
        "mostrar_datos_cobros", "programar_audiencia", "control_entrega_documentos",
        "generar_documentos", "estado_actuacion", "fecha_creacion", "id_usuario_creacion",
        "fecha_actualizacion", "id_usuario_actualizacion", "eliminado", "dias_vencimiento_unidad",
        "tipo_actuacion", "area_responsable", "dias_vencimiento_tipo", "tipo_resultado"
    ];

    public function newCollection(array $models = []) {
        return new ActuacionCollection($models);
    }

    public static function getTiposResultado() {
        return [
            1 => 'Documento',
            2 => 'Dato alfanumerico',
            3 => 'Número del Radicado',
            4 => 'Entidad de Justicia en primera instancia',
            5 => 'Entidad de justicia en segunda instancia',
            6 => 'Cuantía de la demanda (dinero, pesos)',
            7 => 'Estimación de pretensiones (dinero, pesos)',
            8 => 'Histórico de sentencias',
        ];
    }

    public function getDiasVencimiento() {
        if($this->dias_vencimiento == 1){
            $unidad = $this->dias_vencimiento_unidad == 1 ? 'día' : 'mes';
            $tipo = $this->dias_vencimiento_tipo == 1 ? 'calendario' : 'hábil';
        } else {
            $unidad = $this->dias_vencimiento_unidad == 1 ? 'días' : 'meses';
            $tipo = $this->dias_vencimiento_tipo == 1 ? 'calendario' : 'hábiles';
        }
        return $this->dias_vencimiento . ' ' . $unidad . ' ' . $tipo;
    }
}
