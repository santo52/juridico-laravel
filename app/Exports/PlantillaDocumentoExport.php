<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\PlantillaDocumento;
use Maatwebsite\Excel\Concerns\FromArray;

class PlantillaDocumentoExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = PlantillaDocumento::where('eliminado', 0)->get();
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
            'Nombre plantilla',
            'Fecha de creación',
            'Estado',
            'Contenido plantilla'
        ];
    }

    private function getData($item) {

        return [
            $item->id_plantilla_documento,
            $item->nombre_plantilla_documento,
            $item->fecha_creacion,
            $item->estado_plantilla_documento == 2 ? 'Inactivo' : 'Activo',
            $item->contenido_plantilla_documento
        ];
    }
}
