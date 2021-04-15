<style>

table {
    border: 0;
    width: 100%;
    font-family: sans-serif
}

tr {
    line-height: 1;
}

td {
    padding:10px;
    padding-left:0;
    line-height: 1;
}

table.header td {
   padding: 0;
}

.bold {
    font-weight: bold;
}

.title {
    font-weight: bold;
}

.subtitle {
    font-weight: bold;
}

.text-center {
    text-align: center;
}

.simple-table {
    border-collapse: collapse;
}

.simple-table th,
.simple-table td{
    text-align: left;
    padding: 10px 5px;
    border:1px solid black;
    border-bottom:0;
    border-right:0;
}

.simple-table .br,
.simple-table td:last-child,
.simple-table th:last-child{
    border-right:1px solid black !important;
}

.simple-table .bb,
.simple-table tr:last-child{
    border-bottom:1px solid black !important;
}
</style>

<!-- HEADER -->
<table class="header">
    <tr>
        <td rowspan="6"><img src="{{$_SERVER['DOCUMENT_ROOT']}}/images/logo.png"/></td>
    </tr>
    <tr class="text-center bold">
        <td>{{strtoupper(Auth::user()->getNombreCompleto(false))}}</td>
    </tr>
    <tr class="text-center bold">
        <td>Abogado</td>
    </tr>
    <tr class="text-center bold">
        <td>Calle 19 No. 3- 10 Oficina 12-01 torre B Edificio Barichara. Bogotá D.C.</td>
    </tr>
    <tr class="text-center bold">
        <td>Tel. 2822816 – 2433103 Cel. 3103218219</td>
    </tr>
    <tr class="text-center bold">
        <td>Correo Electrónico info@organizacionsanabria.com.co</td>
    </tr>
</table>

<div style="background:black;margin:30px;height:3px;"></div>

<!-- FIN HEADER -->

<!-- BODY -->
<div style="margin:30px;">
    @foreach ($procesos as $proceso)
        <table style="width:100%">
            <tr>
                <td width="40%"><b>Tipo Proceso: <?=$proceso->nombre_tipo_proceso?></b></td>
            </tr>
        </table>


            <br />
            <table style="width:100%">
                <tr>
                    <td>Cliente: {{ $proceso->cliente->getNombreCompleto()}}</td>
                    <td>Cedula: {{$proceso->cliente->getNumeroDocumento()}}</td>
                </tr>

                <tr>
                    <td>Entidad Justicia 1a Inst: {{ $proceso->getEntidadJusticiaPrimeraInstancia() }}</td>
                    <td>Entidad Justicia 2a Inst: {{ $proceso->getEntidadJusticiaSegundaInstancia() }}</td>
                    <td>Número radicado: {{ $proceso->getEntidadJusticiaSegundaInstancia() }}</td>
                </tr>



                <span style="display:none">{!! $key = 1 !!}</span>
                @foreach($tiposResultado as $c => $tipoResultado)
                    @if ( $tipoResultado->id_tipo_resultado > 8)
                        @if($key == 1)
                        <tr>
                        @endif
                        <td >{{$tipoResultado->nombre_tipo_resultado}}:
                            @if($tipoResultado->tipo_campo == 5)
                                $ {{number_format($tipoResultado->value, 0, ',', '.')}}
                            @else
                                {{$tipoResultado->value}}
                            @endif
                        </td>
                        @if($key == 3 || ($c + 1) == count($tiposResultado))
                            </tr>
                            <span style="display:none">{!! $key = 0 !!}</span>
                        @endif
                        <span style="display:none">{!! $key++ !!}</span>
                    @endif
                @endforeach

            </table>
            <br />
            @foreach ($proceso->etapas as $etapa)
            <br />
            <table style="width:100%">
                <tr>
                    <td colspan=4>Etapa: {{$etapa->nombre_etapa_proceso}}</td>
                </tr>
            </table>
            <table style="width:100%" class="simple-table" cellspacing=0>
                <tr>
                    <th>Tipo Actuación</th>
                    <th>Actuación</th>
                    <th>Responsable</th>
                    <th>Estado</th>
                </tr>
                @foreach ($etapa->actuaciones as $actuacion)
                    <tr>
                        <td>{{$tiposActuacion[$actuacion->tipo_actuacion]}}</td>
                        <td>{{$actuacion->nombre_actuacion}}</td>
                        <td>{{$actuacion->responsable}}</td>
                        <td>{{$actuacion->estado}}</td>
                    </tr>
                @endforeach
            </table>
            @endforeach

        <hr />
    @endforeach
</div>


<!-- FIN BODY -->


