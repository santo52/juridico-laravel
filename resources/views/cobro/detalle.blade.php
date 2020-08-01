@section('content')

<div class="juridico-proceso-destacado">
    <p><b>Total cobrado:</b> $ {{number_format($totalCobrado, 0, ',', '.')}}</p>
    <p><b>Total pagado:</b> $ {{number_format($totalPagado, 0, ',', '.')}}</p>
</div>

<div class="juridico right-buttons">
    {{-- <div class="flex">
        @isset ($permissions->crear)
        <a style="margin-right: 5px;" href="javascript:void(0)" onclick="cobro.cobroModalOpen()" class="btn btn-default">
            Crear cobro
        </a>
        @endisset
    </div> --}}
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            {{-- <div>
                <a href="javascript:void(0)" onClick="tipoProceso.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="tipoProceso.excel()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/xlsx.svg') !!}" />
                </a>
            </div> --}}
            <div>
                <a href="javascript:void(0)" onClick="window.print()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/print.svg') !!}" />
                </a>
            </div>
        </div>
    </div>
</div>

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin tipos de proceso"
    data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Fecha cobro</th>
            <th>Cliente</th>
            <th data-breakpoints="all">Fecha de creación</th>
            <th>Concepto</th>
            <th>Valor cobrado</th>
            <th>Valor pagado</th>
            <th data-breakpoints="all">Pagos</th>
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($cobros) > 0)
        @foreach ($cobros as $cobro)
        <tr id="cobroRow{{$cobro['id_cobro']}}">
            <td>{{$cobro['id_cobro']}}</td>
            <td>{{$cobro->getFechaCobro()}}</td>
            <td>{{$cobro->procesoEtapaActuacion ? $cobro->procesoEtapaActuacion->procesoEtapa->proceso->cliente->getNombreCompleto() : ''}}
            </td>
            <td>{{$cobro->getFechaCreacion()}}</td>
            <td>{{$cobro['concepto']}}</td>
            <td>$ {{number_format($cobro['valor'], 0, ',', '.')}}</td>
            <td>$ {{number_format(floatval($cobro->getPagado()), 0, ',', '.')}}</td>
            <td>@foreach($cobro->pago as $pago)
                <div>{{$pago->fecha_pago}} - $ {{number_format(floatval($pago->valor_pago), 0, ',', '.')}}</div>
                @endforeach
            </td>
            <td>{{$cobro['cerrado'] == 1 ? 'Pagado' : 'Pendiente'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    <a href="javascript:void(0)" title="Editar cobro"
                        onclick="cobro.cobroModalOpen('{{$cobro['id_cobro']}}')" class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="javascript:void(0)" title="Listar pagos"
                        onclick="cobro.pagoModalOpen('{{$cobro['id_cobro']}}')" class="btn text-warning" type="button">
                        <span class="glyphicon glyphicon-usd"></span>
                    </a>
                    <a href="javascript:void(0)" title="Registrar pago"
                        onclick="cobro.registrarPagoModalOpen('{{$cobro['id_cobro']}}')" class="btn text-success"
                        type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>


<div class="modal fade" tabindex="-1" role="dialog" id="cobrosModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="cobrosTitle">Editar cobro</h4>
            </div>
            <form onsubmit="cobro.upsert(event)">
                <div class="modal-body">
                    <div class="form-group row">

                        <div class="col-xs-12 col-sm-6">
                            <label for="etapa_cobro" class="control-label">Etapa</label>
                            <input id="etapa_cobro" class="form-control" disabled />
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label for="accion_cobro" class="control-label">Acción</label>
                            <input id="accion_cobro" class="form-control" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label for="fecha_cobro" class="control-label">Fecha de cobro</label>
                            <input name="fecha_cobro" id="fecha_cobro" data-date-format="yyyy-mm-dd"
                                class="form-control datepicker-here required" />
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label for="valor_cobro" class="control-label">Valor cobro</label>
                            <input name="valor" id="valor_cobro" class="form-control numeric required" />
                        </div>
                        {{-- <div class="col-xs-12 col-sm-4">
                            <label for="valor_pagado" class="control-label">Total pagado</label>
                            <input id="valor_pagado" class="form-control numeric" disabled />
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label for="valor_por_pagar" class="control-label">Total por pagar</label>
                            <input id="valor_por_pagar" class="form-control numeric" disabled />
                        </div> --}}
                    </div>
                    <div class="form-group">
                        <label for="concepto_cobro" class="control-label">Concepto</label>
                        <textarea style="min-height:50px;" name="concepto" id="concepto_cobro"
                            class="form-control required"></textarea>
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="id_cobro" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

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


<div class="modal fade" tabindex="-1" role="dialog" id="editarPagoModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="cobrosTitle">Pago realizado</h4>
            </div>
            <form onsubmit="cobro.upsertPago(event)">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label for="fecha_pago" class="control-label">Fecha de pago</label>
                            <input name="fecha_pago" id="fecha_pago" data-date-format="yyyy-mm-dd" class="form-control datepicker-here required" />
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
                            <label for="referencia" class="control-label">* Referencia de pago</label>
                            <input class="form-control"  name="referencia" id="referencia" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valor_pago" class="control-label">Valor pagado</label>
                        <input name="valor_pago" id="valor_pago" class="form-control numeric required" />
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="id_cobro_pago" />
                    <input type="hidden" id="id_pago_pago" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                <button type="button" onClick="cobro.deletePagoCancelar()" class="btn btn-default">Cancelar</button>
                <button type="button" onClick="cobro.deletePagoAceptar()" class="btn btn-danger">Eliminar</button>
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
                    <button type="button" class="btn btn-default" onClick="tipoProceso.popoverClose(this)">Cancelar</button>
                    <button type="submit" class="btn btn-success" onClick="tipoProceso.createEtapa()" >Crear</button>
                </div>
            `,
            html: true,
            placement: "top",
            container: '#createModal'
        });
    })
</script>
@endsection
