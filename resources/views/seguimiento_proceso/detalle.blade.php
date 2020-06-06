@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<div>

    <!--  -->

    <input type="hidden" id="position" value="{{$proceso->id_etapa_proceso}}" />

    @if($proceso->dar_informacion_caso != 1)
    <div class="alert alert-warning" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Precaución:</span>
        <b>Este cliente NO AUTORIZA dar algún tipo de información sobre el proceso a otras personas</b>
    </div>
    @endif
    <div class="juridico-proceso-destacado">
        <p><b>Radicado:</b> {{$proceso->numero_proceso ? $proceso->numero_proceso : 'Sin asignar' }} </p>
        <p><b>Cliente:</b> {{$proceso->cliente->getNombreCompleto()}} </p>
        <p><b>Cédula:</b> {{$proceso->cliente->persona->numero_documento}} </p>
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" @if($proceso->id_etapa_proceso == 0) class="active" @endif >
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Información del proceso
            </a>
        </li>
        <li role="presentation">
            <a href="#comentarios-proceso" aria-controls="comentarios-proceso" role="tab" data-toggle="tab">
                Comentarios
            </a>
        </li>
        @if(isset($etapas) && count($etapas))
        @foreach ($etapas as $key => $item)
        <li @if($proceso->id_etapa_proceso == $item->id_etapa_proceso) class="active" @elseif($item->porcentaje == 100)
            class="finalized" @endif role="presentation"
            data-id="{{$item->id_etapa_proceso}}" data-position="{{$key}}"
            onclick="seguimientoProceso.changeEtapa(this)">
            <a href="#etapa-{{$item->id_etapa_proceso}}" aria-controls="etapa-{{$item->id_etapa_proceso}}" role="tab"
                data-toggle="tab">
                {{ucwords(strtolower($item->nombre_etapa_proceso))}}
            </a>
        </li>
        @endforeach
        @endif
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane @if($proceso->id_etapa_proceso == 0) active @endif"
            id="informacion-proceso">

            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="id_cliente" class="control-label">Cliente</label>
                    <input type="text" class="form-control" disabled value="{{$proceso->cliente->getNombreCompleto()}}"/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label class="control-label">Cédula cliente</label>
                    <input type="text" class="form-control" id="documento_cliente" @if($proceso)
                        value="{{$proceso->cliente->persona->numero_documento }}" @endif disabled />
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Estado vital cliente</label>
                    <input type="text" class="form-control" id="estado_vital_cliente" @if($proceso)
                        value="{{$proceso->cliente->getEstadoVital() }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono cliente</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">+1</span>
                        <input disabled type="text" class="form-control" id="telefono_cliente" @if($proceso)
                            value="{{$proceso->cliente->getNumerosContactoCliente() }}" @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Correo electrónico cliente</label>
                    <input type="text" class="form-control" id="email_cliente" @if($proceso)
                        value="{{$proceso->cliente->persona->correo_electronico }}" @endif disabled />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_pais" class="control-label">Pais</label>
                    <input type="text" class="form-control" disabled value="{{$proceso->cliente->persona->getPais() }}"/>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_departamento" class="control-label">Departamento</label>
                    <input type="text" class="form-control" disabled value="{{$proceso->cliente->persona->getDepartamento() }}"/>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_municipio" class="control-label">Municipio</label>
                    <input type="text" class="form-control" disabled value="{{$proceso->cliente->persona->getMunicipio() }}"/>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Nombre completo beneficiario</label>
                    <input type="text" class="form-control" id="nombre_beneficiario" @if($proceso)
                        value="{{$proceso->cliente->nombre_beneficiario }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono beneficiario</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_beneficiario">+{{$proceso->cliente->persona->getIndicativo() }}</span>
                        <input disabled type="text" class="form-control" id="telefono_beneficiario" @if($proceso)
                            value="{{$proceso->cliente->getNumerosContactoBeneficiario() }}" @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Correo electrónico beneficiario</label>
                    <input type="text" class="form-control" id="email_beneficiario" @if($proceso)
                        value="{{$proceso->cliente->correo_electronico_beneficiario }}" @endif disabled />
                </div>
            </div>

            <div class="separator margin"></div>

            <div class="form-group">
                <label for="observaciones_caso" class="control-label">Descripción del proceso</label>
                <textarea name="observaciones_caso" id="observaciones_caso" rows="4"
                    style="resize: vertical; min-height: 100px"
                    disabled
                    class="form-control">@if($proceso){{$proceso->observaciones_caso}}@endif</textarea>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="id_tipo_proceso" class="control-label">Tipo de proceso</label>
                    <input type="text" class="form-control" disabled value="{{$proceso->getTipoProceso()}}"/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="id_entidad_demandada" class="control-label">Entidad demandada</label>
                    <input type="text" class="form-control" disabled value="{{$proceso->getEntidadDemandada()}}"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="normatividad_aplicada_caso" class="control-label">Normatividad aplicada al caso</label>
                    <input type="text" class="form-control" id="normatividad_aplicada_caso"
                        name="normatividad_aplicada_caso" disabled @if($proceso)
                        value="{{$proceso->normatividad_aplicada_caso }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="id_carpeta" class="control-label">Identificación de la carpeta física</label>
                    <input type="text" class="form-control" id="id_carpeta" name="id_carpeta" @if($proceso)
                    disabled value="{{$proceso->id_carpeta }}" @endif />
                </div>
            </div>
            @if($proceso)
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label class="control-label">Usuario responsable</label>
                    <input type="text" class="form-control" @if($proceso)
                        value="{{$proceso->responsable ? $proceso->responsable->getNombreCompleto() : 'Sin responsable' }}"
                        @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label class="control-label">Etapa actual</label>
                    <input type="text" class="form-control" @if($proceso)
                        value="{{$proceso->etapa ? $proceso->etapa->nombre_etapa_proceso : 'Sin iniciar' }}" @endif
                        disabled />
                </div>
            </div>

            <div class="separator margin"></div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="telefono" class="control-label">Número de radicado</label>
                    <input type="text" class="form-control" id="numero_proceso" @if($proceso)
                        value="{{$proceso->numero_proceso ? $proceso->numero_proceso : 'Sin asignar' }}" @endif
                        disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="normatividad_aplicada_caso" class="control-label">Entidad de Justicia en primera
                        instancia</label>
                    <input type="text" class="form-control"
                    value="{{$proceso->entidad_justicia_primera_instancia}}"
                    disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="dar_informacion_caso" class="control-label">Entidad de Justicia en segunda
                        instancia</label>
                    <input type="text" class="form-control"
                    value="{{$proceso->entidad_justicia_segunda_instancia}}"
                    disabled />
                </div>

            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="normatividad_aplicada_caso" class="control-label"> Cuantía de la demanda</label>
                    <input type="text" class="form-control" @if($proceso->cuantia_demandada) value="$ {{number_format($proceso->cuantia_demandada, 0, ',', '.')}}" @endif
                    disabled />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="dar_informacion_caso" class="control-label"> Estimación de pretensiones </label>
                    <input type="text" class="form-control" @if($proceso->estimacion_pretenciones) value="$ {{number_format($proceso->estimacion_pretenciones, 0, ',', '.')}}" @endif
                    disabled />
                </div>
            </div>



            <div class="separator margin"></div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="fecha_radicacion_cumplimineto" class="control-label">Fecha de Radicación del
                        cumplimiento</label>
                    <input name="fecha_radicacion_cumplimineto" id="fecha_radicacion_cumplimineto" class="form-control"
                        @if($proceso) value="{{$proceso->fecha_radicacion_cumplimineto }}" @endif disabled />
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label for="fecha_retiro_servicio" class="control-label">Fecha de Pago</label>
                    <input name="fecha_pago" id="fecha_pago" class="form-control" @if($proceso)
                        value="{{$proceso->fecha_pago }}" @endif disabled />
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label for="ubicacion_fisica_archivo_muerto" class="control-label">Ubicación Física del Archivo
                        Muerto</label>
                    <input name="ubicacion_fisica_archivo_muerto" id="ubicacion_fisica_archivo_muerto"
                        class="form-control" @if($proceso) value="{{$proceso->ubicacion_fisica_archivo_muerto }}" @endif
                        disabled />
                </div>
            </div>
            @endif

            <div class="separator margin"></div>


            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="valor_estudio" class="control-label">Gastos iniciales del contrato</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">$</span>
                        <input disabled type="text" class="form-control numeric" id="valor_estudio" name="valor_estudio"
                        @if($proceso) value="{{$proceso->valor_estudio }}" @endif />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="acto_administrativo" class="control-label">Acto administrativo del retiro</label>
                    <input disabled type="text" class="form-control" id="acto_administrativo" name="acto_administrativo"
                        @if($proceso) value="{{$proceso->acto_administrativo }}" @endif />
                </div>


            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="fecha_retiro_servicio" class="control-label">Fecha de retiro del servicio</label>
                    <input disabled name="fecha_retiro_servicio" id="fecha_retiro_servicio" data-date-format="yyyy-mm-dd"
                        class="form-control datepicker-here" @if($proceso) value="{{$proceso->fecha_retiro_servicio }}"
                        @endif />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="ultima_entidad_retiro" class="control-label">Última entidad de servicio</label>
                    <input disabled type="text" class="form-control" id="ultima_entidad_retiro"
                        name="ultima_entidad_retiro" @if($proceso) value="{{$proceso->ultima_entidad_retiro }}"
                        @endif />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="valor_final_sentencia" class="control-label">Valor final sentencia</label>
                    <input type="text" class="form-control numeric" id="valor_final_sentencia"
                        name="valor_final_sentencia" @if($proceso) value="$ {{number_format($proceso->valor_final_sentencia, 0, ',', '.')}}" @endif
                        disabled />
                </div>
            </div>

            {{-- <div class="form-group row">
                @if($proceso)
                <div class="col-xs-12 col-sm-4">
                    <label for="telefono" class="control-label">Fecha de creación</label>
                    <input type="text" class="form-control" @if($proceso) value="{{$proceso->fecha_creacion }}" @endif
                        disabled />
                </div>
                @endif
                <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
                    <label for="telefono" class="control-label">Número de radicado</label>
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
                        <input disabled type="text" class="form-control" id="telefono_cliente">
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
                    <label for="acto_administrativo" class="control-label">Acto administrativo del retiro
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
                <textarea disabled rows="4"
                    class="form-control required">@if($proceso){{$proceso->observaciones_caso}}@endif</textarea>
            </div> --}}
        </div>
        <div role="tabpanel" class="tab-pane" id="comentarios-proceso">
            <div class="juridico right-buttons">
                <div>
                    <a href="javascript:void(0)" onclick="seguimientoProceso.addComentarioModal()"
                        class="btn btn-default">
                        Agregar un comentario
                    </a>
                </div>
            </div>
            <table id="comentariosTable" class="table table-hover" data-empty="Sin actuaciones"
                data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
                data-filter-container="#filter-form-container" data-sorting="false" data-filtering="false"
                data-paging="false" data-filter-placeholder="Buscar ..." data-filter-position="left"
                data-filter-dropdown-title="Buscar por" data-filter-space="OR">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Comentario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comentarios as $comentario)
                    <tr id="comentarioRow{{$comentario->id_proceso_bitacora}}">
                        <td>{{$comentario->getFechaCreacion()}}</td>
                        <td>{{$comentario->getNombreCompleto()}}</td>
                        <td>{{$comentario->comentario}}</td>
                        <td>
                            @if($comentario->canEdit())
                            <div class="flex justify-center table-actions">
                                <a data-toggle="tooltip" title="Editar"
                                    onClick="seguimientoProceso.addComentarioModal('{{$comentario->id_proceso_bitacora}}')"
                                    class="btn text-primary" type="button">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a data-toggle="tooltip" title="Eliminar"
                                    onclick="seguimientoProceso.openDeleteComentario('{{$comentario->id_proceso_bitacora}}')"
                                    href="javascript:void(0)" class="btn text-danger" type="button">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(isset($etapas) && count($etapas))
        @foreach ($etapas as $itemEtapa)
        <div role="tabpanel"
            class="tab-pane @if($proceso->id_etapa_proceso == $itemEtapa->id_etapa_proceso) active @endif"
            id="etapa-{{$itemEtapa->id_etapa_proceso}}">

            <div class="juridico right-buttons">
                <div>
                    <a href="javascript:void(0)"
                        onclick="seguimientoProceso.addActuacion('{{$itemEtapa->id_etapa_proceso}}')"
                        class="btn btn-default">
                        Asociar actuación
                    </a>
                </div>
            </div>
            <table id="actuacionesTable{{$itemEtapa->id_etapa_proceso}}" class="table table-hover"
                data-empty="Sin actuaciones" data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
                data-filter-container="#filter-form-container" data-sorting="false" data-filtering="false"
                data-paging="false" data-filter-placeholder="Buscar ..." data-filter-position="left"
                data-filter-dropdown-title="Buscar por" data-filter-space="OR">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la actuación</th>
                        <th data-breakpoints="all">Tiempo de vencimiento</th>
                        <th data-breakpoints="all">Tiempo máximo próxima actuación</th>
                        <th data-breakpoints="all">Fecha de inicio</th>
                        <th>Fecha de vencimiento</th>
                        <th>Fecha de finalización</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemEtapa->actuaciones as $actuacion)
                    <tr class="actuacion-row actuacion-row-{{$actuacion->estadoColor}}">
                        <td>{{$actuacion->id_actuacion}}</td>
                        <td>{{strtolower($actuacion->nombre_actuacion)}}</td>
                        <td>{{$actuacion->dias_vencimiento}}
                            @if($actuacion->dias_vencimiento_unidad == 1)
                            días
                            @else
                            meses
                            @endif
                        </td>
                        <td>{{$actuacion->tiempoMaximo}}</td>
                        <td>{{$actuacion->fechaInicio}}</td>
                        <td>{{$actuacion->fechaVencimiento}}</td>
                        <td>{{$actuacion->fechaFin}}</td>
                        <td>{{$actuacion->responsable}}</td>
                        <td class="estado">
                            <span>{{$actuacion->estado}}</span>
                        </td>
                        <td>
                            @isset($actuacion->id_proceso_etapa_actuacion)
                            <a href="#seguimiento-procesos/actuacion/{{$actuacion->id_proceso_etapa_actuacion}}"
                                data-toggle="tooltip" title="Editar actuación" class="btn text-primary" type="button">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            @else
                            @isset($itemEtapa->id_proceso_etapa)
                            <a href="#seguimiento-procesos/actuacion/crear/{{$itemEtapa->id_proceso_etapa}}/{{$actuacion->id_actuacion}}"
                                data-toggle="tooltip" title="Editar actuación" class="btn text-primary" type="button">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            @else
                            <a href="javascript:void(0)" onclick="location.reload()" data-toggle="tooltip"
                                title="Editar actuación" class="btn text-primary" type="button">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            @endisset
                            @endisset
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        @endif
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="actuacionModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="seguimientoProceso.closeActuacionModal()"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Asociar actuación a etapa de proceso</h4>
            </div>
            <form onsubmit="seguimientoProceso.saveActuacion(event)">
                <div class="modal-body">
                    <input type="hidden" class="required" name="id_etapa_proceso" id="idEtapaProceso" />
                    <input type="hidden" class="required" name="order" id="orderActuacion" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre actuación</label>
                        <div class="input-group">
                            <select data-live-search="true" class="form-control required" id="actuacionesList"
                            name="id_actuacion" title="Seleccionar actuación"></select>
                            <div class="input-group-btn">
                                <a type="button" href="#actuacion/crear" target="_blank" class="pull-right btn-md btn btn-success" onclick="tipoProceso.createEtapaOpen(this)" data-original-title="" title="">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="agregarActuacionDespuesDe">
                        <label for="recipient-name" class="control-label">Agregar después de</label>
                        <select data-live-search="true" class="form-control required" id="actuacionesAfterList"
                            name="after" title="Seleccionar actuación"></select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">* Tiempo máximo hasta la próxima
                            actuación</label>

                        <div class="input-group">
                            <input type="text" style="width:95%; height:35px" class="form-control required"
                                name="tiempo_maximo_proxima_actuacion" id="tiempoMaximoProximaActuacion">
                            <div class="input-group-btn">
                                <select class="form-control required" id="UnidadTiempoProximaActuacion"
                                    name="unidad_tiempo_proxima_actuacion">
                                    <option value="1">Días</option>
                                    <option value="2">Semanas</option>
                                    <option value="3">Meses</option>
                                    <option value="4">Años</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer center">
                    <button type="button" class="btn btn-default"
                        onclick="seguimientoProceso.closeActuacionModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Asociar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="comentariosModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="seguimientoProceso.closeComentarioModal()"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Comentario proceso</h4>
            </div>
            <form onsubmit="seguimientoProceso.saveComentario(event)">
                <div class="modal-body">
                    <input type="hidden" class="required" name="id_proceso_bitacora" id="idProcesoBitacora" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Comentario</label>
                        <textarea class="form-control required" id="comentarioProceso" name="comentario"></textarea>
                    </div>
                </div>
                <div class="modal-footer center">
                    <button type="button" class="btn btn-default"
                        onclick="seguimientoProceso.closeComentarioModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Asociar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar comentario</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el comentario del proceso?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="seguimientoProceso.deleteComentario()"
                    class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@endsection
