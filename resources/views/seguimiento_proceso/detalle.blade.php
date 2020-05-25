@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<div>

    <!--  -->

    <input type="hidden" id="position" value="{{$proceso->id_etapa_proceso}}" />

    @if($proceso->dar_informacion_caso != 1)
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Precaución:</span>
        <b>Este cliente NO AUTORIZA dar algún tipo de información sobre el proceso a otras personas</b>
    </div>
    @endif

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" @if($proceso->id_etapa_proceso == 0) class="active" @endif >
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Información del proceso
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
        @if(isset($etapas) && count($etapas))
        @foreach ($etapas as $item)
        <div role="tabpanel" class="tab-pane @if($proceso->id_etapa_proceso == $item->id_etapa_proceso) active @endif"
            id="etapa-{{$item->id_etapa_proceso}}">

            <div class="juridico right-buttons">
                <div>
                    <a href="javascript:void(0)"
                        onclick="seguimientoProceso.addActuacion('{{$item->id_etapa_proceso}}')"
                        class="btn btn-default">
                        Asociar actuación
                    </a>
                </div>
            </div>
            <table id="tipoProcesoTable" class="table table-hover" data-empty="Sin actuaciones"
                data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
                data-filter-container="#filter-form-container" data-sorting="false" data-filtering="false"
                data-paging="false" data-filter-placeholder="Buscar ..." data-filter-position="left"
                data-filter-dropdown-title="Buscar por" data-filter-space="OR">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la actuación</th>
                        <th data-breakpoints="all">Días de vencimiento</th>
                        <th data-breakpoints="all">Tiempo máximo próxima actuación</th>
                        <th data-breakpoints="all">Fecha de inicio</th>
                        <th>Fecha de vencimiento</th>
                        <th>Fecha de finalización</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->actuaciones as $actuacion)
                    <tr>
                        <td>{{$actuacion->id_actuacion}}</td>
                        <td>{{strtolower($actuacion->nombre_actuacion)}}</td>
                        <td>{{$actuacion->dias_vencimiento}} días</td>
                        <td>{{$actuacion->tiempoMaximo}}</td>
                        <td>{{$actuacion->fechaInicio}}</td>
                        <td>{{$actuacion->fechaVencimiento}}</td>
                        <td>{{$actuacion->fechaFin}}</td>
                        <td>{{$actuacion->responsable}}</td>
                        <td>{{$actuacion->estado}}</td>
                        <td></td>
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
                <button type="button" class="close" onclick="etapaProceso.asociarActuacionModal('hide')"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Asociar actuación a etapa de proceso</h4>
            </div>
            <form onsubmit="seguimientoProceso.saveActuacion(event)">
                <div class="modal-body">
                    <input type="hidden" class="required" name="id_etapa_proceso" id="idEtapaProceso" />
                    <input type="hidden" class="required" name="order" id="orderActuacion" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre actuación</label>
                        <select data-live-search="true" class="form-control required" id="actuacionesList"
                            name="id_actuacion" title="Seleccionar actuación"></select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="recipient-name" class="control-label">¿Primera actuación?</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Sí" data-off="No" data-width="90"
                                class="form-control" id="etapaPrimeraActuacion" onchange="seguimientoProceso.isFirst(this)" />
                        </div>
                    </div> --}}
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
                    <input type="hidden" id="deleteValue" />
                    <button type="button" class="btn btn-default"
                        onclick="etapaProceso.asociarActuacionModal('hide')">Cancelar</button>
                    <button type="submit" class="btn btn-success">Asociar</button>
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
        fileDocument.init({
            url: 'proceso/upload',
            path: 'uploads/documentos',
            id
        })

        !id && $('#documentos-proceso-tab').hide()
    })
</script>
@endsection
