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
            <th>ID</th>
            <th>Nombre</th>
            <th>Padre</th>
            <th>Ruta</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @isset ($parents)
        @foreach ($parents as $item)
        <tr class="background-green" id="listRow{{$item['id_menu']}}">
            <td>{{$item['id_menu']}}</td>
            <td>{{$item['nombre_menu']}}</td>
            <td>{{$item['parent_id']}}</td>
            <td>{{$item['ruta_menu']}}</td>
            <td>{{$item['inactivo'] == 0 ? 'Activo' : 'Inactivo'}}</td>
        </tr>
        @isset($item['children'] )
        @foreach ($item['children'] as $child)
        <tr id="listRow{{$child['id_menu']}}">
            <td >{{$child['id_menu']}}</td>
            <td>{{$child['nombre_menu']}}</td>
            <td>{{$item['nombre_menu']}}</td>
            <td>{{$child['ruta_menu']}}</td>
            <td>{{$child['inactivo'] == 0 ? 'Activo' : 'Inactivo'}}</td>
        </tr>


        @endforeach

        @endisset
        @endforeach
        @endisset
    </tbody>
</table>
