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
            <th>Entidad de justicia</th>
            <th>Correo electrónico notificaciones</th>
            <th>¿Aplica primera instancia?</th>
            <th>¿Aplica segunda instancia?</th>
            <th>Municipio</th>
            <th>Departamento</th>
            <th>Fecha de creación</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entidades as $item)
        <tr>
            <th>{{$item->id_entidad_justicia}}</th>
            <th style="text-align:left;padding-left: 5px;" >{{$item->nombre_entidad_justicia}}</th>
            <th>{{$item->email_entidad_justicia}}</th>
            <th>{{$item->aplica_primera_instancia == 2 ? 'No' : 'Sí'}}</th>
            <th>{{$item->aplica_segunda_instancia == 2 ? 'No' : 'Sí'}}</th>
            <th>{{$item->getMunicipio()}}</th>
            <th>{{$item->getDepartamento()}}</th>
            <th>{{$item->fecha_creacion}}</th>
            <th>{{$item->estado_entidad_justicia == 2 ? 'Inactivo' : 'Activo'}}</th>
        </tr>
        @endforeach
    </tbody>
</table>
