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
                                <input value="{{ isset($actuacion) ? $actuacion['nombre_actuacion'] : ''}}" type="text"
                                    id="nombreActuacion" name="nombreActuacion" class="form-control required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Genera alertas?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="generaAlertas" name="generaAlertas" data-toggle="toggle"
                                        data-on="Enabled" data-off="Disabled"
                                        {{ !isset($actuacion) || $actuacion['genera_alertas'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Aplica control de vencimiento?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="aplicaControlVencimiento" name="aplicaControlVencimiento"
                                        {{ !isset($actuacion) || $actuacion['aplica_control_vencimiento'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="lblForm">Días de vencimiento</label>
                                <input maxlength="5" autocomplete="off" type="text" id="diasVencimiento"
                                    name="diasVencimiento" class="form-control required numeric"
                                    value="{{ isset($actuacion) ? $actuacion['dias_vencimiento'] : '' }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Requiere estudio de favorabilidad?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="requiereEstudioFavorabilidad"
                                        name="requiereEstudioFavorabilidad"
                                        {{ !isset($actuacion) || $actuacion['requiere_estudio_favorabilidad'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿La actuación tiene cobro?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="actuacionTieneCobro" name="actuacionTieneCobro"
                                        {{ !isset($actuacion) || $actuacion['actuacion_tiene_cobro'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">Valor de la actuación</label>
                                <input maxlength="10" autocomplete="off" type="text" id="valorActuacion"
                                    name="valorActuacion" class="form-control required money"
                                    value="{{ isset($actuacion) ? intval($actuacion['valor_actuacion']) : '' }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">Actuación para creación de cliente</label>
                                <div class="input-group">
                                    <input type="checkbox" id="actuacionCreacionCliente" name="actuacionCreacionCliente"
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
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_radicado'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de juzgado?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosJuzgado" name="mostrarDatosJuzgado"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_juzgado'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de respuesta?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosRespuesta" name="mostrarDatosRespuesta"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_respuesta'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de apelación?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosApelacion" name="mostrarDatosApelacion"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_apelacion'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de cobros?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosCobros" name="mostrarDatosCobros"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_cobros'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">¿Programar audiencia?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="programarAudiencia" name="programarAudiencia"
                                        {{ !isset($actuacion) || $actuacion['programar_audiencia'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="lblForm">Control de entrega de documentos</label>
                                <div class="input-group">
                                    <input type="checkbox" id="controlEntregaDocumentos" name="controlEntregaDocumentos"
                                        {{ !isset($actuacion) || $actuacion['control_entrega_documentos'] == '1' ?  'checked' : '' }} />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="lblForm">¿Generar documentos?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="generarDocumentos" name="generarDocumentos"
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

@endsection
