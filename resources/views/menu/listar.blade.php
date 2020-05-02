@section('title', 'Opciones')


@section('content')

<div class="juridico right-buttons">
    <div>
        <a href="javascript:void(0)" onclick="menu.createModal()" class="btn btn-default">
            Crear opción del menu
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px"></div>
    </div>
</div>

<table id="listTable" class="table table-hover" data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Nombre</th>
            <th>Padre</th>
            <th>Ruta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @isset ($parents)
        @foreach ($parents as $item)
        <tr class="background-green" id="listRow{{$item['id_menu']}}">
            <td>{{$item['id_menu']}}</td>
            <td>{{$item['nombre_menu']}}</td>
            <td>{{$item['parent_id']}}</td>
            <td>{{$item['ruta_menu']}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    <a href="javascript:void(0)" onclick="menu.createModal({{$item['id_menu']}})" class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class="btn text-danger" type="button"
                        onclick="actuacion.openDelete('{{$item['id_menu']}}');">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
            </td>
        </tr>
        @isset($item['children'] )

        @foreach ($item['children'] as $child)

        <tr id="listRow{{$child['id_menu']}}">
            <td style="padding-left: 20px">{{$child['id_menu']}}</td>
            <td style="padding-left: 20px">{{$child['nombre_menu']}}</td>
            <td style="padding-left: 20px">{{$item['nombre_menu']}}</td>
            <td style="padding-left: 20px">{{$child['ruta_menu']}}</td>
            <td style="padding-left: 20px">
                <div class="flex justify-center table-actions">
                    <a href="javascript:void(0)" onclick="menu.createModal({{$child['id_menu']}})" class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class="btn text-danger" type="button"
                        onclick="actuacion.openDelete('{{$child['id_menu']}}');">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
            </td>
        </tr>


        @endforeach

        @endisset
        @endforeach
        @endisset
    </tbody>
</table>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el item del menu?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="menu.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="menu.upsert(event)" id="createFormModal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="parentsMenu" class="control-label">* Padre</label>
                        <select class="form-control" title="Seleccionar" name="parent_id" id="create_parent_id" onchange="menu.onChangeSelect(this)"></select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">* Nombre</label>
                        <input type="text" class="form-control required" id="create_nombre_menu" name="nombre_menu">
                    </div>
                    <div class="form-group" style="display:none" >
                        <label for="recipient-name" class="control-label">* Ruta</label>
                        <input type="text" class="form-control required" id="create_ruta_menu" name="ruta_menu">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">* Orden</label>
                        <input type="text" class="form-control required numeric" id="create_orden_menu" name="orden_menu">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Estado</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control" id="create_estado" name="estado" checked />
                        </div>
                    </div>

                </div>
                <div class="modal-footer center">
                    <input type="hidden" id="idCreateElement" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
