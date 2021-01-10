@section('title', 'Juridico | Consultar plantillas')

@section('content')
<div class="juridico right-buttons">
    <div>
        @isset ($permissions->crear)
        <a href="#plantillas/crear" class="btn btn-default">
            Crear
        </a>
        @endisset
    </div>
</div>
<div class="row">
    <div class="col-xs-12 flex juridico" id="filter-form-container">
        <div class="pull-left flex" style="padding-right:20px">
            <div>
                <a href="javascript:void(0)" onClick="plantilla.pdf()" class="btn download-file-action">
                    <img style="width: 100%" src="{!! asset('images/pdf.svg') !!}" />
                </a>
            </div>
            <div>
                <a href="javascript:void(0)" onClick="plantilla.excel()" class="btn download-file-action">
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

<table id="tipoplantillaTable" class="table table-hover" data-empty="Sin plantillas" data-filter-container="#filter-form-container" data-sorting="true" data-filter-active="true">
    <thead>
        <tr class="bg-success">
            <th data-sort-id="id_plantilla_documento">ID</th>
            <th data-sort-id="nombre_plantilla_documento">Nombre plantilla</th>
            <th>Estado</th>
            <th data-filterable="false" data-sortable="false"></th>
        </tr>
    </thead>
    <tbody>
        @if (count($plantillas) > 0)
        @foreach ($plantillas as $plantilla)
        <tr id="tipoplantillaRow{{$plantilla['id_plantilla_documento']}}">
            <td>{{$plantilla['id_plantilla_documento']}}</td>
            <td>{{$plantilla['nombre_plantilla_documento']}}</td>
            <td>{{$plantilla['estado_plantilla_documento'] == 2 ? 'Inactivo' : 'Activo'}}</td>
            <td>
                <div class="flex justify-center table-actions">
                    @isset ($permissions->editar)
                    <a href="#plantillas/{{$plantilla['id_plantilla_documento']}}" class="btn text-primary"
                        type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endisset
                    @isset ($permissions->eliminar)
                    <a href="javascript:void(0)" class="btn text-danger" type="button"
                        onclick="plantilla.openDelete('{{$plantilla['id_plantilla_documento']}}')">
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
                    {{$plantillas}}
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
                <h4 class="modal-title">Eliminar plantilla</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el plantilla?</p>
            </div>
            <div class="modal-footer center">
                <input type="hidden" id="deleteValue" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="plantilla.delete()" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endisset


@endsection
