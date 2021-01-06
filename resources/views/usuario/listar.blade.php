@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="javascript:void(0)" onclick="usuario.createEditModal()" class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            {{-- <div>
                <a href="javascript:void(0)" onClick="usuario.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="usuario.excel()" class="btn download-file-action">
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
            <th>Tipo documento</th>
            <th>Número de documento</th>
            <th>Nombres Completos</th>
            <th>Número telefónico</th>
            {{-- <th data-breakpoints="xs sm">Celular</th> --}}
            <th data-breakpoints="xs">Correo electrónico</th>
            {{-- <th data-breakpoints="all">País</th>
            <th data-breakpoints="all">Departamento</th> --}}
            <th data-breakpoints="all">Municipio</th>
            {{-- <th data-breakpoints="all">Barrio</th>
            <th data-breakpoints="all">Dirección</th> --}}
            <th data-breakpoints="xs sm">Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($usuarios) > 0)
        @foreach ($usuarios as $usuario)
        <tr id="tipoProcesoRow{{$usuario['id_usuario']}}">
            <td>{{$usuario['id_usuario']}}</td>
            <td>{{$usuario['abreviatura_tipo_documento']}}</td>
            <td>{{$usuario['numero_documento']}}</td>
            <td>{{$usuario->getNombreCompleto()}}</td>
            <td>
                @if($usuario['indicativo'])<span style="margin-right:2px;">(+{{$usuario['indicativo']}})</span>@endif{{$usuario['telefono']}}
            </td>
            {{-- <td>{{$usuario['celular']}}</td> --}}
            <td>{{$usuario['correo_electronico']}}</td>
            {{-- <td>{{$usuario['nombre_pais']}}</td>
            <td>{{$usuario['nombre_departamento']}}</td> --}}
            <td>{{$usuario['nombre_municipio']}}</td>
            {{-- <td>{{$usuario['barrio']}}</td>
            <td>{{$usuario['direccion']}}</td> --}}
            <td>{{$usuario['estado_usuario'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)"
                        onclick="usuario.createEditModal('{{$usuario['id_usuario']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="usuario.openDelete('{{$usuario['id_usuario']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper">
                    {{$usuarios}}
                    {{-- <div class="divider"></div>
                    <span class="label label-default">
                        Mostrando del 1 al 10 de 21 registros
                    </span> --}}
                </div>
            </td>
        </tr>
    </tfoot>
</table>

@isset ($permissions->eliminar)
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar usuario</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el usuario?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="usuario.delete()" class="btn btn-danger">Eliminar</button>
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
            <form onsubmit="usuario.upsert(event)" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Perfil</label>
                            <select class="form-control required" id="id_perfil" name="id_perfil" title="Seleccione">
                                @foreach ($perfiles as $item)
                                <option value="{{$item->id_perfil}}">{{$item->nombre_perfil}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Area</label>
                            <select class="form-control required" id="id_area" name="id_area" title="Seleccione">
                                @foreach ($areas as $item)
                                <option value="{{$item->id_area}}">{{$item->nombre}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Usuario</label>
                            <input type="text" class="form-control required" id="nombre_usuario"
                                name="nombre_usuario">
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Contraseña</label>
                            <input type="text" class="form-control" id="password"
                                name="password_value">
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Tipo de documento</label>
                            <select class="form-control" id="tipoDocumento" name="id_tipo_documento" title="Seleccione">
                                @foreach ($tiposDocumento as $item)
                                <option value="{{$item->id_tipo_documento}}">{{$item->nombre_tipo_documento}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Número de documento</label>
                            <input type="text" class="form-control required" id="numeroDocumento"
                                name="numero_documento">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Primer apellido</label>
                            <input type="text" class="form-control required" id="primerApellido" name="primer_apellido">
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Segundo apellido</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundo_apellido">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="primerNombre" class="control-label">Primer nombre</label>
                            <input type="text" class="form-control required" id="primerNombre" name="primer_nombre">
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Segundo nombre</label>
                            <input type="text" class="form-control" id="segundoNombre" name="segundo_nombre">
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Sede operativa</label>
                            <select data-live-search="true" class="form-control" id="municipio" name="id_municipio" title="Seleccione" onchange="usuario.changeMunicipio(this)">
                                @foreach ($municipios as $item)
                                <option value="{{$item->id_municipio}}">{{$item->nombre_municipio}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Dirección</label>
                            <input type="text" class="form-control required" id="direccion"
                                name="direccion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Teléfono fijo</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="indicativo">+1</span>
                                <input type="text" class="form-control required" id="telefono" name="telefono">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Correo electrónico</label>
                            <input type="email" class="form-control required" id="correoElectronico"
                                name="correo_electronico">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Firma</label>
                        <div class="input-firma">
                            <input id="firma" type="file" name="firma" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Estado</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90"
                                class="form-control" id="etapaEstado" name="estado" checked />
                        </div>
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
        $('.input-firma input[type=file]').on('change', e => {
            e.preventDefault()
            e.stopPropagation();
            const files = e.target.files && e.target.files[0]
            if(files) {
                const FR= new FileReader();
                FR.addEventListener("load", function(e) {
                    if(!$('.input-firma img').length) {
                        $('.input-firma').append('<img src="" />')
                    }

                    $('.input-firma img').attr('src', e.target.result)
                });

                FR.readAsDataURL( files );
            }
        })
    })
</script>
@endsection



