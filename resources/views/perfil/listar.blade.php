@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="javascript:void(0)" onclick="perfil.createEditModal()" class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="perfil.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="perfil.excel()" class="btn download-file-action">
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

<table id="perfilTable" class="table table-hover" data-empty="Sin perfiles">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($perfiles) > 0)
        @foreach ($perfiles as $perfil)
        <tr id="perfilRow{{$perfil['id_perfil']}}">
            <td>{{$perfil['id_perfil']}}</td>
            <td>{{$perfil['nombre_perfil']}}</td>
            <td>{{$perfil['inactivo'] == 1 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)" onclick="perfil.createEditModal('{{$perfil['id_perfil']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="perfil.openDelete('{{$perfil['id_perfil']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    @if(count($perfiles))
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper show-registers">
                    {{$perfiles}}
                </div>
                <span class="label label-default footable-pagination-registers">
                    Mostrando del {{$perfiles->firstItem()}} al {{$perfiles->lastItem()}} de {{ $perfiles->total()}} registros
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
                <h4 class="modal-title">Eliminar actuación</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar la actuación?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="perfil.delete()" class="btn btn-danger">Eliminar</button>
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
                <button type="button" class="close" onclick="perfil.closeCreateModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="perfil.create(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre del perfil</label>
                        <input type="text" class="form-control" id="perfilNombre" name="nombre_perfil">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Estado</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control checkbox-toogle" id="perfilEstado" name="estado" checked />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name">
                            Menus del perfil
                        </label>
                        <div class="input-group">
                            <select id="listaMenu" class="form-control" title="Seleccionar ..."><select>
                                    <span class="input-group-btn">
                                        <button type="button" class="pull-right btn-md btn btn-success"
                                            onclick="perfil.addMenu()">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                        </div>
                        <br>
                        <table class="table" id="tableCreateModal" data-empty="Sin acciones de perfil">
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Permisos</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="createValue" />
                    <button type="button" class="btn btn-default" onclick="perfil.closeCreateModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@endsection
