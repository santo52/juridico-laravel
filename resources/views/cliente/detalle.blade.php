@section('title', 'Cliente')

@section('content')
{{--
<div class="alert alert-success fade in">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <strong>Success!</strong> Indicates a successful or positive action.
  </div> --}}

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#informacion-basica" aria-controls="informacion-basica" role="tab" data-toggle="tab">
                Información del cliente
            </a>
        </li>
        <li role="presentation">
            <a href="#informacion-contacto" aria-controls="informacion-contacto" role="tab" data-toggle="tab">
                Información del contacto
            </a>
        </li>
    </ul>

    <!-- Tab panes -->

    <form class="tab-content validate autosave" onsubmit="cliente.upsert(event)">
        @if($cliente)
        <input type="hidden" name="id_contacto" value="{{$cliente->id_contacto}}" />
        <input type="hidden" name="id_cliente" value="{{$cliente->id_cliente}}" />
        <input type="hidden" name="id_persona" value="{{$cliente->id_persona}}" />
        <input type="hidden" id="id_municipio_hidden" value="{{$cliente->id_municipio}}" />
        @endif

        <div role="tabpanel" class="tab-pane active" id="informacion-basica">
            <div class="form-group row">
                @if($cliente)
                <div class="col-xs-12 col-sm-3">
                    <label for="id_tipo_documento" class="control-label">Fecha de creación</label>
                    <input type="text" class="form-control" disabled value="{{$cliente->fecha_creacion}}" />
                </div>
                @endif
                <div class="col-xs-12 @if($cliente) col-sm-3 @else col-sm-4 @endif">
                    <label for="id_tipo_documento" class="control-label">Tipo de documento</label>
                    <select class="form-control required" id="id_tipo_documento" name="id_tipo_documento"
                        title="Seleccionar">
                        @foreach ($tiposDocumento as $item)
                        <option @if($cliente && $item->id_tipo_documento === $cliente->id_tipo_documento) selected
                            @endif
                            value="{{$item->id_tipo_documento}}" >{{$item->nombre_tipo_documento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 @if($cliente) col-sm-3 @else col-sm-4 @endif">
                    <label for="numero_documento" class="control-label">Documento</label>
                    <input type="text" class="form-control required" id="numero_documento" name="numero_documento"
                        @if($cliente) value="{{$cliente->numero_documento }}" @endif />
                </div>
                <div class="col-xs-12 @if($cliente) col-sm-3 @else col-sm-4 @endif">
                    <label for="id_lugar_expedicion" class="control-label">Lugar de expedición</label>
                    <select data-live-search="true" class="form-control required" id="id_lugar_expedicion" name="id_lugar_expedicion"
                        title="Seleccionar">
                        @foreach ($ciudades as $item)
                        <option @if($cliente && $item->id_municipio === $cliente->id_lugar_expedicion) selected
                            @endif value="{{$item->id_municipio}}">{{$item->nombre_municipio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-3">
                    <label for="primer_apellido" class="control-label">Primer apellido</label>
                    <input type="text" class="form-control required" id="primer_apellido" name="primer_apellido"
                        @if($cliente) value="{{$cliente->primer_apellido }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="segundo_apellido" class="control-label">Segundo Apellido</label>
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" @if($cliente)
                        value="{{$cliente->segundo_apellido }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="primer_nombre" class="control-label">Primer nombre</label>
                    <input type="text" class="form-control required" id="primer_nombre" name="primer_nombre"
                        @if($cliente) value="{{$cliente->primer_nombre }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="segundo_nombre" class="control-label">Segundo nombre</label>
                    <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" @if($cliente)
                        value="{{$cliente->segundo_nombre }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_pais" class="control-label">País</label>
                    <select class="form-control required" id="id_pais" onChange="cliente.changePais(this)">
                        @foreach ($paises as $item)
                        <option @if($cliente && $item->id_pais === $cliente->id_pais) selected @endif
                            value="{{$item->id_pais}}">{{$item->nombre_pais}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_departamento" class="control-label">Departamento</label>
                    <select data-live-search="true" class="form-control required" id="id_departamento"
                        title="Seleccionar" onChange="cliente.changeDepartamento(this)">
                        @foreach ($departamentos as $item)
                        <option @if($cliente && $item->id_departamento === $cliente->id_departamento) selected @endif
                            value="{{$item->id_departamento}}">{{$item->nombre_departamento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_municipio" class="control-label">Municipio</label>
                    <select data-live-search="true" class="form-control required" id="id_municipio" name="id_municipio"
                        title="Seleccionar" onChange="cliente.changeMunicipio(this)">
                        @foreach ($municipios as $item)
                        <option @if($cliente && $item->id_municipio === $cliente->id_municipio) selected @endif
                            value="{{$item->id_municipio}}">{{$item->nombre_municipio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="direccion" class="control-label">Dirección de residencia</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" @if($cliente)
                        value="{{$cliente->direccion }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="barrio" class="control-label">Barrio</label>
                    <input type="text" class="form-control" id="barrio" name="barrio" @if($cliente)
                        value="{{$cliente->barrio }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-3">
                    <label for="telefono" class="control-label">Teléfono fijo cliente</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">@if($cliente) +{{$cliente->indicativo }} @else +1 @endif </span>
                        <input type="text" class="form-control" name="telefono" id="telefono" @if($cliente)
                            value="{{$cliente->telefono }}" @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="celular" class="control-label">Teléfono celular 1 cliente</label>
                    <input type="text" class="form-control required" id="celular" name="celular" @if($cliente)
                        value="{{$cliente->celular }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="celular2" class="control-label">Teléfono celular 2 cliente</label>
                    <input type="text" class="form-control" id="celular2" name="celular2" @if($cliente)
                        value="{{$cliente->celular2 }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="correo_electronico" class="control-label">Correo electrónico cliente</label>
                    <input type="email" class="form-control required" id="correo_electronico" name="correo_electronico"
                        @if($cliente) value="{{$cliente->correo_electronico }}" @endif />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="estado_vital_cliente" class="control-label">Estado vital</label>
                    <select class="form-control required" id="estado_vital_cliente" name="estado_vital_cliente">
                        <option value="1" @if($cliente) @if($cliente->estado_vital_cliente == 1) selected @endif @else
                            selected @endif >VIVO</option>
                        <option value="2" @if($cliente && $cliente->estado_vital_cliente == 2) selected @endif>FALLECIDO
                        </option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="nombre_persona_recomienda" class="control-label">Nombre de la persona que recomendó a la
                        compañía</label>
                    <input type="text" class="form-control" id="nombre_persona_recomienda"
                        name="nombre_persona_recomienda" @if($cliente) value="{{$cliente->nombre_persona_recomienda }}"
                        @endif />
                </div>
            </div>
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-3">
                    <label for="id_tipo_documento_beneficiario" class="control-label">Tipo de documento
                        beneficiario</label>
                    <select class="form-control" id="id_tipo_documento_beneficiario"
                        name="id_tipo_documento_beneficiario" title="Seleccionar" onchange="cliente.changeBeneficiario(this)">
                        <option value="0">SIN BENEFICIARIO</option>
                        @foreach ($tiposDocumento as $item)
                        <option @if($cliente && $item->id_tipo_documento === $cliente->id_tipo_documento_beneficiario)
                            selected @endif value="{{$item->id_tipo_documento}}">{{$item->nombre_tipo_documento}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="numero_documento_beneficiario" class="control-label">Documento beneficiario</label>
                    <input type="text" class="form-control" id="numero_documento_beneficiario"
                        name="numero_documento_beneficiario" @if($cliente)
                        value="{{$cliente->numero_documento_beneficiario }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="nombre_beneficiario" class="control-label">Nombre del beneficiario</label>
                    <input type="text" class="form-control" id="nombre_beneficiario" name="nombre_beneficiario"
                        @if($cliente) value="{{$cliente->nombre_beneficiario }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="parentesco_beneficiario" class="control-label">Parentesco con el beneficiario</label>
                    <input type="text" class="form-control" id="parentesco_beneficiario" name="parentesco_beneficiario"
                        @if($cliente) value="{{$cliente->parentesco_beneficiario }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-3">
                    <label for="telefono_beneficiario" class="control-label">Número telefónico beneficiario</label>
                    <input type="text" class="form-control" id="telefono_beneficiario" name="telefono_beneficiario" @if($cliente)
                        value="{{$cliente->telefono_beneficiario }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="celular_beneficiario" class="control-label">Número celular beneficiario</label>
                    <input type="text" class="form-control" id="celular_beneficiario" name="celular_beneficiario" @if($cliente)
                        value="{{$cliente->celular_beneficiario }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="celular2_beneficiario" class="control-label">Número celular 2 beneficiario</label>
                    <input type="text" class="form-control" id="celular2_beneficiario" name="celular2_beneficiario" @if($cliente)
                        value="{{$cliente->celular2_beneficiario }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="correo_electronico_beneficiario" class="control-label">Correo electrónico beneficiario</label>
                    <input type="email" class="form-control" id="correo_electronico_beneficiario" name="correo_electronico_beneficiario"
                        @if($cliente) value="{{$cliente->correo_electronico_beneficiario }}" @endif />
                </div>
            </div>
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-3">
                    <label for="id_intermediario" class="control-label">Intermediario</label>
                    <select data-live-search="true" class="form-control" id="id_intermediario"
                        name="id_intermediario" onChange="cliente.onChangeIntermediario(this)">
                        <option @if($cliente && $cliente->id_intermediario == 0) selected @endif value="0">Sin intermediario</option>
                        @foreach ($intermediarios as $item)
                        <option @if($cliente && $cliente->id_intermediario === $item->id_intermediario) selected @endif
                            value="{{$item->id_intermediario}}">{{$item->getNombreCompleto()}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="id_intermediario" class="control-label">Documento intermediario</label>
                    <input type="text" class="form-control" id="documento_intermediario" disabled @if($cliente)
                        value="{{$cliente->numero_documento_intermediario }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="id_intermediario" class="control-label">Teléfono fijo intermediario</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo">+@if($cliente)
                            {{$cliente->indicativo_intermediario }} @endif</span>
                        <input type="text" class="form-control" id="telefono_intermediario" disabled @if($cliente)
                            value="{{$cliente->telefono_intermediario }}" @endif />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="id_intermediario" class="control-label">Correo intermediario</label>
                    <input type="email" class="form-control" id="email_intermediario" disabled @if($cliente)
                        value="{{$cliente->correo_electronico_intermediario }}" @endif />
                </div>
            </div>
            <div class="form-group">
                <label for="observaciones" class="control-label">Observaciones</label>
                <textarea rows="4" class="form-control"
                    id="observaciones"
                    name="observaciones">@if($cliente){{$cliente->observaciones}}@endif</textarea>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="informacion-contacto">
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="nombre_contacto" class="control-label">Nombre completo del contacto</label>
                    <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" @if($cliente)
                        value="{{$cliente->nombre_contacto }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="numero_documento_contacto" class="control-label">Parentesco con el contacto</label>
                    <input type="text" class="form-control" id="parentesco_contacto" name="parentesco_contacto"
                        @if($cliente) value="{{$cliente->parentesco_contacto }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_pais" class="control-label">País</label>
                    <select class="form-control" id="id_pais_contacto" onChange="cliente.changePaisContacto(this)">
                        @foreach ($paises as $item)
                        <option @if($cliente && $item->id_pais === $cliente->id_pais) selected @endif
                            value="{{$item->id_pais}}">{{$item->nombre_pais}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_departamento" class="control-label">Departamento</label>
                    <select data-live-search="true" class="form-control" id="id_departamento_contacto"
                        title="Seleccionar" onChange="cliente.changeDepartamentoContacto(this)">
                        @foreach ($departamentos as $item)
                        <option @if($cliente && $item->id_departamento === $cliente->id_departamento) selected @endif
                            value="{{$item->id_departamento}}">{{$item->nombre_departamento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_municipio" class="control-label">Municipio</label>
                    <select data-live-search="true" class="form-control" id="id_municipio_contacto" name="id_municipio_contacto"
                        title="Seleccionar" onChange="cliente.changeMunicipioContacto(this)">
                        @foreach ($municipios as $item)
                        <option @if($cliente && $item->id_municipio === $cliente->id_municipio) selected @endif
                            value="{{$item->id_municipio}}">{{$item->nombre_municipio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="barrio_contacto" class="control-label">Barrio</label>
                    <input type="text" class="form-control" id="barrio_contacto" name="barrio_contacto" @if($cliente)
                        value="{{$cliente->barrio_contacto }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="direccion_contacto" class="control-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion_contacto" name="direccion_contacto"
                        @if($cliente) value="{{$cliente->direccion_contacto }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="celular_contacto" class="control-label">Teléfono Celular</label>
                    <input type="text" class="form-control" id="celular_contacto" name="celular_contacto" @if($cliente)
                        value="{{$cliente->celular_contacto }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="telefono_contacto" class="control-label">Teléfono fijo</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_contacto">@if($cliente) +{{$cliente->indicativo_contacto }} @else +1 @endif </span>
                        <input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto"
                            @if($cliente) value="{{$cliente->telefono_contacto }}" @endif />
                    </div>


                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="email_contacto" class="control-label">Correo electrónico</label>
                    <input type="text" class="form-control" id="email_contacto" name="email_contacto" @if($cliente)
                        value="{{$cliente->correo_electronico_contacto }}" @endif />
                </div>
            </div>
            <div class="form-group">
                <label for="celular_contacto" class="control-label">Otros datos de contacto</label>
                <textarea rows="4" class="form-control"
                    id="otra_informacion_contacto"
                    name="otra_informacion_contacto">@if($cliente){{$cliente->numero_documento_contacto}}{{$cliente->informacion_adicional}}@endif</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="estado_cliente" class="control-label">Estado</label>
            <div class="checkbox-form">
                <input type="checkbox" data-on="Activo" data-off="Inactivo" data-width="90" class="form-control checkbox-toogle"
                    id="estado_cliente" name="estado" @if($cliente && $cliente->estado_cliente == 1) checked @endif />
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" style="width:100%">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function(){
        cliente.changeBeneficiario($('#id_tipo_documento_beneficiario'))
        $('.autosave').autosave()
    })
</script>
@endsection
