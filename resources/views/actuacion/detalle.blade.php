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
                                <label class="lblForm">Nombre de la actuación</label>
                                <input {{!isset($permissions->cambiar_nombre) ? 'disabled' : '' }}
                                    value="{{ isset($actuacion) ? $actuacion['nombre_actuacion'] : ''}}" type="text"
                                    id="nombreActuacion" name="nombreActuacion" class="form-control required" />
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-5">
                                <label class="lblForm">Tiempo de vencimiento</label>
                                <input {{!isset($permissions->cambiar_dia_de_vencimiento) ? 'disabled' : '' }}
                                    maxlength="5" autocomplete="off" type="text" id="diasVencimiento"
                                    name="diasVencimiento" class="form-control required numeric"
                                    value="{{ isset($actuacion) ? $actuacion['dias_vencimiento'] : '' }}" />
                            </div>
                            <div class="col-sm-3">
                                <label class="lblForm">Unidad</label>
                                <select class="form-control required" name="dias_vencimiento_unidad">
                                    <option @if(isset($actuacion) && $actuacion->dias_vencimiento_unidad == 1) selected
                                        @endif value="1">Días</option>
                                    <option @if(isset($actuacion) && $actuacion->dias_vencimiento_unidad == 2) selected
                                        @endif value="2">Meses</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">Tipo</label>
                                <select class="form-control required" name="dias_vencimiento_tipo">
                                    <option @if(isset($actuacion) && $actuacion->dias_vencimiento_tipo == 1) selected
                                        @endif value="1">Calendario</option>
                                    <option @if(isset($actuacion) && $actuacion->dias_vencimiento_tipo == 2) selected
                                        @endif value="2">Hábiles</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">Tipo de actuación</label>
                                <select class="form-control required" name="tipo_actuacion">
                                    <option @if(isset($actuacion) && $actuacion->tipo_actuacion == 1) selected @endif
                                        value="1">Interno</option>
                                    <option @if(isset($actuacion) && $actuacion->tipo_actuacion == 2) selected @endif
                                        value="2">Externo</option>
                                    <option @if(isset($actuacion) && $actuacion->tipo_actuacion == 3) selected @endif
                                        value="3">Rama</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">Área responsable</label>
                                <select class="form-control required" name="area_responsable">
                                    <option @if(isset($actuacion) && $actuacion->area_responsable == 1) selected @endif
                                        value="1">Recepción</option>
                                    <option @if(isset($actuacion) && $actuacion->area_responsable == 2) selected @endif
                                        value="2">Administración</option>
                                    <option @if(isset($actuacion) && $actuacion->area_responsable == 3) selected @endif
                                        value="3">Agotamientos de Via</option>
                                    <option @if(isset($actuacion) && $actuacion->area_responsable == 4) selected @endif
                                        value="4">Sustanciación</option>
                                    <option @if(isset($actuacion) && $actuacion->area_responsable == 5) selected @endif
                                        value="5">Dependencia</option>
                                    <option @if(isset($actuacion) && $actuacion->area_responsable == 6) selected @endif
                                        value="6">Mensajería</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="lblForm">Tipo de resultado</label>
                                <select class="form-control required" name="tipo_resultado">
                                    <optgroup label="Formatos">
                                    @foreach ($tiposResultado as $key => $item)
                                        @if($key <= 3 )
                                        <option @if(isset($actuacion) && $actuacion->tipo_resultado == $key) selected @endif
                                            value="{{$key}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                    </optgroup>
                                    <optgroup label="Valores específicos">
                                        @foreach ($tiposResultado as $key => $item)
                                            @if($key > 3 )
                                            <option @if(isset($actuacion) && $actuacion->tipo_resultado == $key) selected @endif
                                                value="{{$key}}">{{$item}}</option>
                                            @endif
                                        @endforeach
                                        </optgroup>
                                </select>
                            </div>
                        </div>

                        {{-- <hr> --}}

                        {{-- <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Genera alertas?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="generaAlertas" name="generaAlertas" data-toggle="toggle"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['genera_alertas'] == '1' ?  'checked' : '' }}
                        />
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="lblForm">¿Aplica procedibilidad?</label>
                    <div class="input-group">
                        <input type="checkbox" id="requiereEstudioFavorabilidad" name="requiereEstudioFavorabilidad"
                            data-on="Sí" data-off="No" data-width="60"
                            {{ !isset($actuacion) || $actuacion['requiere_estudio_favorabilidad'] == '1' ?  'checked' : '' }} />
                    </div>
                </div>
                <div> --}}

                    <div class="row">

                        {{-- <div class="col-sm-6">
                                <label class="lblForm">¿Aplica control de vencimiento?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="aplicaControlVencimiento" name="aplicaControlVencimiento"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['aplica_control_vencimiento'] == '1' ?  'checked' : '' }}
                        />
                    </div>
                </div> --}}
                <div class="col-sm-6">
                    <label class="lblForm">¿La actuación tiene cobro?</label>
                    <div class="input-group">
                        <input type="checkbox" id="actuacionTieneCobro" name="actuacionTieneCobro" data-on="Sí"
                            data-off="No" data-width="60"
                            {{ !isset($actuacion) || $actuacion['actuacion_tiene_cobro'] == '1' ?  'checked' : '' }} />
                    </div>
                </div>


            </div>
            {{-- <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Aplica procedibilidad?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="requiereEstudioFavorabilidad"
                                        name="requiereEstudioFavorabilidad" data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['requiere_estudio_favorabilidad'] == '1' ?  'checked' : '' }}
            />
        </div>
    </div>

    <div class="col-sm-4">
        <label class="lblForm">Valor de la actuación</label>
        <input maxlength="10" autocomplete="off" type="text" id="valorActuacion"
            {{!isset($permissions->cambiar_valor) ? 'disabled' : '' }} name="valorActuacion"
            class="form-control required money"
            value="{{ isset($actuacion) ? intval($actuacion['valor_actuacion']) : '' }}" />
    </div>
    </div> --}}
    {{-- <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">Actuación para creación de cliente</label>
                                <div class="input-group">
                                    <input type="checkbox" id="actuacionCreacionCliente" name="actuacionCreacionCliente"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['actuacion_creacion_cliente'] == '1' ?  'checked' : '' }}
    />
    </div>
    </div>
    </div> --}}
    {{-- <hr />
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="lblForm">¿Mostrar datos de radicado?</label>
                                <div class="input-group">
                                    <input type="checkbox" id="mostrarDatosRadicado" name="mostrarDatosRadicado"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['mostrar_datos_radicado'] == '1' ?  'checked' : '' }}
    />
    </div>
    </div>
    <div class="col-sm-4">
        <label class="lblForm">¿Mostrar datos de juzgado?</label>
        <div class="input-group">
            <input type="checkbox" id="mostrarDatosJuzgado" name="mostrarDatosJuzgado" data-on="Sí" data-off="No"
                data-width="60"
                {{ !isset($actuacion) || $actuacion['mostrar_datos_juzgado'] == '1' ?  'checked' : '' }} />
        </div>
    </div>
    <div class="col-sm-4">
        <label class="lblForm">¿Mostrar datos de respuesta?</label>
        <div class="input-group">
            <input type="checkbox" id="mostrarDatosRespuesta" name="mostrarDatosRespuesta" data-on="Sí" data-off="No"
                data-width="60"
                {{ !isset($actuacion) || $actuacion['mostrar_datos_respuesta'] == '1' ?  'checked' : '' }} />
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="lblForm">¿Mostrar datos de apelación?</label>
            <div class="input-group">
                <input type="checkbox" id="mostrarDatosApelacion" name="mostrarDatosApelacion" data-on="Sí"
                    data-off="No" data-width="60"
                    {{ !isset($actuacion) || $actuacion['mostrar_datos_apelacion'] == '1' ?  'checked' : '' }} />
            </div>
        </div>
        <div class="col-sm-4">
            <label class="lblForm">¿Mostrar datos de cobros?</label>
            <div class="input-group">
                <input type="checkbox" id="mostrarDatosCobros" name="mostrarDatosCobros" data-on="Sí" data-off="No"
                    data-width="60"
                    {{ !isset($actuacion) || $actuacion['mostrar_datos_cobros'] == '1' ?  'checked' : '' }} />
            </div>
        </div>
        <div class="col-sm-4">
            <label class="lblForm">¿Programar audiencia?</label>
            <div class="input-group">
                <input type="checkbox" id="programarAudiencia" name="programarAudiencia" data-on="Sí" data-off="No"
                    data-width="60"
                    {{ !isset($actuacion) || $actuacion['programar_audiencia'] == '1' ?  'checked' : '' }} />
            </div>
        </div>
    </div> --}}
    {{-- <div class="row">
                            <div class="col-sm-6">
                                <label class="lblForm">Control de entrega de documentos</label>
                                <div class="input-group">
                                    <input type="checkbox" id="controlEntregaDocumentos" name="controlEntregaDocumentos"
                                        data-on="Sí" data-off="No" data-width="60"
                                        {{ !isset($actuacion) || $actuacion['control_entrega_documentos'] == '1' ?  'checked' : '' }}
    />
    </div>
    </div>
    <div class="col-sm-6">
        <label class="lblForm">¿Generar documentos?</label>
        <div class="input-group">
            <input type="checkbox" id="generarDocumentos" name="generarDocumentos" data-on="Sí" data-off="No"
                data-width="60" {{ !isset($actuacion) || $actuacion['generar_documentos'] == '1' ?  'checked' : '' }} />
        </div>
    </div>
    </div> --}}
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
                        <div class="col-sm-12">
                            <label id="documentosAsociados" class="lblForm">Documentos asociados a la
                                actuación</label>
                            <select class="form-control" title="Seleccionar" onchange="actuacion.addDocument(this)">
                                @foreach($documentos as $documento)
                                <option value="{{ $documento['id_documento'] }}">
                                    {{ $documento['nombre_documento'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-sm-6">
                                <label id="platillasAsociadas" class="lblForm">Plantillas asociadas a la
                                    actuación</label>
                                <select class="form-control" title="Seleccionar"
                                    onchange="actuacion.addDocumentTemplate(this)">
                                    @foreach($plantillasDocumento as $plantillaDocumento)
                                    <option value="{{ $plantillaDocumento['id_plantilla_documento'] }}">
                        {{ $plantillaDocumento['nombre_plantilla_documento'] }}</option>
                        @endforeach
                        </select>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-lg-12">
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
                                <tr id="documentsRow{{$item->id_documento}}" data-value="{{$item->id_documento}}">
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
                    {{-- <div class="col-lg-6">
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
                        <button class="btn btn-danger btn-xs" type="button" onclick="actuacion.removeDocument(this);">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </td>
                    </tr>
                    @endforeach
                    @endisset
                    </tbody>
                    </table>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-sm-12 flex flex-column items-end">
                    <label class="lblForm">Estado</label>
                    <div class="input-group">
                        <input type="checkbox" id="estado_actuacion" name="estado" data-on="Activo" data-off="Inactivo"
                            data-width="100"
                            {{ !isset($actuacion) || $actuacion['estado_actuacion'] == '1' ?  'checked' : '' }} />
                    </div>
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
