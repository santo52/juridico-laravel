@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation">
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Información del proceso
            </a>
        </li>
        <li role="presentation" class="active">
            <a href="#documentos-proceso" aria-controls="documentos-proceso" role="tab" data-toggle="tab">
                Documentos del proceso
            </a>
        </li>
    </ul>

    <form class="tab-content" onsubmit="proceso.upsert(event)">
        @if ($proceso)
        <input type="hidden" name="id_proceso" value="{{$proceso->id_proceso}}" />
        @endif
        <div role="tabpanel" class="tab-pane " id="informacion-proceso">
            <div class="form-group row">
                @if($proceso)
                <div class="col-xs-12 col-sm-4">
                    <label for="telefono" class="control-label">Fecha de creación</label>
                    <input type="text" class="form-control" @if($proceso) value="{{$proceso->fecha_creacion }}" @endif
                        disabled />
                </div>
                @endif
                <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
                    <label for="telefono" class="control-label">Número de proceso</label>
                    <input type="text" class="form-control required" id="numero_proceso" name="numero_proceso"
                        @if($proceso) value="{{$proceso->numero_proceso }}" @endif />
                </div>
                <div class="col-xs-12 @if($proceso) col-sm-4 @else col-sm-6 @endif">
                    <label for="telefono" class="control-label">Identificación de la carpeta física</label>
                    <input type="text" class="form-control required" id="id_carpeta" name="id_carpeta" @if($proceso)
                        value="{{$proceso->id_carpeta }}" @endif />
                </div>
            </div>
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_cliente" class="control-label">Cliente</label>
                    <select id="id_cliente" name="id_cliente" data-live-search="true" class="form-control required"
                        title="Seleccionar" onchange="proceso.changeCliente(this)">
                        @foreach ($clientes as $item)
                        <option @if($proceso && $proceso->id_cliente == $item->id_cliente) selected @endif
                            value="{{$item->id_cliente}}">
                            {{$item->primer_nombre}} {{$item->segundo_nombre}} {{$item->primer_apellido}}
                            {{$item->segundo_apellido}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Cédula cliente</label>
                    <input type="text" class="form-control" id="documento_cliente" @if($proceso)
                        value="{{$proceso->celular }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono cliente</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">+1</span>
                        <input disabled type="text" class="form-control required" id="telefono_cliente">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Nombre intermediario</label>
                    <input type="text" class="form-control" id="nombre_intermediario" @if($proceso)
                        value="{{$proceso->celular }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono intermediario</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_intermediario">+1</span>
                        <input disabled type="text" class="form-control required" id="telefono_intermediario">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Correo electrónico intermediario</label>
                    <input type="text" class="form-control" id="email_intermediario" @if($proceso)
                        value="{{$proceso->celular }}" @endif disabled />
                </div>
            </div>
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="id_tipo_proceso" class="control-label">Tipo de proceso</label>
                    <select id="id_tipo_proceso" name="id_tipo_proceso" data-live-search="true"
                        class="form-control required" title="Seleccionar">
                        @foreach ($tiposProceso as $item)
                        <option @if($proceso && $proceso->id_tipo_proceso == $item->id_tipo_proceso) selected @endif
                            value="{{$item->id_tipo_proceso}}">{{$item->nombre_tipo_proceso}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="id_entidad_demandada" class="control-label">Entidad demandada</label>
                    <select id="id_entidad_demandada" name="id_entidad_demandada" data-live-search="true"
                        class="form-control required" title="Seleccionar">
                        @foreach ($entidadesDemandadas as $item)
                        <option @if($proceso && $proceso->id_entidad_demandada == $item->id_entidad_demandada) selected
                            @endif
                            value="{{$item->id_entidad_demandada}}">{{$item->nombre_entidad_demandada}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_usuario_responsable" class="control-label">Usuario responsable</label>
                    <select name="id_usuario_responsable" id="id_usuario_responsable" data-live-search="true"
                        class="form-control required" title="Seleccionar">
                        @foreach ($usuarios as $item)
                        <option @if($proceso && $proceso->id_usuario_responsable == $item->id_usuario) selected @endif
                            value="{{$item->id_usuario}}">
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
                    <label for="valor_estudio" class="control-label">Valor del estudio (si aplica)</label>
                    <input type="text" class="form-control" id="valor_estudio" name="valor_estudio" @if($proceso)
                        value="{{$proceso->valor_estudio }}" @endif />
                </div>

                <div class="col-xs-12 col-sm-4">
                    <label for="fecha_retiro_servicio" class="control-label">Fecha de retiro del servicio</label>
                    <input name="fecha_retiro_servicio" id="fecha_retiro_servicio" data-date-format="yyyy-mm-dd"
                        class="form-control datepicker-here required" @if($proceso)
                        value="{{$proceso->fecha_retiro_servicio }}" @endif />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="id_entidad_justicia" class="control-label">Última entidad de servicio (entidad de
                        justicia)</label>
                    <select name="id_entidad_justicia" id="id_entidad_justicia" data-live-search="true"
                        class="form-control required" title="Seleccionar">
                        @foreach ($entidadesJusticia as $item)
                        <option @if($proceso && $proceso->id_entidad_justicia == $item->id_entidad_justicia) selected
                            @endif
                            value="{{$item->id_entidad_justicia}}">{{$item->nombre_entidad_justicia}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <label for="id_acto_administrativo_retiro" class="control-label">Acto administrativo del retiro
                        (actuación)</label>
                    <select name="id_acto_administrativo_retiro" id="id_acto_administrativo_retiro"
                        data-live-search="true" class="form-control required" title="Seleccionar">
                        @foreach ($actuaciones as $item)
                        <option @if($proceso && $proceso->id_acto_administrativo_retiro == $item->id_actuacion) selected
                            @endif
                            value="{{$item->id_actuacion}}">{{$item->nombre_actuacion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_pais" class="control-label">Pais</label>
                    <select id="id_pais" data-live-search="true" class="form-control required" title="Seleccionar">
                        @foreach ($paises as $item)
                        <option @if($proceso) @if($proceso->id_pais == $item->id_pais) selected @endif @else selected
                            @endif
                            value="{{$item->id_pais}}">{{$item->nombre_pais}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_departamento" class="control-label">Departamento</label>
                    <select id="id_departamento" data-live-search="true" class="form-control required"
                        title="Seleccionar" onchange="proceso.changeDepartamento(this)">
                        @foreach ($departamentos as $item)
                        <option @if($proceso && $proceso->id_departamento == $item->id_departamento) selected @endif
                            value="{{$item->id_departamento}}">{{$item->nombre_departamento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_municipio" class="control-label">Municipio</label>
                    <select data-live-search="true" class="form-control required" title="Seleccionar" id="id_municipio"
                        name="id_municipio">
                        @foreach ($municipios as $item)
                        <option @if($proceso && $proceso->id_municipio == $item->id_municipio) selected @endif
                            value="{{$item->id_municipio}}">{{$item->nombre_municipio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="normatividad_aplicada_caso" class="control-label">Normatividad aplicada al caso</label>
                    <input type="text" class="form-control required" id="normatividad_aplicada_caso"
                        name="normatividad_aplicada_caso" @if($proceso)
                        value="{{$proceso->normatividad_aplicada_caso }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="dar_informacion_caso" class="control-label">¿Se autoriza a dar información del
                        caso?</label>
                    <div class="checkbox-form">
                        <input type="checkbox" data-on="Si" data-off="No" data-width="90" class="form-control"
                            id="dar_informacion_caso" name="dar_informacion_caso" @if($proceso &&
                            $proceso->dar_informacion_caso
                        == 1) checked @endif />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="observaciones_caso" class="control-label">Observaciones del caso</label>
                <textarea name="observaciones_caso" id="observaciones_caso" rows="4"
                    style="resize: vertical; min-height: 100px"
                    class="form-control required">@if($proceso){{$proceso->observaciones_caso}}@endif</textarea>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane active" id="documentos-proceso">

            {{-- <div>
            <ul>
                <li>
                    <div class="close"></div>
                    <span class="image"></span>
                    <div class="content">
                        <div class="name"></div>
                        <div class="progress"></div>
                    </div>
                </li>
            </ul>
        </div> --}}


            <div class="flex space-between">
                <nav class="navbar navbar-default flex-grow">
                    <div class="container-fluid">
                        <div class="navbar-header" style="width:100%">
                            <h5>Documentos requeridos</h5>
                            <div class="separator"></div>
                        </div>
                        <div class="separator margin white"></div>
                        @foreach ($documentos as $item)
                        <div class="file-document" data-filename="{{$item->filename}}" data-id="{{$item->id_documento}}"
                            data-title="{{$item->nombre_documento}}" @if($item->obligatoriedad_documento == 1)
                            data-required="true" @else data-required="true" @endif></div>
                        @endforeach
                    </div>
                </nav>
                <div style="width: 10px"></div>
                <nav class="navbar navbar-default flex-grow">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <h5>Documentos generados</h5>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
        <button class="btn btn-success" style="width: 100%">Guardar proceso</button>
    </form>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        proceso.changeCliente('#id_cliente')
        fileDocument.init({
            url: 'proceso/upload',
            path: 'uploads/documentos',
            id: getId(),
        })
    })
</script>
@endsection
