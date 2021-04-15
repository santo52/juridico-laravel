@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <button onclick="etapaProceso.createEditModal()" class="btn btn-default">
            Crear
        </button>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="etapaProceso.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="etapaProceso.excel()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/xlsx.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="window.print()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/print.svg') !!}" />
                </a>
            </div>
        </div>
    </div>
</div>

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin etapas de proceso" data-filter-container="#filter-form-container" data-sorting="true" data-filter-active="true">
    <thead>
        <tr class="bg-success">
            <th data-sort-id="id_etapa_proceso">ID</th>
            <th data-sort-id="nombre_etapa_proceso">Nombre</th>
            <th data-sort-id="estado_etapa_proceso">Estado</th>
            <th data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($etapas) > 0)
        @foreach ($etapas as $etapa)
        <tr id="tipoProcesoRow{{$etapa['id_etapa_proceso']}}">
            <td>{{$etapa['id_etapa_proceso']}}</td>
            <td>{{$etapa['nombre_etapa_proceso']}}</td>
            <td>{{$etapa['estado_etapa_proceso'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)"
                        onclick="etapaProceso.createEditModal('{{$etapa['id_etapa_proceso']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="etapaProceso.openDelete('{{$etapa['id_etapa_proceso']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    @if(count($etapas))
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper show-registers">
                    {{$etapas}}
                </div>
                <span class="label label-default footable-pagination-registers">
                    Mostrando del {{$etapas->firstItem()}} al {{$etapas->lastItem()}} de {{ $etapas->total()}} registros
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
                <h4 class="modal-title">Eliminar etapa de proceso</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar la etapa de proceso?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="etapaProceso.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset

@if(isset($permissions->crear) || isset($permissions->editar))


<div class="modal fade validate" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="etapaProceso.closeCreateModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="etapaProceso.upsert(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre de la etapa de un proceso</label>
                        <input type="text" class="form-control required" id="etapaNombre" name="nombre_etapa_proceso">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Estado</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control checkbox-toogle" id="etapaEstado" name="estado" checked />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name">
                            Actuaciones
                        </label>
                        <div class="input-group">
                            <button type="button" onClick="etapaProceso.asociarActuacionModal()"
                                style="width:100%; border-radius: 4px 0 0 4px;" class="btn btn-default">
                                Asociar actuación a la etapa
                            </button>
                            <span class="input-group-btn">
                                <button type="button" class="pull-right btn-md btn btn-success"
                                    onclick="etapaProceso.createActuacion(id)">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                        </div>
                        <br>

                        <table class="table" id="tableCreateModal" data-empty="Sin actuaciones">
                            <thead>
                                <td>Actuación</td>
                                <td>Duración máxima</td>
                                <td></td>
                            </thead>
                            <tbody id="sortable"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="createValue" />
                    <button type="button" class="btn btn-default" onclick="etapaProceso.closeCreateModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
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
            <form onsubmit="etapaProceso.addActuacion(event)">
                <div class="modal-body">
                    <input type="hidden" name="id_actuacion_etapa_proceso" id="idActuacionEtapaProceso" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Actuación</label>
                        <div class="input-group">
                            <select class="form-control" id="actuacionesList" name="id_actuacion" title="Seleccionar actuación"></select>
                            <div class="input-group-btn">
                                <a type="button" href="#actuacion/crear" target="_blank" class="pull-right btn-md btn btn-success" onclick="tipoProceso.createEtapaOpen(this)" data-original-title="" title="">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Tiempo máximo hasta la próxima
                            actuación</label>

                        <div class="input-group">
                            <input type="text" style="width:95%; height:35px" class="form-control"  name="tiempo_maximo_proxima_actuacion" id="tiempoMaximoProximaActuacion">
                            <div class="input-group-btn">
                                <select class="form-control" id="UnidadTiempoProximaActuacion"  name="unidad_tiempo_proxima_actuacion" >
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
@endif


@endsection
