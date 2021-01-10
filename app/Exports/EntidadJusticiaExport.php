<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\EntidadJusticia;
use Maatwebsite\Excel\Concerns\FromArray;

class EntidadJusticiaExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = EntidadJusticia::where('eliminado', 0)->get();
        $dataValues = [];
        foreach($dataset as $item) {
            $dataValues[] = $this->getData($item);
        }
        return $dataValues;

    }

    public function headings(): array
    {
        return [
            'ID',
            'Entidad de justicia',
            'Correo electrónico notificaciones',
            '¿Aplica primera instancia?',
            '¿Aplica segunda instancia?',
            'Municipio',
            'Departamento',
            'Pais',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_entidad_justicia,
            $item->nombre_entidad_justicia,
            $item->email_entidad_justicia,
            $item->aplica_primera_instancia == 2 ? 'No' : 'Sí',
            $item->aplica_segunda_instancia == 2 ? 'No' : 'Sí',
            $item->getMunicipio(),
            $item->getDepartamento(),
            $item->getPais(),
            $item->fecha_creacion,
            $item->estado_entidad_justicia == 2 ? 'Inactivo' : 'Activo'
        ];
    }
}
