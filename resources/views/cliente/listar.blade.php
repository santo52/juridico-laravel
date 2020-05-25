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
        <div class="pull-left flex" style="padding-right:20px"></div>
    </div>
</div>

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin clientes"
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
            <th data-breakpoints="xs sm">Celular</th>
            <th data-breakpoints="all">Celular 2</th>
            <th data-breakpoints="xs">Correo electrónico</th>
            <th data-breakpoints="all" data-filterable="false">Fecha de creación</th>
            <th data-breakpoints="all">Nombre de quien recomienda</th>
            {{-- <th data-breakpoints="all">País</th>
            <th data-breakpoints="all">Departamento</th> --}}
            <th data-breakpoints="all">Municipio</th>
            {{-- <th data-breakpoints="all">Barrio</th> --}}
             <th data-breakpoints="all">Dirección</th>
            <th>Estado vital</th>
            <th data-breakpoints="xs sm">Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($clientes) > 0)
        @foreach ($clientes as $cliente)
        <tr id="tipoProcesoRow{{$cliente['id_cliente']}}">
            <td>{{$cliente['id_cliente']}}</td>
            <td>{{$cliente['abreviatura_tipo_documento']}}</td>
            <td>{{$cliente['numero_documento']}}</td>
            <td>{{$cliente->getNombreCompleto()}}</td>
            <td>
                @if($cliente['indicativo'])<span style="margin-right:2px;">(+{{$cliente['indicativo']}})</span>@endif{{$cliente['telefono']}}
            </td>
            <td>{{$cliente['celular']}}</td>
            <td>{{$cliente['celular2']}}</td>
            <td>{{$cliente['correo_electronico']}}</td>
            <td>{{$cliente['fecha_creacion']}}</td>
            <td>{{$cliente['nombre_persona_recomienda']}}</td>
            {{-- <td>{{$cliente['nombre_pais']}}</td>
            <td>{{$cliente['nombre_departamento']}}</td> --}}
            <td>{{$cliente['nombre_municipio']}}</td>
            {{-- <td>{{$cliente['barrio']}}</td> --}}
            <td>{{$cliente['direccion']}}</td>
            <td>{{$cliente['estado_vital_cliente']}}</td>
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
