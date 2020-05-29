<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Entities\Actuacion;

class ActuacionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Actuacion::select(
            "id_actuacion",
            "nombre_actuacion",
            // "genera_alertas",
            // "aplica_control_vencimiento",
            "dias_vencimiento",
            "dias_vencimiento_unidad",
            "dias_vencimiento_tipo",
            // "requiere_estudio_favorabilidad",
            "actuacion_tiene_cobro",
            // "valor_actuacion",
            // "actuacion_creacion_cliente",
            // "mostrar_datos_radicado",
            // "mostrar_datos_juzgado",
            // "mostrar_datos_respuesta",
            // "mostrar_datos_apelacion",
            // "mostrar_datos_cobros",
            // "programar_audiencia",
            // "control_entrega_documentos",
            // "generar_documentos",
            "actuacion.fecha_creacion",
            "uc.nombre_usuario as creador",
            "actuacion.fecha_actualizacion",
            "ua.nombre_usuario as actualizador"
        )
        ->leftJoin('usuario as uc', 'uc.id_usuario', '=', 'actuacion.id_usuario_creacion')
        ->leftJoin('usuario as ua', 'ua.id_usuario', '=', 'actuacion.id_usuario_actualizacion')
        ->where('estado_actuacion', 1)
        ->get()
        ->toHuman();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre actuación',
            // '¿Genera alertas?',
            // '¿Aplica control de vencimiento?',
            'Tiempo de vencimiento',
            'Unidad',
            'Tipo',
            // '¿Requiere estudio de favorabilidad?',
            "¿La actuación tiene cobro?",
            // "Valor de la actuación",
            // "Actuación para creación de cliente",
            // "¿Mostrar datos de radicado?",
            // "¿Mostrar datos de juzgado?",
            // "¿Mostrar datos de respuesta?",
            // "¿Mostrar datos de apelación?",
            // "¿Mostrar datos de cobros?",
            // "¿Programar audiencia?",
            // "Control de entrega de documentos",
            // "¿Generar documentos?",
            "Fecha de creación",
            "Usuario que creó",
            "Ultima actualización",
            "Usuario que actualizó"
        ];
    }
}
