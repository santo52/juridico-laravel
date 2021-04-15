@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="javascript:void(0)" onclick="entidadJusticia.createEditModal()" class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="entidadJusticia.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="entidadJusticia.excel()" class="btn download-file-action">
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

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin entidades de justicia" data-filter-container="#filter-form-container" data-sorting="true" data-filter-active="true">
    <thead>
        <tr class="bg-success">
            <th data-sort-id="id_entidad_justicia">ID</th>
            <th data-sort-id="nombre_entidad_justicia">Nombre</th>
            <th>¿Aplica primera instancia?</th>
            <th>¿Aplica segunda instancia?</th>
            <th data-sort-id="email_entidad_justicia" data-breakpoints="xs sm">Correo electrónico notificaciones</th>
            <th data-sort-id="nombre_pais" data-breakpoints="all">Pais</th>
            <th data-sort-id="nombre_departamento" data-breakpoints="all">Departamento</th>
            <th data-sort-id="nombre_municipio" data-breakpoints="all">Municipio</th>
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($entidades) > 0)
        @foreach ($entidades as $entidad)
        <tr id="tipoProcesoRow{{$entidad['id_entidad_justicia']}}">
            <td>{{$entidad['id_entidad_justicia']}}</td>
            <td>{{$entidad['nombre_entidad_justicia']}}</td>
            <td>{{$entidad['aplica_primera_instancia'] == 2 ? 'No' : 'Sí'}}</td>
            <td>{{$entidad['aplica_segunda_instancia'] == 2 ? 'No' : 'Sí'}}</td>
            <td>{{$entidad['email_entidad_justicia']}}</td>
            <td>{{$entidad->nombre_pais}}</td>
            <td>{{$entidad->nombre_departamento}}</td>
            <td>{{$entidad->nombre_municipio}}</td>
            <td>{{$entidad['estado_entidad_justicia'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)"
                        onclick="entidadJusticia.createEditModal('{{$entidad['id_entidad_justicia']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="entidadJusticia.openDelete('{{$entidad['id_entidad_justicia']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    @if(count($entidades))
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper show-registers">
                    {{$entidades}}
                </div>
                <span class="label label-default footable-pagination-registers">
                    Mostrando del {{$entidades->firstItem()}} al {{$entidades->lastItem()}} de {{ $entidades->total()}} registros
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
                <h4 class="modal-title">Eliminar entidad de justicia</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar la entidad de justicia?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="entidadJusticia.delete()" class="btn btn-danger">Eliminar</button>
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
                <button type="button" class="close" onclick="entidadJusticia.closeCreateModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="entidadJusticia.upsert(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre de la entidad de justicia</label>
                        <input type="text" class="form-control required" id="etapaNombre" name="nombre_entidad_justicia">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Correo electrónico de notificaciones</label>
                        <input type="email" class="form-control required" id="etapaCorreo" name="email_entidad_justicia">
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-4">
                            <label for="id_pais" class="control-label">País</label>
                            <select class="form-control required" id="id_pais" onChange="entidadJusticia.changePais(this)">
                                @foreach ($paises as $item)
                                <option value="{{$item->id_pais}}">{{$item->nombre_pais}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label for="id_departamento" class="control-label">Departamento</label>
                            <select data-live-search="true" class="form-control required" id="id_departamento"
                                title="Seleccionar" onChange="entidadJusticia.changeDepartamento(this)"></select>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label for="id_municipio" class="control-label">Municipio</label>
                            <select data-live-search="true" class="form-control required" id="id_municipio" name="id_municipio"
                                title="Seleccionar">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">¿Aplica primara instancia?</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control checkbox-toogle" id="primeraInstancia" name="segunda_instancia" checked />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">¿Aplica segunda instancia?</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control checkbox-toogle" id="segundaInstancia" name="segunda_instancia" checked />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Estado</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control checkbox-toogle" id="etapaEstado" name="estado" checked />
                        </div>
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="createValue" />
                    <button type="button" class="btn btn-default" onclick="entidadJusticia.closeCreateModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@endsection
