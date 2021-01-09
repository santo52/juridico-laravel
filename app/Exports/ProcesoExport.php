<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Entities\Proceso;
use Maatwebsite\Excel\Concerns\FromArray;

class ProcesoExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $procesos = Proceso::getAll()->get();
        $dataClientes = [];
        foreach($procesos as $proceso) {
            $dataClientes[] = $this->getData($proceso);
        }
        return $dataClientes;

    }

    public function headings(): array
    {
        return [
            'Documento cliente',
            'Nombre cliente',
            'Tipo de proceso',
            'Entidad demandada',
            'Responsable',
            'Etapa actual',
            'Fecha de retiro del servicio',
            'Última entidad de servicio',
            'Municipio',
            'Acto administrativo del retiro',
            'Normatividad aplicada al caso',
            'Entidad de justicia primera instancia',
            'Entidad de justicia segunda instancia',
        ];
    }

    private function getData($proceso) {

        return [
            $proceso->cliente->persona->numero_documento,
            $proceso->getNombreCompletoCliente(),
            $proceso->tipoProceso->nombre_tipo_proceso,
            $proceso->entidadDemandada->nombre_entidad_demandada,
            $proceso->responsable ? $proceso->responsable->getNombreCompleto() : 'Sin responsable',
            $proceso->etapa ? $proceso->etapa->nombre_etapa_proceso : 'Sin iniciar',
            $proceso->getFechaRetiroServicio(),
            $proceso->ultima_entidad_retiro,
            $proceso->cliente->persona->municipio->nombre_municipio,
            $proceso->acto_administrativo,
            $proceso->normatividad_aplicada_caso,
            $proceso->getEntidadJusticiaPrimeraInstancia(),
            $proceso->getEntidadJusticiaSegundaInstancia(),
        ];
    }
}
