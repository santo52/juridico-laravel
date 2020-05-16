@section('title', 'Juridico | Consultar procesos')

@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="#proceso/crear" class="btn btn-default">
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

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin procesos"
    data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Documento cliente</th>
            <th>Nombre cliente</th>
            <th>Tipo de proceso</th>
            <th>Entidad demandada</th>
            <th>Usuario responsable</th>
            <th data-breakpoints="all">Valor del estudio</th>
            <th data-breakpoints="all">Fecha de retiro del servicio</th>
            <th data-breakpoints="all">Última entidad de servicio</th>
            <th>Municipio</th>
            <th data-breakpoints="all">Acto administrativo del retiro</th>
            <th data-breakpoints="all">Normatividad aplicada al caso</th>
            <th data-breakpoints="all">Observaciones del caso</th>
            <th data-breakpoints="xs sm">Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (count($procesos) > 0)
        @foreach ($procesos as $proceso)
        <tr id="tipoProcesoRow{{$proceso['id_proceso']}}">
            <td>{{$proceso['id_proceso']}}</td>
            <td>{{$proceso['numero_documento']}}</td>
            <td>{{$proceso['primer_apellido']}} {{$proceso['segundo_apellido']}}
                {{$proceso['primer_nombre']}} {{$proceso['segundo_nombre']}}</td>
            <td>{{$proceso['nombre_tipo_proceso']}}</td>
            <td>{{$proceso['nombre_entidad_demandada']}}</td>
            <td>{{$proceso['nombre_usuario']}}</td>
            <td>{{$proceso['valor_estudio']}}</td>
            <td>{{$proceso['fecha_retiro_servicio']}}</td>
            <td>{{$proceso['id_ultima_entidad_servicio']}}</td>
            <td>{{$proceso['nombre_municipio']}}</td>
            <td>{{$proceso['id_acto_administrativo_retiro']}}</td>
            <td>{{$proceso['normatividad_aplicada_caso']}}</td>
            <td>{{$proceso['observaciones_caso']}}</td>
            <td>{{$proceso['estado_proceso'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="#proceso/{{$proceso['id_proceso']}}" class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="proceso.openDelete('{{$proceso['id_proceso']}}')">
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
                <h4 class="modal-title">Eliminar proceso</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el proceso?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="proceso.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset


@endsection
