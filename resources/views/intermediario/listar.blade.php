@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="javascript:void(0)" onclick="intermediario.createEditModal()" class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="intermediario.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="intermediario.excel()" class="btn download-file-action">
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

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin intermediarios" data-filter-container="#filter-form-container" data-sorting="true" data-filter-active="true">
    <thead>
        <tr class="bg-success">
            <th data-sort-id="id_intermediario">ID</th>
            <th data-sort-id="nombre_tipo_documento">Tipo documento</th>
            <th data-sort-id="numero_documento">Número de documento</th>
            <th data-sort-id="nombre_intermediario">Nombres Completos</th>
            <th data-sort-id="telefono">Número telefónico</th>
            {{-- <th data-breakpoints="xs sm">Celular</th> --}}
            <th data-sort-id="correo_electronico" data-breakpoints="xs">Correo electrónico</th>
            <th data-sort-id="nombre_pais" data-breakpoints="all">País</th>
            <th data-sort-id="nombre_departamento" data-breakpoints="all">Departamento</th>
            <th data-sort-id="nombre_municipio" data-breakpoints="all">Municipio</th>
            {{-- <th data-breakpoints="all">Barrio</th>
            <th data-breakpoints="all">Dirección</th> --}}
            {{-- <th data-filterable="false">Retención aplicada</th> --}}
            <th data-breakpoints="xs sm">Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($intermediarios) > 0)
        @foreach ($intermediarios as $intermediario)
        <tr id="tipoProcesoRow{{$intermediario['id_intermediario']}}">
            <td>{{$intermediario['id_intermediario']}}</td>
            <td>{{$intermediario['abreviatura_tipo_documento']}}</td>
            <td>{{$intermediario['numero_documento']}}</td>
            <td>{{$intermediario->nombre_intermediario}}</td>
            <td>
                @if($intermediario['indicativo'])<span style="margin-right:2px;">(+{{$intermediario['indicativo']}})</span>@endif{{$intermediario['telefono']}}
            </td>
            {{-- <td>{{$intermediario['celular']}}</td> --}}
            <td>{{$intermediario['correo_electronico']}}</td>
            <td>{{$intermediario['nombre_pais']}}</td>
            <td>{{$intermediario['nombre_departamento']}}</td>
            <td>{{$intermediario['nombre_municipio']}}</td>
            {{-- <td>{{$intermediario['barrio']}}</td>
            <td>{{$intermediario['direccion']}}</td> --}}
            {{-- <td>{{$intermediario['retencion']}}%</td> --}}
            <td>{{$intermediario['estado_intermediario'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)"
                        onclick="intermediario.createEditModal('{{$intermediario['id_intermediario']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="intermediario.openDelete('{{$intermediario['id_intermediario']}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    @if(count($intermediarios))
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper show-registers">
                    {{$intermediarios}}
                </div>
                <span class="label label-default footable-pagination-registers">
                    Mostrando del {{$intermediarios->firstItem()}} al {{$intermediarios->lastItem()}} de {{ $intermediarios->total()}} registros
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
                <h4 class="modal-title">Eliminar intermediario</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el intermediario?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="intermediario.delete()" class="btn btn-danger">Eliminar</button>
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
                <button type="button" class="close" onclick="intermediario.closeCreateModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createTitle"></h4>
            </div>
            <form onsubmit="intermediario.upsert(event)">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-4">
                            <label for="recipient-name" class="control-label">Municipio</label>
                            <select class="form-control required" id="municipio" name="id_municipio" title="Seleccione" onchange="intermediario.changeMunicipio(this)">
                                @foreach ($municipios as $item)
                                <option value="{{$item->id_municipio}}">{{$item->nombre_municipio}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <label for="recipient-name" class="control-label">Tipo de documento</label>
                            <select class="form-control required" id="tipoDocumento" name="id_tipo_documento" title="Seleccione">
                                @foreach ($tiposDocumento as $item)
                                <option value="{{$item->id_tipo_documento}}">{{$item->nombre_tipo_documento}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-4">
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
                            <label for="recipient-name" class="control-label">Primer nombre</label>
                            <input type="text" class="form-control required" id="primerNombre" name="primer_nombre">
                        </div>
                        <div class="col-xs-6">
                            <label for="recipient-name" class="control-label">Segundo nombre</label>
                            <input type="text" class="form-control" id="segundoNombre" name="segundo_nombre">
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
                        {{-- <div class="col-xs-3">
                            <label for="recipient-name" class="control-label">Retención aplicada</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100" class="center form-control required numeric"
                                    id="retencion" name="retencion">
                                <span class="input-group-addon" id="basic-addon2">%</span>
                            </div>
                        </div> --}}
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
                    <button type="button" class="btn btn-default" onclick="intermediario.closeCreateModal()">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@endsection
