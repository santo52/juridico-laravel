@section('title', 'Juridico | Estadl de cuenta procesos')

@section('content')

<form onsubmit="estadoCuentaReporte.generatePDF(event)">
    <div class="form-group row">
        <div class="col-xs-12">
            <label for="valor_estudio" class="control-label">Cliente</label>
            <select data-live-search="true" class="form-control required" name="id_cliente" id="id_cliente">
                <option value="">Seleccione ...</option>
                @foreach ($clientes as $item)
                    <option value="{{$item->id_cliente}}">{{$item->getNumeroDocumento()}} - {{$item->getNombreCompleto()}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-xs-12 col-sm-6">
            <label for="valor_estudio" class="control-label">Tipo de proceso</label>
            <select data-live-search="true" class="form-control" name="id_tipo_proceso" id="id_tipo_proceso">
                <option selected value="">Todas</option>
                @foreach ($tiposProceso as $item)
                    <option value="{{$item->id_tipo_proceso}}">{{$item->nombre_tipo_proceso}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="valor_estudio" class="control-label">Actuación</label>
            <select class="form-control" name="id_actuacion" id="id_actuacion">
                <option selected value="">Todas</option>
                @foreach ($actuaciones as $item)
                    <option value="{{$item->id_actuacion}}">{{$item->nombre_actuacion}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Descargar informe</button>
</form>

@endsection
