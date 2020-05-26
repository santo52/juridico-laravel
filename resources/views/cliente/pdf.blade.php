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
        <tr >
            <th>ID</th>
            <th>Tipo documento</th>
            <th>Número de documento</th>
            <th>Nombres Completos</th>
            <th>Número telefónico</th>
            <th>Celular</th>
            <th>Celular 2</th>
            <th>Correo electrónico</th>
            <th>Fecha de creación</th>
            <th>Nombre de quien recomienda</th>
            <th>Municipio</th>
            <th>Dirección</th>
            <th>Estado vital</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @if (count($clientes) > 0)
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente['id_cliente']}}</td>
            <td>{{$cliente['abreviatura_tipo_documento']}}</td>
            <td>{{$cliente['numero_documento']}}</td>
            <td>{{$cliente->getNombreCompleto()}}</td>
            <td>@if($cliente['indicativo'])<span style="margin-right:2px;">(+{{$cliente['indicativo']}})</span>@endif{{$cliente['telefono']}}</td>
            <td>{{$cliente['celular']}}</td>
            <td>{{$cliente['celular2']}}</td>
            <td>{{$cliente['correo_electronico']}}</td>
            <td>{{$cliente['fecha_creacion']}}</td>
            <td>{{$cliente['nombre_persona_recomienda']}}</td>
            <td>{{$cliente['nombre_municipio']}}</td>
            <td>{{$cliente['direccion']}}</td>
            <td>{{$cliente['estado_vital_cliente']}}</td>
            <td>{{$cliente['estado_cliente'] == 2 ? 'Inactivo' : 'Activo'}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
