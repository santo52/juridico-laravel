@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="#cliente/crear" class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="cliente.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="cliente.excel()" class="btn download-file-action">
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

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin clientes"  data-filter-container="#filter-form-container" data-sorting="true" data-filter-active="true">
    <thead>
        <tr class="bg-success">
            <th data-sort-id="id_del_cliente">ID</th>
            <th data-sort-id="nombre_tipo_documento" >Tipo documento</th>
            <th data-breakpoints="all">Nombre tipo documento</th>
            <th data-sort-id="numero_documento">Número de documento</th>
            <th data-sort-id="nombre_cliente">Nombres Completos</th>
            <th data-sort-id="telefono">Número telefónico</th>
            <th data-sort-id="celular" data-breakpoints="xs sm">Celular</th>
            <th data-breakpoints="all">Celular 2</th>
            <th data-sort-id="correo_electronico" data-breakpoints="xs">Correo electrónico</th>
            <th data-breakpoints="all" >Fecha de creación</th>
            <th data-sort-id="recomienda" data-breakpoints="all">Nombre de quien recomienda</th>
            {{-- <th data-breakpoints="all">País</th>
            <th data-breakpoints="all">Departamento</th> --}}
            <th data-sort-id="nombre_municipio" data-breakpoints="all">Municipio</th>
            {{-- <th data-breakpoints="all">Barrio</th> --}}
            <th data-breakpoints="all">Dirección</th>
            <th data-sort-id="estado_vital">Estado vital</th>
            <th data-sort-id="estado_cliente" data-breakpoints="xs sm">Estado</th>
            <th data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($clientes) > 0)
        @foreach ($clientes as $cliente)
        <tr id="tipoProcesoRow{{$cliente['id_cliente']}}">
            <td>{{$cliente->id_cliente}}</td>
            <td>{{$cliente->persona->getSiglasTipoDocumento()}}</td>
            <td>{{$cliente->getTipoDocumento()}}</td>
            <td>{{$cliente->getNumeroDocumento()}}</td>
            <td>{{$cliente->getNombreCompleto()}}</td>
            <td>
                @if($cliente->persona->getIndicativo())<span style="margin-right:2px;">(+{{$cliente->persona->getIndicativo()}})</span>@endif{{$cliente->getTelefono()}}
            </td>
            <td>{{$cliente->getCelular()}}</td>
            <td>{{$cliente->celular2}}</td>
            <td>{{$cliente->getEmail()}}</td>
            <td>{{$cliente->getFechaCreacion()}}</td>
            <td>{{$cliente->nombre_persona_recomienda}}</td>
            {{-- <td>{{$cliente['nombre_pais']}}</td>
            <td>{{$cliente['nombre_departamento']}}</td> --}}
            <td>{{$cliente->persona->getMunicipio()}}</td>
            {{-- <td>{{$cliente['barrio']}}</td> --}}
            <td>{{$cliente->getDireccion()}}</td>
            <td>{{$cliente->getEstadoVital()}}</td>
            <td>{{$cliente['estado_cliente'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="#cliente/{{$cliente['id_cliente']}}"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="cliente.openDelete('{{$cliente['id_cliente']}}')">
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
                    {{$clientes}}
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
                <h4 class="modal-title">Eliminar cliente</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el cliente?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="cliente.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset


@endsection
