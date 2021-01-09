<style>
    table {
        border-collapse: collapse;
        font-size: 11px;
    }

    thead tr {
        background: #14aa6b;
        color: #fff;
    }

    th {
        border: 1px solid gray;
        margin: 0;
        padding: 0;
    }

</style>

<table>
    <thead>
        <tr>
            <th>Documento cliente</th>
            <th>Nombre cliente</th>
            <th>Tipo de proceso</th>
            <th>Entidad demandada</th>
            <th>Responsable</th>
            @isset($cobros)
                <th >Valor cobrado</th>
                <th >Valor pagado</th>
            @endisset
            <th>Etapa actual</th>
            {{-- <th data-breakpoints="all" data-filterable="false">Valor del estudio</th> --}}
            <th>Fecha de retiro del servicio</th>
            <th>Última entidad de servicio</th>
            <th>Municipio</th>
            <th>Acto administrativo del retiro</th>
            <th>Normatividad aplicada al caso</th>
            <th>Entidad de justicia primera instancia</th>
            <th>Entidad de justicia segunda instancia</th>
            @if(!isset($cobros))
                <th>Estado</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($procesos as $proceso)
        <tr>
            <td>{{$proceso->cliente->persona->numero_documento}}</td>
            <td>{{$proceso->getNombreCompletoCliente()}}</td>
            <td>{{$proceso->tipoProceso->nombre_tipo_proceso}}</td>
            <td>{{$proceso->entidadDemandada->nombre_entidad_demandada}}</td>
            <td>{{$proceso->responsable ? $proceso->responsable->getNombreCompleto() : 'Sin responsable'}}</td>
            @isset($cobros)
                <td>$ {{number_format($proceso->getTotalCobrado(), 0, ',', '.')}}</td>
                <td>$ {{number_format($proceso->getTotalPagado(), 0, ',', '.')}}</td>
            @endisset
            <td>{{$proceso->etapa ? $proceso->etapa->nombre_etapa_proceso : 'Sin iniciar'}}</td>
            {{-- <td>{{$proceso->valor_estudio}}</td> --}}
            <td>{{$proceso->getFechaRetiroServicio()}}</td>
            <td>{{$proceso->ultima_entidad_retiro}}</td>
            <td>{{$proceso->cliente->persona->municipio->nombre_municipio}}</td>
            <td>{{$proceso->acto_administrativo}}</td>
            <td>{{$proceso->normatividad_aplicada_caso}}</td>
            <td>{{$proceso->getEntidadJusticiaPrimeraInstancia()}}</td>
            <td>{{$proceso->getEntidadJusticiaSegundaInstancia()}}</td>
            @if(!isset($cobros))
                <td>{{$proceso->estado_proceso == 2 ? 'Finalizado' : 'Activo'}}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
