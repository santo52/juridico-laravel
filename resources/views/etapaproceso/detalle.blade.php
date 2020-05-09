@section('content')

<form role="form" id="form-crear-actuacion"
    onSubmit="{{ isset($actuacion) ? 'actuacion.update(event)' : 'actuacion.create(event)' }} ">
    <div class="row">
        <div class="col-sm-4">
            <div class="page-header">
                <h4>Información de la etapa</h4>
            </div>
            <div class="jumbotron">
                <div class="form-group">
                    <label class="lblForm">* Nombre de la etapa</label>
                    <input value="{{ isset($etapaProceso) ? $etapaProceso['nombre_etapa'] : ''}}" type="text"
                        name="nombreActuacion" class="form-control required" />
                </div>
                <div class="form-group">
                    <label class="lblForm">* Estado de la etapa</label>
                    <div class="input-group">
                        <input type="checkbox" name="estado" data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                            data-width="100"
                            {{ !isset($actuacion) || $actuacion['genera_alertas'] == '1' ?  'checked' : '' }} />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header">
                <h4>Asociar Actuaciones</h4>
            </div>
            <div class="jumbotron">
                <div class="form-group">
                    <label class="lblForm">* Nombre de la etapa</label>
                    <select class="form-control selectpicker" title="Seleccionar para agregar">
                        @foreach ($actuaciones as $actuacion)
                    <option value="{{$actuacion->id_actuacion}}">{{$actuacion->nombre_actuacion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <table class="table" data-empty="Sin actuaciones asociadas">
                        <thead>
                            <tr>
                                <th>Actuacion</th>
                                <th>Tiempo máximo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @isset($actuaciones)
                            @foreach ($actuaciones as $item)
                            <tr data-id="{{ $item->id_actuacion_etapa_proceso }}">
                                <td>{{$item->nombre_etapa_proceso}}</td>
                                <td>
                                    {{$item->tiempo_maximo_proxima_actuacion}}
                                    @if($item->unidad_tiempo_proxima_actuacion == 2)
                                    Semanas
                                    @elseif($item->unidad_tiempo_proxima_actuacion == 3)
                                    Meses
                                    @elseif($item->unidad_tiempo_proxima_actuacion == 4)
                                    Años
                                    @else
                                    Días
                                    @endif

                                </td>
                                <td class="center" width="50px">
                                    <div class="flex space-between">
                                        <a href="javascript:void(0)" class="text-primary"
                                            onclick="actuacion.etapaModal({{ $item->id_actuacion_etapa_proceso }});">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="javascript:void(0)" class="text-danger"
                                            onclick="actuacion.removeEtapaModal({{ $item->id_actuacion_etapa_proceso }} );">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    <table>
                </div>
            </div>
        </div>
    </div>
    <div id="dvMensaje"></div>
</form>
@endsection


@section('javascript')
<script>
    $(document).ready(function(){
        $("#sortable").sortable({
            start: etapaProceso.sortableStart,
            stop: etapaProceso.sortableStop,
            update: etapaProceso.sortableUpdate,
        }).disableSelection()
    })
</script>
@endsection
