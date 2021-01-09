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
            <th>Tipo de proceso</th>
            <th>Fecha de creación</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tiposproceso as $item)
        <tr>
            <th>{{$item->id_tipo_proceso}}</th>
            <th style="text-align:left;padding-left: 5px;" >{{$item->nombre_tipo_proceso}}</th>
            <th>{{$item->fecha_creacion}}</th>
            <th>{{$item->estado_tipo_proceso == 2 ? 'Inactivo' : 'Activo'}}</th>
        </tr>
        @endforeach
    </tbody>
</table>
