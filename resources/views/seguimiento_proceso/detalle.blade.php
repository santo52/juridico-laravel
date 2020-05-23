@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<div>

    <!--  -->

    @if($proceso->dar_informacion_caso != 1)
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Precaución:</span>
        <b>Este cliente NO AUTORIZA dar algún tipo de información sobre el proceso a otras personas</b>
    </div>
    @endif

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Información del proceso
            </a>
        </li>
        <li role="presentation">
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Etapa 1
            </a>
        </li>
    </ul>

    <form class="tab-content" onsubmit="proceso.upsert(event)">
        @if ($proceso)
        <input type="hidden" name="id_proceso" value="{{$proceso->id_proceso}}" />
        @endif
        <div role="tabpanel" class="tab-pane active" id="informacion-proceso">
            <div class="form-group row">
                @if($proceso)
                <div class="col-xs-12 col-sm-4">
                    <label for="telefono" class="control-label">Fecha de creación</label>
                    <input type="text" class="form-control" @if($proceso) value="{{$proceso->fecha_creacion }}" @endif
                        disabled />
                </div>
                @endif
                <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
                    <label for="telefono" class="control-label">Número de proceso</label>
                    <input type="text" disabled class="form-control" id="numero_proceso" name="numero_proceso"
                        @if($proceso) value="{{$proceso->numero_proceso }}" @endif />
                </div>
                <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
                    <label for="telefono" class="control-label">Identificación de la carpeta física</label>
                    <input type="text" disabled class="form-control" id="id_carpeta" name="id_carpeta" @if($proceso)
                        value="{{$proceso->id_carpeta }}" @endif />
                </div>
            </div>
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_cliente" class="control-label">Cliente</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Cédula cliente</label>
                    <input type="text" class="form-control" id="documento_cliente" @if($proceso)
                        value="{{$proceso->celular }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono cliente</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">+1</span>
                        <input disabled type="text" class="form-control required" id="telefono_cliente">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Nombre intermediario</label>
                    <input type="text" class="form-control" id="nombre_intermediario" @if($proceso)
                        value="{{$proceso->celular }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono intermediario</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_intermediario">+1</span>
                        <input disabled type="text" class="form-control required" id="telefono_intermediario">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Correo electrónico intermediario</label>
                    <input type="text" class="form-control" id="email_intermediario" @if($proceso)
                        value="{{$proceso->celular }}" @endif disabled />
                </div>
            </div>
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_tipo_proceso" class="control-label">Tipo de proceso</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_entidad_demandada" class="control-label">Entidad demandada</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="fecha_retiro_servicio" class="control-label">Fecha de retiro del servicio</label>
                    <input disabled id="fecha_retiro_servicio" data-date-format="yyyy-mm-dd"
                        class="form-control datepicker-here" @if($proceso) value="{{$proceso->fecha_retiro_servicio }}"
                        @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_entidad_justicia" class="control-label">Última entidad de servicio (entidad de
                        justicia)</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label for="id_acto_administrativo_retiro" class="control-label">Acto administrativo del retiro
                        (actuación)</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="normatividad_aplicada_caso" class="control-label">Normatividad aplicada al caso</label>
                    <input disabled type="text" class="form-control" id="normatividad_aplicada_caso"
                        name="normatividad_aplicada_caso" @if($proceso)
                        value="{{$proceso->normatividad_aplicada_caso }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_pais" class="control-label">Pais</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_departamento" class="control-label">Departamento</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_municipio" class="control-label">Municipio</label>
                    <input type="text" disabled class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label for="observaciones_caso" class="control-label">Observaciones del caso</label>
                <textarea disabled rows="4" style="resize: vertical; min-height: 100px"
                    class="form-control required">@if($proceso){{$proceso->observaciones_caso}}@endif</textarea>
            </div>
        </div>

        <button class="btn btn-success" style="width: 100%">Guardar proceso</button>
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

        !id && $('#documentos-proceso-tab').hide()
    })
</script>
@endsection
