@section('title', 'Juridico | Honorarios y gastos de proceso')

@section('content')

<form onsubmit="honorariosReportes.generatePDF(event)">

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
            <label for="valor_estudio" class="control-label">Cliente</label>
            <select data-live-search="true" class="form-control required" name="id_cliente" id="id_cliente">
                <option selected value="">Seleccionar</option>
                @foreach ($clientes as $item)
                    <option value="{{$item->id_usuario}}">{{$item->getNombreCompleto()}} ({{$item->nombre_usuario}})</option>
                @endforeach}
            </select>
        </div>
        <div class="col-xs-12 col-sm-3">
            <label for="valor_estudio" class="control-label">Intermediario</label>
            <select data-live-search="true" class="form-control" name="id_etapa_proceso" id="id_etapa_proceso">
                <option selected value="">Todas</option>
                @foreach ($intermediarios as $item)
                    <option value="{{$item->id_intermediario}}">{{$item->getNombreCompleto()}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Descargar informe</button>
</form>

@endsection
