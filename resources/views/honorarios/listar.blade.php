@section('content')
<div class="juridico right-buttons">
    <div class="flex">
        @isset ($permissions->crear)
        <a style="margin-right: 5px;" href="javascript:void(0)" onclick="honorario.createEditModal()"
            class="btn btn-default">
            Crear honorarios
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="window.print()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/print.svg') !!}" />
                </a>
            </div>
        </div>
    </div>
</div>

<table id="honoratiosTable" class="table table-hover" data-empty="Sin honorarios"
    data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Documento intermediario</th>
            <th>Intermediario</th>
            <th>Valor a pagar</th>
            <th>Valor pagado</th>
            <th data-breakpoints="all">Documento cliente</th>
            <th data-breakpoints="all">Cliente</th>
            <th data-breakpoints="all">Valor pagado al cliente</th>
            <th data-breakpoints="all">Fecha de pago cliente</th>
            <th data-breakpoints="all">Honorarios</th>
            <th data-breakpoints="all">Comisiones</th>
            {{-- <th data-breakpoints="all">Observaciones</th> --}}
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($honorarios) > 0)
        @foreach ($honorarios as $honorario)
        <tr id="honorarioRow{{$honorario['id_honorario']}}">
            <td>{{$honorario['id_honorario']}}</td>
            <td>{{$honorario->proceso->cliente->intermediario ? $honorario->proceso->cliente->intermediario->persona->numero_documento : 'Sin Intermediario'}}</td>
            <td>{{$honorario->proceso->cliente->intermediario ? $honorario->proceso->cliente->intermediario->getNombreCompleto() :  'Sin Intermediario'}}</td>
            <td class="valorAPagar">$ {{number_format($honorario->getValorAPagar(), 0, ',', '.')}}</td>
            <td class="valorPagado">$ {{number_format($honorario->getValorPagado(), 0, ',', '.')}}</td>
            <td>{{$honorario->proceso->cliente->persona->numero_documento}}</td>
            <td>{{$honorario->proceso->cliente->getNombreCompleto()}}</td>
            <td>$ {{number_format($honorario->proceso->valor_final_sentencia, 0, ',', '.')}}</td>
            <td>{{$honorario->proceso->fecha_pago}}</td>
            <td class="totalHonorarios">$ {{number_format($honorario->getTotalHonorarios(), 0, ',', '.')}}</td>
            <td class="totalComisiones">$ {{number_format($honorario->getTotalComisiones(), 0, ',', '.')}}</td>
            {{-- <td>{{$honorario->observacion}}</td> --}}
            <td class="estadoPagos">{{$honorario['cerrado'] === 1 ? 'Pagado' : 'Pendiente'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)" title="Editar cobro"
                        onclick="honorario.createEditModal('{{$honorario['id_honorario']}}')" class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    <a href="javascript:void(0)" title="Listar pagos"
                        onclick="honorario.pagoModalOpen('{{$honorario['id_honorario']}}')" class="btn text-warning" type="button">
                        <span class="glyphicon glyphicon-usd"></span>
                    </a>
                    {{-- <a href="javascript:void(0)" title="Registrar pago"
                        onclick="honorario.registrarPagoModalOpen('{{$honorario['id_honorario']}}')" class="btn text-success"
                        type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> --}}
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="honorario.openDelete('{{$honorario['id_honorario']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    @if(count($honorarios))
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper show-registers">
                    {{$honorarios}}
                </div>
                <span class="label label-default footable-pagination-registers">
                    Mostrando del {{$honorarios->firstItem()}} al {{$honorarios->lastItem()}} de {{ $honorarios->total()}} registros
                </span>
            </td>
        </tr>
    </tfoot>
    @endif
</table>

@isset ($permissions->eliminar)
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar honorarios</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar estos honorarios?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="honorario.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset

@if(isset($permissions->crear) || isset($permissions->editar))

<div class="modal fade validate" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="honorario.closeCreateModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="honorario.upsert(event)">
                <div class="modal-body">
                    <h5 class="title-bordered">Liquidación de honorarios</h5>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="recipient-name" class="control-label">Proceso</label>
                            <select data-live-search="true" name="id_proceso" id="id_proceso"
                                class="form-control required" title="Seleccionar"
                                onchange="honorario.onChangeProceso(this)">
                                @foreach($procesos as $proceso)
                                <option value="{{$proceso->id_proceso}}">({{$proceso->id_proceso}}) -
                                    {{$proceso->numero_proceso ? $proceso->numero_proceso : 'Sin Radicado'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="campos-honorarios">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Documento cliente</label>
                                <input id="documento_cliente" class="form-control" disabled />
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Cliente</label>
                                <input id="nombre_cliente" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Valor pagado al cliente</label>
                                <input type="currency" id="valor_pagado_cliente" name="valor_pagado_cliente" class="form-control" disabled />
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Fecha de pago</label>
                                <input id="fecha_pago_cliente" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Documento intermediario</label>
                                <input id="documento_intermediario" class="form-control" disabled />
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Nombre intermediario</label>
                                <input id="nombre_intermediario" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">* Porcentaje honorarios</label>
                                <input min="0" max="100" type="number" name="porcentaje_honorarios"
                                    id="porcentaje_honorarios" class="form-control numeric"
                                    onchange="honorario.onChangePorcentajeHonorarios(this)"
                                    onkeyup="honorario.onChangePorcentajeHonorarios(this)" />
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Valor de los honorarios</label>
                                <input type="text" id="valor_honorarios" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="numero_factura" class="control-label">Número de factura</label>
                                <input name="numero_factura" id="numero_factura" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <label for="valor_factura" class="control-label">Valor factura</label>
                                <input type="currency"  id="valor_factura" name="valor_factura" class="form-control" />
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Valor pagado al cliente</label>
                                <input name="valor_pagado_cliente" id="valor_pagado_cliente" class="form-control numeric required" />
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Fecha de pago</label>
                                <input name="fecha_pago" id="fecha_pago" data-date-format="yyyy-mm-dd" class="form-control datepicker-here required" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Porcentaje de honorarios</label>
                                <input name="porcentaje_honorarios" id="porcentaje_honorarios" class="form-control numeric required" />
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="control-label">Valor honorarios</label>
                                <input name="valor_honorarios" id="valor_honorarios" class="form-control numeric required" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">Documento intermediario</label>
                                <input id="documento_intermediario" disabled class="form-control"/>
                            </div>
                            <div class="col-sm-5">
                                <label for="recipient-name" class="control-label">Nombre intermediario</label>
                                <input id="nombre_intermediario" disabled class="form-control"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="recipient-name" class="control-label">Valor comisión</label>
                                <input name="valor_comision" id="valor_comision" class="form-control numeric required" />
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="recipient-name" class="control-label">Observaciones</label>
                            <textarea class="form-control" id="observacion", name="observacion"></textarea>
                        </div> --}}
                        <h5 class="title-bordered" style="margin-top:20px">Liquidación de comisiones</h5>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">Valor comisión</label>
                                <input type="currency" name="valor_comision" id="valor_comision" class="form-control"
                                    onkeyup="honorario.onChangeComisiones(true)"
                                    onchange="honorario.onChangeComisiones(true)" />
                            </div>
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">% retefuente</label>
                                <input type="number" min="0" max="100" name="retefuente" id="retefuente"
                                    class="form-control numeric" onkeyup="honorario.onChangeComisiones()"
                                    onchange="honorario.onChangeComisiones()" />
                            </div>
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">% rete-ICA</label>
                                <input type="number" min="0" max="100" name="reteica" id="reteica"
                                    class="form-control numeric" onkeyup="honorario.onChangeComisiones()"
                                    onblur="honorario.onChangeComisiones()"
                                    onchange="honorario.onChangeComisiones()" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">Valor retefuente</label>
                                <input type="text" id="valor_retefuente" class="form-control" disabled />
                            </div>
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">Valor rete-ICA</label>
                                <input type="text" id="valor_reteica" class="form-control" disabled />
                            </div>
                            <div class="col-sm-4">
                                <label for="recipient-name" class="control-label">Valor comisión</label>
                                <input type="text" id="total_comision" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer center">
                        <input type="hidden" id="createValue" />
                        <button type="button" class="btn btn-default" onclick="honorario.closeCreateModal()">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endif


<div class="modal fade" tabindex="-1" role="dialog" id="pagosModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="cobrosTitle">Pagos realizados</h4>
            </div>
            <form onsubmit="cobro.upsertPago(event)">
                <div class="modal-body row">
                    <div class="col-xs-12 right" style="margin-bottom:10px">
                        <button id="pagosModalNewButton" type="button" class="btn btn-success" data-id="0" onclick="honorario.registrarPagoModalOpen(this)">Nuevo</button>
                    </div>
                    <div class="col-xs-12">
                        <table id="lista-pagos" class="table" data-empty="Sin pagos">
                            <thead>
                                <th>Fecha de pago</th>
                                <th>Forma de pago</th>
                                <th>N° Referencia</th>
                                <th>Valor del pago</th>
                                <th></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade validate" tabindex="-1" role="dialog" id="editarPagoModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="honorario.closePagoModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="cobrosTitle">Pago realizado</h4>
            </div>
            <form onsubmit="honorario.upsertPago(event)">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label for="fecha_pago" class="control-label">Fecha de pago</label>
                            <input name="fecha_consignacion" id="fecha_pago" data-date-format="yyyy-mm-dd" class="form-control datepicker-here required" />
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label for="forma_pago" class="control-label">Forma de pago</label>
                            <select class="form-control required" title="Seleccione" id="forma_pago" name="forma_pago" onchange="cobro.changeFormaPago(this.value)">
                                <option value="1">Efectivo</option>
                                <option value="2">Consignación</option>
                                <option value="3">Cheque</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="informacion_pago_financiero">
                        <div class="col-xs-12 col-sm-6">
                            <label for="id_entidad_financiera" class="control-label">* Entidad financiera</label>
                            <select class="form-control" title="Seleccione" data-live-search="true" name="id_entidad_financiera" id="id_entidad_financiera">
                                @foreach ($entidadesFinancieras as $item)
                                    <option value="{{$item->id_entidad_financiera}}">{{$item->nombre_entidad_financiera}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label for="referencia" class="control-label">* Número de cuenta</label>
                            <input class="form-control"  name="numero_cuenta" id="referencia" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valor_pago" class="control-label">Valor pagado</label>
                        <input type="currency" name="valor_pago" id="valor_pago" class="form-control required" />
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="id_cobro_pago" />
                    <input type="hidden" id="id_pago_pago" />
                    <button type="button" class="btn btn-default" onclick="honorario.closePagoModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="deletePagoModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar pago</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el pago?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deletePagoValue" />
                <button type="button" onClick="honorario.deletePagoCancelar()" class="btn btn-default">Cancelar</button>
                <button type="button" onClick="honorario.deletePagoAceptar()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $('#tipoProcesoEtapaPopover').popover({
            title: "Agregar etapa",
            content: `
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nombre de la etapa de un proceso</label>
                    <input type="text" class="form-control" id="etapaProcesoNombre">
                </div>
                <div style="margin:auto; width: 176px">
                    <button type="button" class="btn btn-default" onClick="honorario.popoverClose(this)">Cancelar</button>
                    <button type="submit" class="btn btn-success" onClick="honorario.createEtapa()" >Crear</button>
                </div>
            `,
            html: true,
            placement: "top",
            container: '#createModal'
        });
    })
</script>
@endsection
