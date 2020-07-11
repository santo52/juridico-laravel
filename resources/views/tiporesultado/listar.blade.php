@section('content')
<div class="juridico right-buttons">
    <div class="flex">
        @isset ($permissions->crear)
        <a style="margin-right: 5px;" href="javascript:void(0)" onclick="tipoResultado.createEditModal()" class="btn btn-default">
            Crear tipo de resultado
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            {{-- <div>
                <a href="javascript:void(0)" onClick="tipoResultado.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="tipoResultado.excel()" class="btn download-file-action">
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

<table id="tipoResultadoTable" class="table table-hover" data-empty="Sin tipos de resultado"
    data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
    data-filter-container="#filter-form-container" data-sorting="true" data-filtering="true" data-paging="true"
    data-filter-placeholder="Buscar ..." data-filter-position="left" data-filter-dropdown-title="Buscar por"
    data-filter-space="OR">
    <thead>
        <tr class="bg-success">
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($tiposResultado) > 0)
        @foreach ($tiposResultado as $tipoResultado)
        <tr id="tipoResultadoRow{{$tipoResultado['id_tipo_resultado']}}">
            <td>{{$tipoResultado['id_tipo_resultado']}}</td>
            <td>{{$tipoResultado['nombre_tipo_resultado']}}</td>
            <td>{{$tipoResultado['unico_tipo_resultado'] == 1 ? 'Valor específico' : 'Formato'}}</td>
            <td>{{$tipoResultado['eliminado'] == 0 ? 'Activo' : 'Eliminado'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="javascript:void(0)"
                        onclick="tipoResultado.createEditModal('{{$tipoResultado['id_tipo_resultado']}}')"
                        class="btn text-primary" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="tipoResultado.openDelete('{{$tipoResultado['id_tipo_resultado']}}')">
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
                <h4 class="modal-title">Eliminar tipo de resultado</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el tipo de resultado?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="tipoResultado.delete()" class="btn btn-danger">Eliminar</button>
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
            <form onsubmit="tipoResultado.upsert(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre del tipo de proceso</label>
                        <input type="text" class="form-control required" id="tipoNombre" name="nombre_tipo_resultado">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Tipo de campo</label>
                        <select class="form-control required" name="tipo_campo" id="tipoCampo">
                            <option value="1">Alfanumerico</option>
                            <option value="2">Documento</option>
                            <option value="3">Fecha</option>
                            <option value="4">Numero</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Tipo</label>
                        <div class="checkbox-form">
                            <input type="checkbox" data-on="Valor específico" data-off="Formato" data-width="160"
                                class="form-control" id="tipoEstado" name="estado" checked />
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
        $('#tipoResultadoEtapaPopover').popover({
            title: "Agregar etapa",
            content: `
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nombre de la etapa de un proceso</label>
                    <input type="text" class="form-control" id="etapaProcesoNombre">
                </div>
                <div style="margin:auto; width: 176px">
                    <button type="button" class="btn btn-default" onClick="tipoResultado.popoverClose(this)">Cancelar</button>
                    <button type="submit" class="btn btn-success" onClick="tipoResultado.createEtapa()" >Crear</button>
                </div>
            `,
            html: true,
            placement: "top",
            container: '#createModal'
        });
    })
</script>
@endsection
