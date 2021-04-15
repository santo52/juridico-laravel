<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\TipoResultado;
use Maatwebsite\Excel\Concerns\FromArray;

class TipoResultadoExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = TipoResultado::where('eliminado', 0)->get();
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
            'Tipo de resultado',
            'Grupo',
            'Tipo de Campo',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_tipo_resultado,
            $item->nombre_tipo_resultado,
            $item->getGrupo(),
            $item->getTipoCampo(),
            $item->fecha_creacion,
            $item->eliminado == 1 ? 'Eliminado' : 'Activo'
        ];
    }
}
