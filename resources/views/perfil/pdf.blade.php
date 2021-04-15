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

<table style="width: 100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Perfil</th>
            <th>Fecha de creación</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perfiles as $item)
        <tr>
            <th>{{$item->id_perfil}}</th>
            <th style="text-align:left;padding-left: 5px;" >{{$item->nombre_perfil}}</th>
            <th>{{$item->fecha_creacion}}</th>
            <th>{{$item->inactivo == 0 ? 'Activo' : 'Inactivo'}}</th>
        </tr>
        @endforeach
    </tbody>
</table>
