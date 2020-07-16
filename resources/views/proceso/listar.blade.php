@section('title', 'Juridico | Consultar procesos')

@section('content')
<div class="juridico right-buttons">
    <div>
        @if (isset($permissions->crear) && isset($creacion))
        <a href="#proceso/crear" class="btn btn-default">
            Crear
        </a>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            {{-- <div>
                <a href="javascript:void(0)" onClick="proceso.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="proceso.excel()" class="btn download-file-action">
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

<table id="tipoProcesoTable" class="table table-hover" data-empty="Sin procesos"
    data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th data-filterable="false">ID</th>
            <th>Documento cliente</th>
            <th>Nombre cliente</th>
            <th data-breakpoints="xs sm">Tipo de proceso</th>
            <th @isset($cobros) data-breakpoints="all" @endisset>Entidad demandada</th>
            <th @isset($cobros) data-breakpoints="all" @endisset>Responsable</th>
            @isset($cobros)
                <th >Valor cobrado</th>
                <th >Valor pagado</th>
            @endisset
            <th data-breakpoints="all">Etapa actual</th>
            {{-- <th data-breakpoints="all" data-filterable="false">Valor del estudio</th> --}}
            <th data-breakpoints="all" data-filterable="false">Fecha de retiro del servicio</th>
            <th data-breakpoints="all" data-filterable="false">Última entidad de servicio</th>
            <th data-breakpoints="all">Municipio</th>
            <th data-breakpoints="all" data-filterable="false">Acto administrativo del retiro</th>
            <th data-breakpoints="all">Normatividad aplicada al caso</th>
            <th data-breakpoints="all">Entidad de justicia primera instancia</th>
            <th data-breakpoints="all">Entidad de justicia segunda instancia</th>
            <th data-breakpoints="all" data-filterable="false">Observaciones del caso</th>
            @if(!isset($cobros))
                <th data-breakpoints="xs sm">Estado</th>
            @endif
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($procesos) > 0)
        @foreach ($procesos as $proceso)
        <tr id="tipoProcesoRow{{$proceso->id_proceso}}">
            <td>{{$proceso->id_proceso}}</td>
            <td>{{$proceso->cliente->persona->numero_documento}}</td>
            <td>{{$proceso->getNombreCompletoCliente()}}</td>
            <td>{{$proceso->tipoProceso->nombre_tipo_proceso}}</td>
            <td>{{$proceso->entidadDemandada->nombre_entidad_demandada}}</td>
            <td>{{$proceso->responsable ? $proceso->responsable->getNombreCompleto() : 'Sin responsable'}}</td>
            @isset($cobros)
                <td>$ {{number_format($proceso->getTotalCobrado(), 0, ',', '.')}}</td>
                <td>$ {{number_format($proceso->getTotalPagado(), 0, ',', '.')}}</td>
            @endisset
            <td>{{$proceso->etapa ? $proceso->etapa->nombre_etapa_proceso : 'Sin iniciar'}}</td>
            {{-- <td>{{$proceso->valor_estudio}}</td> --}}
            <td>{{$proceso->getFechaRetiroServicio()}}</td>
            <td>{{$proceso->ultima_entidad_retiro}}</td>
            <td>{{$proceso->municipio->nombre_municipio}}</td>
            <td>{{$proceso->acto_administrativo}}</td>
            <td>{{$proceso->normatividad_aplicada_caso}}</td>
            <td>{{$proceso->entidad_justicia_primera_instancia}}</td>
            <td>{{$proceso->entidad_justicia_segunda_instancia}}</td>
            <td>{{$proceso->observaciones_caso}}</td>
            @if(!isset($cobros))
                <td>{{$proceso->estado_proceso == 2 ? 'Finalizado' : 'Activo'}}</td>
            @endif
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a data-toggle="tooltip" title="Editar"
                        @if(isset($seguimiento))
                            href="#seguimiento-procesos/{{$proceso->id_proceso}}"
                        @elseif(isset($cobros))
                            href="#cobros-y-pagos/{{$proceso->id_proceso}}"
                        @else
                            href="#proceso/{{$proceso->id_proceso}}"
                        @endif
                        class="btn text-primary" type="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset

                    @if (isset($permissions->eliminar) && isset($creacion))
                    <a data-toggle="tooltip" title="Eliminar" href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="proceso.openDelete('{{$proceso->id_proceso}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endif
                    @if(isset($seguimiento) || isset($cobro))
                    <a data-toggle="tooltip" title="Información cliente" target="_blank" href="#cliente/{{$proceso->id_cliente}}" class="btn text-warning" type="button">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
                    @endif
                    @if(isset($seguimiento) || isset($cobro))
                    <a data-toggle="tooltip" title="Comentarios" href="javascript:void(0)" class="btn text-primary" type="button"
                        onclick="proceso.openComments('{{$proceso->id_proceso}}')">
                        <span class="glyphicon glyphicon-comment"></span>
                        <span class="badge badge-sm">{{$proceso->totalComentarios}}</span>
                    </a>
                    @endif

                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

<div class="modal fade" tabindex="-1" role="dialog" id="comentariosModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="comentariosModalTitle"></h4>
            </div>
            <div class="modal-body">
                <table id="comentariosTable" class="table table-hover" data-empty="Sin comentarios"
                data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
                data-filter-container="#filter-form-container" data-sorting="false" data-filtering="false"
                data-paging="false" data-filter-placeholder="Buscar ..." data-filter-position="left"
                data-filter-dropdown-title="Buscar por" data-filter-space="OR">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
            <div class="modal-footer center">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>

@if (isset($permissions->eliminar) && isset($creacion))
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


@endif


@endsection
