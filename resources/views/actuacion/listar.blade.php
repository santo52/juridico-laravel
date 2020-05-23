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

<table id="actuacionTable" class="table table-hover"
    data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Nombre de la actuación</th>
            <th data-breakpoints="all" data-filterable="false">¿Genera alertas?</th>
            <th data-breakpoints="all" data-filterable="false">¿Aplica control de vencimiento?</th>
            <th data-filterable="false">Días de vencimiento</th>
            <th data-breakpoints="all" data-filterable="false">¿Aplica procedibilidad?</th>
            <th data-breakpoints="all" data-filterable="false">¿La actuación tiene cobro?</th>
            <th data-filterable="false">Valor de la actuación</th>
            <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de radicado?</th>
            <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de juzgado?</th>
            <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de respuesta?</th>
            <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de apelación?</th>
            <th data-breakpoints="all" data-filterable="false">¿Mostrar datos de cobros?</th>
            <th data-breakpoints="all" data-filterable="false">¿Programar audiencia?</th>
            <th data-breakpoints="xs sm" data-filterable="false">Control de entrega de documentos</th>
            <th data-breakpoints="all" data-filterable="false">¿Generar documentos?</th>
            <th data-breakpoints="xs">Estado</th>
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
            <td>{{$actuacion['genera_alertas']}}</td>
            <td>{{$actuacion['aplica_control_vencimiento']}}</td>
            <td>{{$actuacion['dias_vencimiento']}}</td>
            <td>{{$actuacion['requiere_estudio_favorabilidad']}}</td>
            <td>{{$actuacion['actuacion_tiene_cobro']}}</td>
            <td>{{$actuacion['valor_actuacion']}}</td>
            <td>{{$actuacion['mostrar_datos_radicado']}}</td>
            <td>{{$actuacion['mostrar_datos_juzgado']}}</td>
            <td>{{$actuacion['mostrar_datos_respuesta']}}</td>
            <td>{{$actuacion['mostrar_datos_apelacion']}}</td>
            <td>{{$actuacion['mostrar_datos_cobros']}}</td>
            <td>{{$actuacion['programar_audiencia']}}</td>
            <td>{{$actuacion['control_entrega_documentos']}}</td>
            <td>{{$actuacion['generar_documentos']}}</td>
            <td>{{$actuacion['estado_actuacion']}}</td>
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
