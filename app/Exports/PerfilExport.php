<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\Perfil;
use Maatwebsite\Excel\Concerns\FromArray;

class PerfilExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = Perfil::where('eliminado', 0)->get();
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
            'Perfil',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_perfil,
            $item->nombre_perfil,
            $item->fecha_creacion,
            $item->inactivo == 0 ? 'Activo' : 'Inactivo'
        ];
    }
}
