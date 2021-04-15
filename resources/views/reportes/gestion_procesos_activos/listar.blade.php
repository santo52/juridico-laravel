@section('title', 'Juridico | Gestión de procesos activos')

@section('content')

<form onsubmit="gestionProcesosActivos.generatePDF(event)">

    <div class="form-group row">
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Desde</label>
            <input name="fecha_desde" id="fecha_desde" data-date-format="yyyy-mm-dd" class="form-control datepicker-here required"/>
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Hasta</label>
            <input name="fecha_hasta" id="fecha_hasta" data-date-format="yyyy-mm-dd" class="form-control datepicker-here required"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Tipo de proceso</label>
            <select data-live-search="true" class="form-control" name="id_tipo_proceso" id="id_tipo_proceso">
                <option selected value="">Todas</option>
                @foreach ($tiposProceso as $item)
                    <option value="{{$item->id_tipo_proceso}}">{{$item->nombre_tipo_proceso}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Tipo de actuación</label>
            <select data-live-search="true" class="form-control" name="tipo_actuacion" id="tipo_actuacion">
                <option selected value="">Todas</option>
                <option value="1">Interno</option>
                <option value="2">Externo</option>
                <option value="3">Rama</option>
            </select>
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Etapa</label>
            <select data-live-search="true" class="form-control" name="id_etapa_proceso" id="id_etapa_proceso">
                <option selected value="">Todas</option>
                @foreach ($etapasProceso as $item)
                    <option value="{{$item->id_etapa_proceso}}">{{$item->nombre_etapa_proceso}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Actuación</label>
            <select class="form-control" name="id_actuacion" id="id_actuacion">
                <option selected value="">Todas</option>
                @foreach ($actuaciones as $item)
                    <option value="{{$item->id_actuacion}}">{{$item->nombre_actuacion}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Entidad de justicia primera instancia</label>
            <select data-live-search="true" class="form-control" id="id_entidad_primera_instancia"
                name="id_entidad_primera_instancia" title="Seleccionar">
                <option selected value="">Todas</option>
                @foreach ($entidades as $item)
                    @if($item->aplica_primera_instancia == 1)
                        <option value="{{$item->id_entidad_justicia}}">{{$item->nombre_entidad_justicia}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Entidad de justicia segunda instancia</label>
            <select data-live-search="true" class="form-control" id="id_entidad_segunda_instancia"
                name="id_entidad_segunda_instancia">
                <option selected value="">Todas</option>
                @foreach ($entidades as $item)
                    @if($item->aplica_segunda_instancia == 1)
                        <option value="{{$item->id_entidad_justicia}}">{{$item->nombre_entidad_justicia}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Descargar informe</button>
</form>

@endsection
