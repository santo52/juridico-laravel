<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Entities\Intermediario;
use Maatwebsite\Excel\Concerns\FromArray;

class IntermediarioExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $dataset = Intermediario::where('eliminado', 0)->get();
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
            'Abreviación tipo de documento',
            'Tipo de documento',
            'Número de documento',
            'Nombres completos',
            'Número telefónico',
            'Correo electrónico',
            'Municipio',
            'Departamento',
            'Pais',
            'Fecha de creación',
            'Estado'
        ];
    }

    private function getData($item) {

        return [
            $item->id_intermediario,
            $item->persona->getSiglasTipoDocumento(),
            $item->persona->getTipoDocumento(),
            $item->persona->numero_documento,
            $item->getNombreCompleto(),
            "(+{$item->persona->getIndicativo()}) {$item->persona->telefono}",
            $item->persona->correo_electronico,
            $item->persona->getMunicipio(),
            $item->persona->getDepartamento(),
            $item->persona->getPais(),
            $item->fecha_creacion,
            $item->estado_intermediario == 2 ? 'Inactivo' : 'Activo'
        ];
    }
}
