@section('content')

<div class="juridico right-buttons">
    @isset($permissions->crear)
    <div>
        <a href="#actuacion/crear" class="btn btn-default">
            Crear
        </a>
    </div>
    @endisset
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            @isset($permissions->descargar_pdf)
            <div>
                <a href="javascript:void(0)" onClick="actuacion.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            @endisset
            @isset($permissions->descargar_excel)
            <div>
                <a href="javascript:void(0)" onClick="actuacion.excel()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/xlsx.svg') !!}" />
                </a>
            </div>
            @endisset
            @isset($permissions->imprimir)
            <div>
                <a href="javascript:void(0)" onClick="window.print()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/print.svg') !!}" />
                </a>
            </div>
            @endisset
        </div>
    </div>
</div>

<table id="actuacionTable" class="table table-hover" data-empty="Sin actuaciones" data-filter-container="#filter-form-container" data-sorting="true" data-filter-active="true">
    <thead>
        <tr class="bg-success">
            <th data-sort-id="id_actuacion">ID</th>
            <th data-sort-id="nombre_actuacion">Nombre de la actuación</th>
            {{-- <th data-breakpoints="all" data-filterable="false">¿Genera alertas?</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Aplica control de vencimiento?</th> --}}
            <th>Tiempo de vencimiento</th>
            {{-- <th data-breakpoints="all" data-filterable="false">¿Aplica procedibilidad?</th> --}}
            <th>¿La actuación tiene cobro?</th>
            {{-- <th data-filterable="false">Valor de la actuación</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de radicado?</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de juzgado?</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de respuesta?</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de apelación?</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de cobros?</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Programar audiencia?</th> --}}
            {{-- <th data-breakpoints="xs sm" data-filterable="false">Control de entrega de documentos</th> --}}
            {{-- <th data-breakpoints="all" data-filterable="false">¿Generar documentos?</th> --}}
            <th data-sort-id="estado_actuacion">Estado</th>
            @if (isset($permissions->editar) || isset($permissions->eliminar) )
            <th data-filterable="false" data-sortable="false"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if (count($listaActuaciones) > 0)
        @foreach ($listaActuaciones as $actuacion)
        <tr id="actRow{{$actuacion['id_actuacion']}}">
            <td>{{$actuacion['id_actuacion']}}</td>
            <td>{{$actuacion['nombre_actuacion']}}</td>
            {{-- <td>{{$actuacion['genera_alertas']}}</td> --}}
            {{-- <td>{{$actuacion['aplica_control_vencimiento']}}</td> --}}
            <td>{{$actuacion->getDiasVencimiento()}}</td>
            {{-- <td>{{$actuacion['requiere_estudio_favorabilidad']}}</td> --}}
            <td>{{$actuacion->actuacion_tiene_cobro == 1 ? 'Sí' : 'No'}}</td>
            {{-- <td>{{$actuacion['valor_actuacion']}}</td> --}}
            {{-- <td>{{$actuacion['mostrar_datos_radicado']}}</td> --}}
            {{-- <td>{{$actuacion['mostrar_datos_juzgado']}}</td> --}}
            {{-- <td>{{$actuacion['mostrar_datos_respuesta']}}</td> --}}
            {{-- <td>{{$actuacion['mostrar_datos_apelacion']}}</td> --}}
            {{-- <td>{{$actuacion['mostrar_datos_cobros']}}</td> --}}
            {{-- <td>{{$actuacion['programar_audiencia']}}</td> --}}
            {{-- <td>{{$actuacion['control_entrega_documentos']}}</td> --}}
            {{-- <td>{{$actuacion['generar_documentos']}}</td> --}}
            <td>{{$actuacion->estado_actuacion == 1 ? 'Activo' : 'Inactivo'}}</td>
            @if (isset($permissions->editar) || isset($permissions->eliminar) )
            <td>
                <div class="flex justify-center table-actions">
                    @isset($permissions->editar)
                    <a href="#actuacion/{{$actuacion['id_actuacion']}}" class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="actuacion.openDelete('{{$actuacion['id_actuacion']}}', '{{$actuacion['nombre_actuacion']}}');">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    @endisset
                </div>
            </td>
            @endif
        </tr>
        @endforeach
        @endif
    </tbody>
    @if(count($listaActuaciones))
    <tfoot>
        <tr class="footable-paging">
            <td colspan="8">
                <div class="footable-pagination-wrapper show-registers">
                    {{$listaActuaciones}}
                </div>
                <span class="label label-default footable-pagination-registers">
                    Mostrando del {{$listaActuaciones->firstItem()}} al {{$listaActuaciones->lastItem()}} de {{ $listaActuaciones->total()}} registros
                </span>
            </td>
        </tr>
    </tfoot>
    @endif
</table>

@isset($permissions->eliminar)
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
                <button type="button" onClick="actuacion.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset
@endsection
