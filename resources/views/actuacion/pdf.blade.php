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
            <th>Nombre de la actuación</th>
            {{-- <th>¿Genera alertas?</th> --}}
            {{-- <th>¿Aplica control de vencimiento?</th> --}}
            <th>Tiempo de vencimiento</th>
            {{-- <th>¿Requiere estudio de favorabilidad?</th> --}}
            <th>¿La actuación tiene cobro?</th>
            {{-- <th>Valor de la actuación</th> --}}
            {{-- <th>Actuación para creación de cliente</th> --}}
            {{-- <th>¿Mostrar datos de radicado?</th> --}}
            {{-- <th>¿Mostrar datos de juzgado?</th> --}}
            {{-- <th>¿Mostrar datos de respuesta?</th> --}}
            {{-- <th>¿Mostrar datos de apelación?</th> --}}
            {{-- <th>¿Mostrar datos de cobros?</th> --}}
            {{-- <th>¿Programar audiencia?</th> --}}
            {{-- <th>Control de entrega de documentos</th> --}}
            {{-- <th>¿Generar documentos?</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($actuaciones as $item)
        <tr>
            <th style="text-align:left;padding-left: 5px;" >{{$item->nombre_actuacion}}</th>
            {{-- <th>{{$item->genera_alertas}}</th> --}}
            {{-- <th>{{$item->aplica_control_vencimiento}}</th> --}}
            <th>{{$item->getDiasVencimiento()}}</th>
            {{-- <th>{{$item->requiere_estudio_favorabilidad}}</th> --}}
            <th>{{$item->actuacion_tiene_cobro == 1 ? 'Sí' : 'No'}}</th>
            {{-- <th style="text-align:left;padding-left: 5px;">{{$item->valor_actuacion}}</th> --}}
            {{-- <th>{{$item->actuacion_creacion_cliente}}</th> --}}
            {{-- <th>{{$item->mostrar_datos_radicado}}</th> --}}
            {{-- <th>{{$item->mostrar_datos_juzgado}}</th> --}}
            {{-- <th>{{$item->mostrar_datos_respuesta}}</th> --}}
            {{-- <th>{{$item->mostrar_datos_apelacion}}</th> --}}
            {{-- <th>{{$item->mostrar_datos_cobros}}</th> --}}
            {{-- <th>{{$item->programar_audiencia}}</th> --}}
            {{-- <th>{{$item->control_entrega_documentos}}</th> --}}
            {{-- <th>{{$item->generar_documentos}}</th> --}}
        </tr>
        @endforeach
    </tbody>
</table>
