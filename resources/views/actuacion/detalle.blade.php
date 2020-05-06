@section('title', 'Actuacion')


@section('content')

<form role="form" id="form-crear-actuacion"
    onSubmit="{{ isset($actuacion) ? 'actuacion.update(event)' : 'actuacion.create(event)' }} ">
    <div class="row">
        <div class="col-sm-6">
            <div class="page-header">
                <h4>Información de la actuación</h4>
            </div>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="lblForm">* Nombre de la actuación</label>
                                <input {{!isset($permissions->cambiar_nombre) ? 'disabled' : '' }}
                                    value="{{ isset($actuacion) ? $actuacion['nombre_actuacion'] : ''}}" type="text"
                                    id="nombreActuacion" name="nombreActuacion" class="form-control required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Genera alertas?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="generaAlertas" name="generaAlertas" data-toggle="toggle"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['genera_alertas'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Aplica control de vencimiento?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="aplicaControlVencimiento" name="aplicaControlVencimiento"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['aplica_control_vencimiento'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="lblForm">Días de vencimiento</label>
                                <input {{!isset($permissions->cambiar_dia_de_vencimiento) ? 'disabled' : '' }}
                                    maxlength="5" autocomplete="off" type="text" id="diasVencimiento"
                                    name="diasVencimiento" class="form-control required numeric"
                                    value="{{ isset($actuacion) ? $actuacion['dias_vencimiento'] : '' }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Aplica procedibilidad?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="requiereEstudioFavorabilidad"
                                        name="requiereEstudioFavorabilidad" data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['requiere_estudio_favorabilidad'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿La actuación tiene cobro?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="actuacionTieneCobro" name="actuacionTieneCobro"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['actuacion_tiene_cobro'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">Valor de la actuación</label>
                                <input maxlength="10" autocomplete="off" type="text" id="valorActuacion"
                                    {{!isset($permissions->cambiar_valor) ? 'disabled' : '' }} name="valorActuacion"
                                    class="form-control required money"
                                    value="{{ isset($actuacion) ? intval($actuacion['valor_actuacion']) : '' }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">Actuación para creación de cliente</label>
                                <div class="input-group">
                                    <input type="checkbox" id="actuacionCreacionCliente" name="actuacionCreacionCliente"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['actuacion_creacion_cliente'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de radicado?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosRadicado" name="mostrarDatosRadicado"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_radicado'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de juzgado?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosJuzgado" name="mostrarDatosJuzgado"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_juzgado'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de respuesta?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosRespuesta" name="mostrarDatosRespuesta"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_respuesta'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de apelación?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosApelacion" name="mostrarDatosApelacion"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_apelacion'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de cobros?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosCobros" name="mostrarDatosCobros"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_cobros'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Programar audiencia?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="programarAudiencia" name="programarAudiencia"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['programar_audiencia'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="lblForm">Control de entrega de documentos</label>
                                <div class="input-group">
                                    <input type="checkbox" id="controlEntregaDocumentos" name="controlEntregaDocumentos"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['control_entrega_documentos'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="lblForm">¿Generar documentos?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="generarDocumentos" name="generarDocumentos" data-on="Sí"
                                        data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['generar_documentos'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="page-header">
                <h4>Asociación de documentos</h4>
            </div>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="alertaDocumentos"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label id="documentosAsociados" class="lblForm">* Documentos asociados a la
                                    actuación</label>
                                <select class="form-control" title="Seleccionar" onchange="actuacion.addDocument(this)">
                                    @foreach($documentos as $documento)
                                    <option value="{{ $documento['id_documento'] }}">
                                        {{ $documento['nombre_documento'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label id="platillasAsociadas" class="lblForm">* Plantillas asociadas a la
                                    actuación</label>
                                <select class="form-control" title="Seleccionar"
                                    onchange="actuacion.addDocumentTemplate(this)">
                                    @foreach($plantillasDocumento as $plantillaDocumento)
                                    <option value="{{ $plantillaDocumento['id_plantilla_documento'] }}">
                                        {{ $plantillaDocumento['nombre_plantilla_documento'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-striped table-bordered" id="tblDocumentos" data-empty="">
                                    <thead>
                                        <tr class="titulos">
                                            <th class="text-center">Documento</th>
                                            <th class="text-center">Quitar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($actuacionDocumentos)
                                        @foreach ($actuacionDocumentos as $item)
                                        <tr id="documentsRow{{$item->id_documento}}"
                                            data-value="{{$item->id_documento}}">
                                            <td class="plantillas-documento">{{$item->nombre_documento}}</td>
                                            <td class="center">
                                                <button class="btn btn-danger btn-xs" type="button"
                                                    onclick="actuacion.removeDocument(this);">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-striped table-bordered" id="tblPlantillasDocumento"
                                    data-empty="">
                                    <thead>
                                        <tr class="titulos">
                                            <th class="text-center">Plantilla de documento</th>
                                            <th class="text-center">Quitar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($actuacionPlantillasDocumento)
                                        @foreach ($actuacionPlantillasDocumento as $item)
                                        <tr id="tmpDocumentRow{{$item->id_plantilla_documento}}"
                                            data-value="{{$item->id_plantilla_documento}}">
                                            <td class="plantillas-documento">{{$item->nombre_plantilla_documento}}</td>
                                            <td class="center">
                                                <button class="btn btn-danger btn-xs" type="button"
                                                    onclick="actuacion.removeDocument(this);">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="flex space-between page-header">
                                    <h4>Asociar etapas</h4>
                                    <a class="btn btn-default" onclick="actuacion.etapaModal()">Agregar Etapa</a>
                                </div>
                                <table class="table table-striped table-bordered" id="tblPlantillasDocumento"
                                    data-empty="">
                                    <thead>
                                        <tr class="titulos">
                                            <th class="text-center">Etapa</th>
                                            <th class="text-center">Tiempo límite</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                        @isset($etapasProceso)
                                        @foreach ($etapasProceso as $item)
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
                                </table>
                            </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" id="btnSave" class="btn btn-success btn-ejecutar pull-right">
                                    <span class='glyphicon glyphicon-floppy-disk'></span>
                                    @isset($actuacion)
                                    Actualizar actuación
                                    @else
                                    Crear actuación
                                    @endisset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dvMensaje"></div>
</form>


<div class="modal fade" tabindex="-1" role="dialog" id="etapaModalUpsert">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="etapaModalTitle"></h4>
            </div>
            <form onsubmit="actuacion.etapaUpsert(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">* Etapa</label>
                        <select class="form-control" title="Seleccionar" id="etapasList"
                            name="id_etapa_proceso"></select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">* Tiempo máximo para la próxima
                            actuación</label>
                        <input type="text" class="form-control required numeric" id="etapaMaximoTiempo"
                            name="tiempo_maximo_proxima_actuacion">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">* Unidad de tiempo</label>
                        <select class="form-control" id="etapaUnidadMaximoTiempo"
                            name="unidad_tiempo_proxima_actuacion">
                            <option value="1">Días</option>
                            <option value="2">Semanas</option>
                            <option value="3">Meses</option>
                            <option value="4">Años</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" name="id_actuacion_etapa_proceso" id="etapaModalId" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteEtapaModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar etapa</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar la etapa de la actuación?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteEtapaValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="actuacion.deleteEtapa()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $("#sortable").sortable({
            start: actuacion.sortableStart,
            stop: actuacion.sortableStop,
            update: actuacion.sortableUpdate,
        }).disableSelection()
    })

</script>
@endsection
