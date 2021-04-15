<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\TipoProceso;
use Maatwebsite\Excel\Concerns\FromArray;

class TipoProcesoExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = TipoProceso::where('eliminado', 0)->get();
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
            'Tipo de proceso',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_tipo_proceso,
            $item->nombre_tipo_proceso,
            $item->fecha_creacion,
            $item->estado_tipo_proceso == 2 ? 'Inactivo' : 'Activo'
        ];
    }
}
