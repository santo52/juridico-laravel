<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Entities\Cliente;
use Maatwebsite\Excel\Concerns\FromArray;

class ClienteExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $clientes = Cliente::where('cliente.eliminado', 0)->get();
        $dataClientes = [];
        foreach($clientes as $cliente) {
            $dataClientes[] = $this->getDataCliente($cliente);
        }
        return $dataClientes;

    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo documento',
            'Número de documento',
            'Nombres Completos',
            'Número telefónico',
            'Celular',
            'Celular 2',
            'Correo electrónico',
            'Fecha de creación',
            'Nombre de quien recomienda',
            'Departamento',
            'Municipio',
            'Dirección',
            'Estado vital'
        ];
    }

    private function getDataCliente($cliente) {

        $persona = $cliente->persona;

        return [
            $cliente->id_cliente,
            $persona->getSiglasTipoDocumento(),
            $persona->numero_documento,
            $persona->getNombreCompleto(),
            $persona->telefono,
            $persona->celular,
            $cliente->celular2,
            $cliente->correo_electronico,
            $cliente->getFechaCreacion('d/m/Y h:i A'),
            $cliente->nombre_persona_recomienda,
            $persona->getDepartamento(),
            $persona->getMunicipio(),
            $persona->direccion,
            $cliente->getEstadoVital()
        ];
    }
}
