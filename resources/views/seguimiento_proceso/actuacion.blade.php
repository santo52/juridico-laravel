@section('title', 'Jurídico | Detalle de la actuación')

@section('content')

<div>

    @if($procesoEtapa->finalizado == 0)
    <div class="alert alert-warning" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Importante:</span>
        <b>Esta actuación no se cerrará hasta que todos los campos esten llenos y los documentos esten cargados</b>
    </div>
    @endif

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



    <form id="formularioActuacion" onsubmit="seguimientoActuacion.guardarActuacion(event)">

        <input type="hidden" name="id_proceso" id="id_proceso" value="{{$procesoEtapa->id_proceso}}" />
        <input type="hidden" name="id_proceso_etapa" id="id_proceso_etapa"
            value="{{$procesoEtapa->id_proceso_etapa}}" />
        <input type="hidden" name="id_proceso_etapa_actuacion" id="id_proceso_etapa_actuacion"
            value="{{$procesoEtapa->id_proceso_etapa_actuacion}}" />
        <input type="hidden" name="id_actuacion" id="id_actuacion" value="{{$actuacion->id_actuacion}}" />
        <input type="hidden" name="tipo_resultado" id="tipo_resultado" value="{{$actuacion->tipo_resultado}}" />
        <input type="hidden" id="finalizado" value="{{$procesoEtapa->finalizado}}" />
        <input type="hidden" id="id_etapa_proceso" value="{{$procesoEtapa->id_etapa_proceso}}" />



        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Fecha de inicio de la actuación</label>
                <input type="text" class="form-control" @isset($procesoEtapa->actuacion)
                value="{{$procesoEtapa->getFechaInicioString() }}" @else value="Sin iniciar" @endisset disabled />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_fin" class="control-label">Fecha fin</label>
                <input type="text" class="form-control" @isset($procesoEtapa->actuacion)
                value="{{$procesoEtapa->getFechaFinString() }}" @else value='Sin iniciar' @endisset disabled />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label class="control-label">Asignado por</label>
                <input type="text" class="form-control" @isset($procesoEtapa->actuacion)
                value="{{$procesoEtapa->getAsignadoPor() }}" @else value='Sin asignar' @endisset disabled />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label class="control-label">Persona responsable</label>
                <input type="text" class="form-control" @isset($procesoEtapa->actuacion)
                value="{{$procesoEtapa->getResponsable() }}" @else value='Sin responsable' @endisset disabled />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <label for="fecha_inicio" class="control-label">Valor del cobro</label>
                @if($actuacion->actuacion_tiene_cobro == 1)
                <input type="number" id="valor_pago" name="valor_pago" class="form-control" value="{{$procesoEtapa->valor_pago }}" />
                @else
                <input type="text" id="valor_pago" name="valor_pago" class="form-control" value="No genera cobro" disabled />
                @endif
            </div>
            @if($actuacion->tipo_resultado != 4)
            <div class="col-xs-12 col-sm-6">
                <label for="resultado" class="control-label">Resultado <span
                        style="font-weight: initial;font-size: 1rem;">({{$actuacion->getTipoResultado()}})<span></label>
                @if($actuacion->tipo_resultado == 1)
                @if($procesoEtapa->id_proceso_etapa_actuacion)
                    <div id="resultado_actuacion_file" class="file-document small" @if($procesoEtapa->resultado_actuacion) data-filename="/uploads/documentos/{{$procesoEtapa->resultado_actuacion}}" @endif data-id="{{$procesoEtapa->id_proceso_etapa_actuacion}}" data-title="resultado"></div>
                @else
                <div class="file-document-empty small" style="height:34px;padding:8px;">Documento resultado</div>
                @endif
                @elseif(in_array($actuacion->tipo_resultado, [3, 10, 11]))
                <input name="resultado_actuacion" id="resultado_actuacion" data-date-format="yyyy-mm-dd"
                    class="form-control datepicker-here" @if($procesoEtapa)
                    value="{{$procesoEtapa->resultado_actuacion }}" @endif />
                @elseif(in_array($actuacion->tipo_resultado, [8, 9, 13]))
                <input type="number" name="resultado_actuacion" class="form-control numeric"
                    value="{{ $procesoEtapa->resultado_actuacion }}" />
                @else
                <input type="text" name="resultado_actuacion" class="form-control"
                    value="{{ $procesoEtapa->resultado_actuacion }}" />
                @endif
            </div>
            @else
            <div class="col-xs-12 col-sm-3">
                <label for="fecha_resultado" class="control-label">Fecha de resultado <span
                        style="font-weight: initial;font-size: 1rem;">({{$actuacion->getTipoResultado()}})<span></label>
                <input name="fecha_resultado" id="fecha_resultado" data-date-format="yyyy-mm-dd"
                class="form-control datepicker-here" @if($procesoEtapa)
                value="{{$procesoEtapa->fecha_resultado }}" @endif />
            </div>
            <div class="col-xs-12 col-sm-3">
                <label for="resultado" class="control-label">Resultado <span
                        style="font-weight: initial;font-size: 1rem;">({{$actuacion->getTipoResultado()}})<span></label>
                <input type="text" name="resultado_actuacion" class="form-control"
                    value="{{ $procesoEtapa->resultado_actuacion }}" />
            </div>
            @endif
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
        @isset($procesoEtapa->actuacion)
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
                            <button type="button" class="btn btn-success"
                                onclick="seguimientoActuacion.openTemplateModal()">+</button>
                        </span>
                    </div>
                    <div id="documentos-generados">
                        @if(count($documentosGenerados))
                        @foreach ($documentosGenerados as $item)
                        <div class="file-document" data-title="{{$item->getNombrePlantilla()}}"
                            data-remove="seguimientoActuacion.deletePlantilla('{{$item->id_proceso_etapa_actuacion_plantillas}}')"
                            data-id="{{$item->id_proceso_etapa_actuacion_plantillas}}" data-filename="{!! asset("uploads/plantillas/actuacion-proceso/{$item->id_proceso_etapa_actuacion_plantillas}.pdf")!!}"></div>
                        @endforeach
                        @else
                        <div class="file-document-empty">No se han agregado documentos</div>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
        @if($procesoEtapa->finalizado == 0)
        <div class="alert alert-warning" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Importante:</span>
            <b>Esta actuación no se cerrará hasta que todos los campos esten llenos y los documentos esten cargados</b>
        </div>
        @endif
        @endisset
        <button class="btn btn-success" style="width: 100%">Guardar actuación</button>
    </form>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="plantillasModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="seguimientoActuacion.closeTemplateModal()"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Documentos generados</h4>
            </div>
            <form onsubmit="seguimientoActuacion.savePlantilla(event)">
                <div class="modal-body">
                    <input type="hidden" class="required" name="id_proceso_bitacora" id="idProcesoBitacora" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Lista de plantillas</label>
                        <select class="form-control" id="plantillaDocumento" name="id_plantilla_documento"
                            title="Seleccionar">
                            @foreach($plantillas as $plantilla)
                            <option value="{{$plantilla->id_plantilla_documento}}">
                                {{$plantilla->nombre_plantilla_documento}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer center">
                    <button type="button" class="btn btn-default"
                        onclick="seguimientoActuacion.closeTemplateModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="cerrarActuacion">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cierre de actuación</h4>
            </div>
            <form onsubmit="seguimientoActuacion.finalizarActuacion(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="siguienteEtapaActuacion" class="control-label">Etapa de la siguiente actuación</label>
                        <select class="form-control required" id="siguienteEtapaActuacion" title="Seleccionar" onchange="seguimientoActuacion.refreshActuaciones(this)">
                            @foreach ($etapas as $item)
                            <option value="{{$item->id_etapa_proceso}}" @if($item->id_etapa_proceso === $procesoEtapa->id_etapa_proceso) selected @endif>{{$item->nombre_etapa_proceso}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="siguienteActuacion" class="control-label">Siguiente actuación</label>
                        <select class="form-control required" id="siguienteActuacion"></select>
                    </div>
                    <div class="form-group">
                        <label for="usuarioSiguienteActuacion" class="control-label">Asignado a</label>
                        <select class="form-control required" id="usuarioSiguienteActuacion" title="Seleccione">
                            @foreach ($usuarios as $item)
                            <option value="{{$item->id_usuario}}">{{$item->getNombreCompleto()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Cerrar actuación</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        const id = getId()
        $('#documentos-generados .file-document, #documentos-requeridos .file-document').fileDocument({
            url: 'seguimiento-procesos/upload',
            path: 'uploads/documentos',
            id
        })

        $('#resultado_actuacion_file').fileDocument({
            url: 'seguimiento-procesos/resultado/upload',
            path: 'uploads/documentos',
            id
        })

        seguimientoActuacion.refreshActuaciones($('#siguienteEtapaActuacion'))

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
