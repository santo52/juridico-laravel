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
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entidades as $item)
        <tr>
            <th>{{$item->id_entidad_demandada}}</th>
            <th style="text-align:left;padding-left: 5px;" >{{$item->nombre_entidad_demandada}}</th>
            <th>{{$item->email_entidad_demandada}}</th>
            <th>{{$item->estado_entidad_demandada == 2 ? 'Inactivo' : 'Activo'}}</th>
        </tr>
        @endforeach
    </tbody>
</table>
