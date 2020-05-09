@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        {{-- onclick="etapaProceso.createEditModal()" --}}
        <a href="#etapas-de-proceso/crear"  class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px"></div>
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
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acciones</th>
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
                <button type="button" onClick="etapaProceso.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset

@if(isset($permissions->crear) || isset($permissions->editar))
<div class="modal fade" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="etapaProceso.upsert(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre de la etapa de un proceso</label>
                        <input type="text" class="form-control" id="etapaNombre" name="nombre_etapa_proceso">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Estado</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control" id="etapaEstado" name="estado" checked />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name">
                            Actuaciones
                        </label>
                        <div class="input-group">
                            <select id="actuacionesList" class="form-control" title="Seleccionar">

                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="pull-right btn-md btn btn-success" onclick="tipoProceso.addEtapa()">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                        </div>
                        <br>

                        <table class="table" id="tableCreateModal" data-empty="Sin actuaciones">
                            <thead>
                                <td>Actuación</td>
                            </thead>
                            <tbody id="sortable"></tbody>
                        </table>
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
