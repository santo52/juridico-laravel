<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\Documento;
use Maatwebsite\Excel\Concerns\FromArray;

class DocumentoExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = Documento::where('eliminado', 0)->get();
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
            'Documento',
            '¿Obligatorio?',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_documento,
            $item->nombre_documento,
            $item->obligatoriedad_documento == 1 ? 'Sí' : 'No',
            $item->fecha_creacion,
            $item->estado_documento == 2 ? 'Inactivo' : 'Activo'
        ];
    }
}
