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

<table style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo de documento</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Municipio</th>
            <th>Departamento</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($intermediarios as $item)
        <tr>
            <th>{{$item->id_intermediario}}</th>
            <th>{{$item->persona->getSiglasTipoDocumento()}}</th>
            <th>{{$item->persona->numero_documento}}</th>
            <th style="text-align:left;padding-left: 5px;" >{{$item->getNombreCompleto()}}</th>
            <th>(+{{$item->persona->getIndicativo()}}) {{$item->persona->telefono}}</th>
            <th>{{$item->persona->correo_electronico}}</th>
            <th>{{$item->persona->getMunicipio()}}</th>
            <th>{{$item->persona->getDepartamento()}}</th>
            <th>{{$item->estado_intermediario == 2 ? 'Inactivo' : 'Activo'}}</th>
        </tr>
        @endforeach
    </tbody>
</table>
