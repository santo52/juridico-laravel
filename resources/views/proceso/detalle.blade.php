@section('title', 'Jurídico | Detalle del proceso')

@section('content')

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#informacion-proceso" aria-controls="informacion-proceso" role="tab" data-toggle="tab">
                Información del proceso
            </a>
        </li>
        {{-- <li role="presentation" id="documentos-tab" @if (!count($documentos)) style="display: none" @endif> --}}
        {{-- <li role="presentation" id="documentos-tab">
            <a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">
                Documentos
            </a>
        </li> --}}
    </ul>
    <form class="tab-content" onsubmit="proceso.upsert(event)">
        @if ($proceso)
        <input type="hidden" name="id_proceso" value="{{$proceso->id_proceso}}" />
        @endif


        <div role="tabpanel" class="tab-pane active" id="informacion-proceso">
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="id_cliente" class="control-label">Cliente</label>
                    <select id="id_cliente" name="id_cliente" data-live-search="true" class="form-control required"
                        title="Seleccionar" onchange="proceso.changeCliente(this)">
                        @foreach ($clientes as $item)
                        <option @if($proceso && $proceso->id_cliente == $item->id_cliente) selected @endif
                            value="{{$item->id_cliente}}">{{$item->getNombreCompleto()}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label class="control-label">Cédula cliente</label>
                    <input type="text" class="form-control" id="documento_cliente" @if($proceso)
                        value="{{$proceso->cliente->persona->numero_documento }}" @endif disabled />
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Estado vital cliente</label>
                    <input type="text" class="form-control" id="estado_vital_cliente" @if($proceso)
                        value="{{$proceso->cliente->getEstadoVital() }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono fijo cliente</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">+1</span>
                        <input disabled type="text" class="form-control" id="telefono_cliente" @if($proceso)
                            value="{{$proceso->cliente->persona->telefono }}" @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Correo electrónico cliente</label>
                    <input type="text" class="form-control" id="email_cliente" @if($proceso)
                        value="{{$proceso->cliente->persona->correo_electronico }}" @endif disabled />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label for="id_pais" class="control-label">Pais</label>
                    <select id="id_pais" data-live-search="true" class="form-control required" title="Seleccionar">
                        @foreach ($paises as $item)
                        <option @if($proceso) @if($proceso->municipio->departamento->id_pais == $item->id_pais) selected
                            @endif @else selected
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
                        <option @if($proceso && $proceso->municipio->id_departamento == $item->id_departamento) selected
                            @endif
                            value="{{$item->id_departamento}}">{{$item->nombre_departamento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_municipio" class="control-label">Municipio</label>
                    <select data-live-search="true" class="form-control required" title="Seleccionar" id="id_municipio"
                        name="id_municipio">
                        @foreach ($municipios as $item)
                        <option @if($proceso && $proceso->municipio->id_municipio == $item->id_municipio) selected
                            @endif
                            value="{{$item->id_municipio}}">{{$item->nombre_municipio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Nombre completo beneficiario</label>
                    <input type="text" class="form-control" id="nombre_beneficiario" @if($proceso)
                        value="{{$proceso->cliente->nombre_beneficiario }}" @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Teléfono fijo beneficiario</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_beneficiario">+1</span>
                        <input disabled type="text" class="form-control" id="telefono_beneficiario" @if($proceso)
                            value="{{$proceso->cliente->telefono_beneficiario }}" @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="control-label">Correo electrónico beneficiario</label>
                    <input type="text" class="form-control" id="email_beneficiario" @if($proceso)
                        value="{{$proceso->cliente->correo_electronico_beneficiario }}" @endif disabled />
                </div>
            </div>
            <div class="form-group row">
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


            <div class="separator margin"></div>

            <div class="form-group">
                <label for="observaciones_caso" class="control-label">Descripción del proceso</label>
                <textarea name="observaciones_caso" id="observaciones_caso" rows="4"
                    style="resize: vertical; min-height: 100px"
                    class="form-control required">@if($proceso){{$proceso->observaciones_caso}}@endif</textarea>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="id_tipo_proceso" class="control-label">Tipo de proceso</label>
                    <select id="id_tipo_proceso" name="id_tipo_proceso" data-live-search="true"
                        class="form-control required" title="Seleccionar" onchange="proceso.changeTipoProceso(this)">
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
                    <label for="normatividad_aplicada_caso" class="control-label">Normatividad aplicada al caso</label>
                    <input type="text" class="form-control required" id="normatividad_aplicada_caso"
                        name="normatividad_aplicada_caso" @if($proceso)
                        value="{{$proceso->normatividad_aplicada_caso }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="id_carpeta" class="control-label">Identificación de la carpeta física</label>
                    <input type="text" class="form-control" id="id_carpeta" name="id_carpeta" @if($proceso)
                        value="{{$proceso->id_carpeta }}" @endif />
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label for="caducidad" class="control-label">Caducidad</label>
                    <div class="checkbox-form">
                        <input type="checkbox" data-on="Si" data-off="No" data-width="90" class="form-control"
                            id="caducidad" name="caducidad" @if($proceso && $proceso->caducidad
                        == 1) checked @endif />
                    </div>
                </div>
            </div>
            @if($proceso)
            <div class="separator margin"></div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label class="control-label">Usuario responsable</label>
                    <input type="text" class="form-control" @if($proceso)
                        value="{{$proceso->responsable ? $proceso->responsable->getNombreCompleto() : 'Sin responsable' }}"
                        @endif disabled />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label class="control-label">Etapa actual</label>
                    <input type="text" class="form-control" @if($proceso)
                        value="{{$proceso->etapa ? $proceso->etapa->nombre_etapa_proceso : 'Sin iniciar' }}" @endif
                        disabled />
                </div>
            </div>

            <div class="separator margin"></div>
            <span style="display:none">{!! $key = 1 !!}</span>
            @foreach($tiposResultado as $c => $tipoResultado)
                @if($key == 1)
                <div class="form-group row">
                @endif
                <div class="col-xs-12 col-sm-4">
                    <label for="telefono" class="control-label">{{$tipoResultado->nombre_tipo_resultado}}</label>
                    <input type="text" class="form-control" @if($proceso && $tipoResultado->id_tipo_resultado == 5) value="{{$proceso->numero_proceso}}" @else value="{{$tipoResultado->value}}" @endif disabled />
                </div>
                @if($key == 3 || ($c + 1) == count($tiposResultado))
                    </div>
                    <span style="display:none">{!! $key = 0 !!}</span>
                @endif
                <span style="display:none">{!! $key++ !!}</span>
            @endforeach
            @endif

            <div class="separator margin"></div>


            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="valor_estudio" class="control-label">Gastos iniciales del contrato</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="indicativo_cliente">$</span>
                        <input type="text" class="form-control numeric required" id="valor_estudio" name="valor_estudio"
                        @if($proceso) value="{{$proceso->valor_estudio }}" @endif />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="acto_administrativo" class="control-label">Acto administrativo del retiro</label>
                    <input type="text" class="form-control" id="acto_administrativo" name="acto_administrativo"
                        @if($proceso) value="{{$proceso->acto_administrativo }}" @endif />
                </div>


            </div>
            <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                    <label for="fecha_retiro_servicio" class="control-label">Fecha de retiro del servicio</label>
                    <input name="fecha_retiro_servicio" id="fecha_retiro_servicio" data-date-format="yyyy-mm-dd"
                        class="form-control datepicker-here" @if($proceso) value="{{$proceso->fecha_retiro_servicio }}"
                        @endif />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="ultima_entidad_retiro" class="control-label">Última entidad de servicio</label>
                    <input type="text" class="form-control required" id="ultima_entidad_retiro"
                        name="ultima_entidad_retiro" @if($proceso) value="{{$proceso->ultima_entidad_retiro }}"
                        @endif />
                </div>
            </div>

            <button class="btn btn-success" style="width: 100%">Guardar proceso</button>
        </div>

        {{-- <div role="tabpanel" class="tab-pane" id="historico">
            <table id="historicoTable" class="table table-hover" data-empty="Sin historico de sentencias"
                data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
                data-filter-container="#filter-form-container" data-sorting="false" data-filtering="false"
                data-paging="false" data-filter-placeholder="Buscar ..." data-filter-position="left"
                data-filter-dropdown-title="Buscar por" data-filter-space="OR">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historico as $item)
                    <tr>
                        <td>{{$item->getFechaResultadoString()}}</td>
                        <td>{{$item->getResponsable()}}</td>
                        <td>{{$item->resultado_actuacion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}

        {{-- <div role="tabpanel" class="tab-pane" id="documentos">
            <table id="historicoTable" class="table table-hover" data-empty="Sin historico de sentencias"
                data-paging-count-format="Mostrando del {PF} al {PL} de {TR} registros"
                data-filter-container="#filter-form-container" data-sorting="false" data-filtering="false"
                data-paging="false" data-filter-placeholder="Buscar ..." data-filter-position="left"
                data-filter-dropdown-title="Buscar por" data-filter-space="OR">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historico as $item)
                    <tr>
                        <td>{{$item->getFechaResultadoString()}}</td>
                        <td>{{$item->getResponsable()}}</td>
                        <td>{{$item->resultado_actuacion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </form>
</div>
@endsection

@section('javascript')
{{-- <script>
    $(document).ready(function(){
        proceso.changeCliente('#id_cliente')
        const id = getId()
        $('.file-document').fileDocument({
            url: 'proceso/upload',
            path: 'uploads/documentos',
            id
        })

        !id && $('#documentos-proceso-tab').hide()
    })
</script> --}}
@endsection
