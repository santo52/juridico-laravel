@section('content')
<div class="juridico right-buttons">
    <div class="flex">
        @isset ($permissions->crear)
        <a style="margin-right: 5px;" href="javascript:void(0)" onclick="honorario.createEditModal()" class="btn btn-default">
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

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin honorarios"
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
            <th data-breakpoints="all">Observaciones</th>
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($honorarios) > 0)
        @foreach ($honorarios as $honorario)
        <tr id="tipoProcesoRow{{$honorario['id_honorario']}}">
            <td>{{$honorario['id_honorario']}}</td>
            <td>{{$honorario->cliente->intermediario->persona->numero_documento}}</td>
            <td>{{$honorario->cliente->intermediario->getNombreCompleto()}}</td>
            <td>$ {{number_format($honorario->getValorAPagar(), 0, ',', '.')}}</td>
            <td>$ {{number_format($honorario->getValorPagado(), 0, ',', '.')}}</td>
            <td>{{$honorario->cliente->persona->numero_documento}}</td>
            <td>{{$honorario->cliente->getNombreCompleto()}}</td>
            <td>$ {{number_format($honorario->valor_pagado_cliente, 0, ',', '.')}}</td>
            <td>{{$honorario->fecha_pago}}</td>
            <td>{{$honorario->observacion}}</td>
            <td>{{$honorario['pago_honorario'] ? 'Pagado' : 'Pendiente'}}</td>
            {{-- <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)"
                        onclick="honorario.createEditModal('{{$honorario['id_tipo_proceso']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="honorario.openDelete('{{$honorario['id_tipo_proceso']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td> --}}
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@isset ($permissions->eliminar)
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar tipo de proceso</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el tipo de proceso?</p>
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

<div class="modal fade" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="honorario.upsert(event)">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="recipient-name" class="control-label">Número de caso</label>
                            <input name="numero_caso" id="numero_caso" class="form-control required" />
                        </div>
                        <div class="col-sm-5">
                            <label for="recipient-name" class="control-label">Documento cliente</label>
                            <select data-live-search="true" id="documento_cliente" class="form-control required" title="Seleccionar" onchange="honorario.onChangeClient(this)">
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id_cliente}}">{{$cliente->persona->numero_documento}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="recipient-name" class="control-label">Cliente</label>
                            <select data-live-search="true" id="nombre_cliente" name="id_cliente" class="form-control required" title="Seleccionar" onchange="honorario.onChangeClient(this)">
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id_cliente}}">{{$cliente->getNombreCompleto()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Observaciones</label>
                        <textarea class="form-control" id="observacion", name="observacion"></textarea>
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="createValue" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endif


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
