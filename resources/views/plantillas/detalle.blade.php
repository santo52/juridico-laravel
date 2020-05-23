@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<form onsubmit="plantilla.upsert(event)">
    @if ($plantilla)
    <input type="hidden" name="id_plantilla_documento" value="{{$plantilla->id_plantilla_documento}}" />
    @endif

    <div class="form-group">
        <label for="telefono" class="control-label">Nombre de la plantilla</label>
        <input type="text" class="form-control required" id="nombre_plantilla_documento"
            name="nombre_plantilla_documento" @if($plantilla) value="{{$plantilla->nombre_plantilla_documento }}"
            @endif />
    </div>

    <div class="form-group">
        <label for="contenido_plantilla_documento" class="control-label">* Contenido Plantilla</label>
        <textarea placeholder="Agregar el contenido de la plantilla" id="contenido_plantilla_documento"
            name="contenido_plantilla_documento">@if($plantilla){{$plantilla->contenido_plantilla_documento }}@endif</textarea>
    </div>
    <div class="form-group">
        <label for="estado_plantilla_documento" class="control-label">Estado</label>
        <div class="checkbox-form">
            <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90" class="form-control"
                id="estado_plantilla_documento" name="estado" @if(!$plantilla || $plantilla &&
                $plantilla->estado_plantilla_documento
            == 1) checked @endif />
        </div>
    </div>
    <button class="btn btn-success" style="width: 100%">Guardar plantilla</button>
</form>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $('#contenido_plantilla_documento').richText({
            variables: true,
        })
    })
</script>
@endsection
