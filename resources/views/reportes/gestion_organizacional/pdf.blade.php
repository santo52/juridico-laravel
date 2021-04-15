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
<div style="padding:2rem">
    <table  style="width:100%" class="simple-table">
        <thead>
            <tr>
                <td>Responsable</td>
                <td>Tipo de proceso</td>
                <td>Etapa</td>
                <td>Actuación</td>
                <td>Estado</td>
                <td>Completada a tiempo</td>
                <td>Eficiencia</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bb">R1</td>
                <td class="bb">P1</td>
                <td class="bb">E1</td>
                <td class="bb">A1</td>
                <td class="bb"></td>
                <td class="bb"></td>
                <td class="bb"></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="padding:2rem">
    <table style="width:100%" class="simple-table">
        <tr>
            <th colspan=3>Gestión de R2</th>
            <th colspan=2># Asignadas</th>
            <th># Completadas a tiempo</th>
            <th># Eficiencia</th>
        </tr>

        <tr>
            <td class="bb">R1</td>
            <td class="bb">P1</td>
            <td class="bb">E1</td>
            <td class="bb">A1</td>
            <td class="bb"></td>
            <td class="bb"></td>
            <td class="bb"></td>
        </tr>
    </table>
</div>

<div style="padding:2rem">
    <table style="width:100%" class="simple-table">
        <tr>
            <th>Gestión de etapas</th>
            <td># Asignación</td>
            <td># completadas a tiempo</td>
            <td>% Eficiencia</td>
        </tr>

        <tr>
            <td class="bb">E1</td>
            <td class="bb">####</td>
            <td class="bb">####</td>
            <td class="bb"></td>
        </tr>
    </table>
</div>

<div style="padding:2rem">
    <table style="width:100%" class="simple-table">
        <tr>
            <th>Gestión de Tipo de Procesos</th>
            <td># Asignación</td>
            <td># completadas a tiempo</td>
            <td>% Eficiencia</td>
        </tr>

        <tr>
            <td class="bb">E1</td>
            <td class="bb">####</td>
            <td class="bb">####</td>
            <td class="bb"></td>
        </tr>
    </table>
</div>

<!-- FIN BODY -->


