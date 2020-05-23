<?php

namespace App\Collection;

use Illuminate\Database\Eloquent\Collection;

class ActuacionCollection extends Collection
{
    public function toHuman(){
        return $this->map(function($item){
            $item['genera_alertas'] = $item['genera_alertas'] == 1 ? 'Sí' : 'No';
            $item['aplica_control_vencimiento'] = $item['aplica_control_vencimiento'] == 1 ? 'Sí' : 'No';
            $item['requiere_estudio_favorabilidad'] = $item['requiere_estudio_favorabilidad'] == 1 ? 'Sí' : 'No';
            $item['actuacion_tiene_cobro'] = $item['actuacion_tiene_cobro'] == 1 ? 'Sí' : 'No';
            $item['actuacion_creacion_cliente'] = $item['actuacion_creacion_cliente'] == 1 ? 'Sí' : 'No';
            $item['mostrar_datos_radicado'] = $item['mostrar_datos_radicado'] == 1 ? 'Sí' : 'No';
            $item['mostrar_datos_juzgado'] = $item['mostrar_datos_juzgado'] == 1 ? 'Sí' : 'No';
            $item['mostrar_datos_respuesta'] = $item['mostrar_datos_respuesta'] == 1 ? 'Sí' : 'No';
            $item['mostrar_datos_apelacion'] = $item['mostrar_datos_apelacion'] == 1 ? 'Sí' : 'No';
            $item['mostrar_datos_cobros'] = $item['mostrar_datos_cobros'] == 1 ? 'Sí' : 'No';
            $item['programar_audiencia'] = $item['programar_audiencia'] == 1 ? 'Sí' : 'No';
            $item['control_entrega_documentos'] = $item['control_entrega_documentos'] == 1 ? 'Sí' : 'No';
            $item['generar_documentos'] = $item['generar_documentos'] == 1 ? 'Sí' : 'No';
            $item['dias_vencimiento'] = number_format($item['dias_vencimiento'], 0, ',', '.');
            $item['valor_actuacion'] = '$ ' . number_format($item['valor_actuacion'], 0, ',', '.');
            $item['estado_actuacion'] = $item['estado_actuacion'] == 1 ? 'Activo' : 'Inactivo';
            return $item;
        });
    }
}
