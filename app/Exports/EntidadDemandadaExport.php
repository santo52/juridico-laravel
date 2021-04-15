<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\EntidadDemandada;
use Maatwebsite\Excel\Concerns\FromArray;

class EntidadDemandadaExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = EntidadDemandada::where('eliminado', 0)->get();
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
            'Entidad demandada',
            'Correo electrónico',
            // 'Pais',
            // 'Departamento',
            // 'Municipio',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_entidad_demandada,
            $item->nombre_entidad_demandada,
            $item->email_entidad_demandada,
            // $item->getPais(),
            // $item->getDepartamento(),
            // $item->getMunicipio(),
            $item->fecha_creacion,
            $item->estado_entidad_demandada == 2 ? 'Inactivo' : 'Activo'
        ];
    }
}
