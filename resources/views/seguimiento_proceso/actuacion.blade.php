@section('title', 'Jurídico | Detalle de la actuación')

@section('content')

<div>

    <!-- Nav tabs -->
    {{-- <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Información del proceso
            </a>
        </li>

        <li role="presentation" id="documentos-proceso-tab" @if (!count($documentos)) style="display: none" @endif>
            <a href="#documentos-proceso" aria-controls="documentos-proceso" role="tab" data-toggle="tab">
                Documentos del proceso
            </a>
        </li>
    </ul> --}}

    <form onsubmit="seguimientoActuacion.upsert(event)">

        <input type="hidden" id="id_proceso" value="{{$procesoEtapa->id_proceso}}" />

        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Fecha de inicio de la actuación</label>
                <input type="text" class="form-control" value="{{$procesoEtapa->getFechaInicioString() }}" disabled />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_fin" class="control-label">Fecha fin</label>
                <input type="text" class="form-control" value="{{$procesoEtapa->getFechaFinString() }}" disabled />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label class="control-label">Asignado por</label>
                <input type="text" class="form-control" value="{{$procesoEtapa->getAsignadoPor() }}" disabled />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label class="control-label">Persona responsable</label>
                <input type="text" class="form-control" value="{{$procesoEtapa->getResponsable() }}" disabled />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Valor del cobro</label>
                @if($actuacion->actuacion_tiene_cobro == 1)
                <input type="text" name="valor_pago" class="form-control" value="{{$procesoEtapa->valor_pago }}" />
                @else
                <input type="text" name="valor_pago" class="form-control" value="No genera cobro" disabled />
                @endif
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="resultado" class="control-label">Resultado</label>
                @if($actuacion->tipo_resultado == 1)
                <div class="input-file">
                    <input type="file" name="resultado_actuacion" />
                </div>
                @else
                <input type="text" name="resultado_actuacion" class="form-control"
                    value="{{ $procesoEtapa->resultado_actuacion }}" />
                @endif
            </div>
        </div>

        <div class="separator margin"></div>

        @if($actuacion->tipo_actuacion == 3)
        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Fecha actuación rama</label>
                <input name="fecha_actuacion_rama" id="fecha_actuacion_rama" data-date-format="yyyy-mm-dd"
                    class="form-control datepicker-here" @if($procesoEtapa)
                    value="{{$procesoEtapa->fecha_actuacion_rama }}" @endif />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Fecha notificación rama</label>
                <input name="fecha_notificacion_rama" id="fecha_notificacion_rama" data-date-format="yyyy-mm-dd"
                    class="form-control datepicker-here" @if($procesoEtapa)
                    value="{{$procesoEtapa->fecha_notificacion_rama }}" @endif />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Fecha inicio termino rama</label>
                <input name="fecha_inicio_termino_rama" id="fecha_inicio_termino_rama" data-date-format="yyyy-mm-dd"
                    class="form-control datepicker-here" @if($procesoEtapa)
                    value="{{$procesoEtapa->fecha_inicio_termino_rama }}" @endif />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Anotación rama</label>
                <input name="anotacion_rama" id="anotacion_rama" class="form-control" @if($procesoEtapa)
                    value="{{$procesoEtapa->anotacion_rama }}" @endif />
            </div>
        </div>
        <div class="separator margin"></div>

        @endif

        <div class="flex space-between documents-container">
            <nav class="navbar navbar-default flex-grow">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h5>Documentos</h5>
                    </div>
                    <div id="documentos-requeridos">
                        @if(!isset($documentos) || !count($documentos))
                        <div class="file-document-empty">No requiere documentos</div>
                        @else
                        @foreach ($documentos as $item)
                        <div class="file-document" data-filename="{{$item->filename}}" data-id="{{$item->id_documento}}"
                            data-title="{{$item->nombre_documento}}" @if($item->obligatoriedad_documento == 1)
                            data-required="true" @else data-required="true" @endif></div>
                        @endforeach
                        @endif

                    </div>
                </div>
            </nav>
            <div style="width:30px;"></div>
            <nav class="navbar navbar-default flex-grow">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h5>Documentos generados</h5>
                        <span class="button-add">
                            <button class="btn btn-success">+</button>
                        </span>
                    </div>
                    <div>
                        <div class="file-document-empty">No se han agregado documentos</div>
                    </div>
                </div>
            </nav>
        </div>


        <button class="btn btn-success" style="width: 100%">Guardar actuación</button>
    </form>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        const id = getId()
        fileDocument.init({
            url: 'proceso/upload',
            path: 'uploads/documentos',
            id
        })

        const idSeguimiento = $('#id_proceso').val()
        const $list = $('#breadcrumb').find('li')

        if(location.hash.includes('crear')) {
            $list.eq(3).children('a').attr('href', 'javascript:void(0)')
            $list.eq(4).remove()
            $list.eq(5).remove()
        }

        $list
        .eq(2)
        .children('a')
        .attr('href', '#seguimiento-procesos/' + idSeguimiento)

    })
</script>
@endsection
