<?php

namespace App\Entities;

use \App\BaseModel;
use App\Collection\ActuacionCollection;
use App\Builders\Builder;


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

    public function tipoResultado() {
        return $this->belongsTo('App\Entities\TipoResultado', 'tipo_resultado', 'id_tipo_resultado');
    }

    public function etapas()
    {
        return $this->belongsToMany('App\Entities\EtapaProceso', 'actuacion_etapa_proceso', 'id_actuacion', 'id_etapa_proceso')
            ->withPivot('tiempo_maximo_proxima_actuacion', 'unidad_tiempo_proxima_actuacion', 'id_usuario_creacion', 'order');
    }

    public function newCollection(array $models = []) {
        return new ActuacionCollection($models);
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }

    public static function getTiposResultado() {
        return [
            1 => 'Documento',
            2 => 'Dato alfanumerico',
            3 => 'Dato alfanumerico',
            4 => 'Fecha',
            5 => 'Histórico de sentencias', // Mostrar en historico de sentencias, actualiza fecha y resultado
            6 => 'Número del Radicado',
            7 => 'Entidad de Justicia en primera instancia',
            8 => 'Entidad de justicia en segunda instancia',
            9 => 'Cuantía de la demanda',
            10 => 'Estimación de pretensiones',
            11 => 'Fecha de radicación del cumplimiento',
            12 => 'Fecha de pago',
            13 => 'Ubicación física del archivo muerto',
            14 => 'Valor final sentencia',
            15 => 'Magistrado ponente'
        ];
    }

    public function getTipoResultado(){
        $tipoResultado = $this->tipoResultado;
        return $tipoResultado ? $tipoResultado->nombre_tipo_resultado : 'Alfanumerico';
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
