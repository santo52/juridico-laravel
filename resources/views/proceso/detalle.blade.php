@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<form>
    <div class="form-group row">
        @if($proceso)
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Fecha de creación</label>
            <input type="text" class="form-control" id="celular" name="celular" @if($proceso)
                value="{{$proceso->celular }}" @endif disabled />
        </div>
        @endif
        <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
            <label for="telefono" class="control-label">Número de proceso</label>
            <input type="text" class="form-control" id="celular" name="celular" @if($proceso)
                value="{{$proceso->celular }}" @endif />
        </div>
        <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
            <label for="telefono" class="control-label">Identificación de la carpeta física</label>
            <input type="text" class="form-control" id="celular" name="celular" @if($proceso)
                value="{{$proceso->celular }}" @endif />
        </div>
    </div>
    <div class="separator margin"></div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Cliente</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar" onchange="proceso.changeCliente(this)">
                @foreach ($clientes as $item)
                <option value="{{$item->id_cliente}}">
                    {{$item->primer_nombre}} {{$item->segundo_nombre}} {{$item->primer_apellido}}
                    {{$item->segundo_apellido}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Cédula cliente</label>
            <input type="text" class="form-control" id="documento_cliente" @if($proceso)
                value="{{$proceso->celular }}" @endif disabled />
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Teléfono cliente</label>
            <div class="input-group">
                <span class="input-group-addon" id="indicativo_cliente">+1</span>
                <input disabled type="text" class="form-control required" id="telefono_cliente">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Nombre intermediario</label>
            <input type="text" class="form-control" id="nombre_intermediario" @if($proceso)
                value="{{$proceso->celular }}" @endif disabled />
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Teléfono intermediario</label>
            <div class="input-group">
                <span class="input-group-addon" id="indicativo_intermediario">+1</span>
                <input disabled type="text" class="form-control required" id="telefono_intermediario">
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Correo electrónico intermediario</label>
            <input type="text" class="form-control" id="email_intermediario" @if($proceso)
                value="{{$proceso->celular }}" @endif disabled />
        </div>
    </div>
    <div class="separator margin"></div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-6">
            <label for="telefono" class="control-label">Tipo de proceso</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar">
                @foreach ($tiposProceso as $item)
                <option value="{{$item->id_tipo_proceso}}">{{$item->nombre_tipo_proceso}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="telefono" class="control-label">Entidad demandada</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar">
                @foreach ($entidadesDemandadas as $item)
                <option value="{{$item->id_entidad_demandada}}">{{$item->nombre_entidad_demandada}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Usuario responsable</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar">
                @foreach ($usuarios as $item)
                <option value="{{$item->id_usuario}}">
                    @if($item->primer_apellido || $item->segundo_apellido || $item->primer_nombre ||
                    $item->segundo_nombre)
                    {{ $item->primer_nombre }} {{ $item->segundo_nombre }} {{ $item->primer_apellido }}
                    {{ $item->segundo_apellido }}
                    @else
                    {{$item->nombre_usuario}}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="celular" class="control-label">Valor del estudio (si aplica)</label>
            <input type="text" class="form-control" id="celular" name="celular" @if($proceso)
                value="{{$proceso->celular }}" @endif />
        </div>

        <div class="col-xs-12 col-sm-4">
            <label for="celular" class="control-label">Fecha de retiro del servicio</label>
            <input class="form-control datepicker-here required" />
        </div>




        {{-- <div class="col-xs-12 col-sm-3">
            <label for="celular" class="control-label">Número celular</label>
            <input type="text" class="form-control required" id="celular" name="celular" @if($cliente)
                value="{{$cliente->celular }}" @endif />
    </div>
    <div class="col-xs-12 col-sm-3">
        <label for="celular2" class="control-label">Número celular 2</label>
        <input type="text" class="form-control" id="celular2" name="celular2" @if($cliente)
            value="{{$cliente->celular2 }}" @endif />
    </div>
    <div class="col-xs-12 col-sm-3">
        <label for="correo_electronico" class="control-label">Correo electrónico</label>
        <input type="email" class="form-control required" id="correo_electronico" name="correo_electronico"
            @if($cliente) value="{{$cliente->correo_electronico }}" @endif />
    </div> --}}
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-6">
            <label for="telefono" class="control-label">Última entidad de servicio (entidad de justicia)</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar">
                @foreach ($entidadesJusticia as $item)
                <option value="{{$item->id_entidad_justicia}}">{{$item->nombre_entidad_justicia}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xs-12 col-sm-6">
            <label for="telefono" class="control-label">Acto administrativo del retiro (actuación)</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar">
                @foreach ($actuaciones as $item)
                <option value="{{$item->id_actuacion}}">{{$item->nombre_actuacion}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Pais</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar">
                @foreach ($paises as $item)
                <option selected value="{{$item->id_pais}}">{{$item->nombre_pais}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Departamento</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar" onchange="proceso.changeDepartamento(this)">
                @foreach ($departamentos as $item)
                <option value="{{$item->id_departamento}}">{{$item->nombre_departamento}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Municipio</label>
            <select data-live-search="true" class="form-control required" title="Seleccionar" id="id_municipio" name="id_municipio">
                @foreach ($municipios as $item)
                <option value="{{$item->id_municipio}}">{{$item->nombre_municipio}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">Normatividad aplicada al caso</label>
            <input type="text" class="form-control required" id="celular" name="celular" @if($proceso)
                value="{{$proceso->celular }}" @endif />
        </div>
        <div class="col-xs-12 col-sm-4">
            <label for="telefono" class="control-label">¿Se autoriza a dar información del caso?</label>
            <div class="checkbox-form">
                <input type="checkbox" data-on="Si" data-off="No" data-width="90" class="form-control"
                    id="dar_informacion_caso" name="dar_informacion_caso" checked />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="telefono" class="control-label">Observaciones del caso</label>
        <textarea rows="4" style="resize: vertical; min-height: 100px" class="form-control required"></textarea>
    </div>
    <button class="btn btn-success" style="width: 100%">Guardar proceso</button>
</form>


@endsection
