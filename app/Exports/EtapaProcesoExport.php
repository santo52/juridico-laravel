<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\EtapaProceso;
use Maatwebsite\Excel\Concerns\FromArray;

class EtapaProcesoExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = EtapaProceso::where('eliminado', 0)->get();
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
            'Etapa',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_etapa_proceso,
            $item->nombre_etapa_proceso,
            $item->fecha_creacion,
            $item->estado_etapa_proceso == 2 ? 'Inactivo' : 'Activo'
        ];
    }
}
