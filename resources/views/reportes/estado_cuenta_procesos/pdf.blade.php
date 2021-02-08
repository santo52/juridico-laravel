<style>


table {
    border: 0;
    width: 100%;
    font-family: sans-serif
}

tr {
    line-height: .5;
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
        <td rowspan="6"><img src="http://juridico2.local:8081/images/logo.png"/></td>
    </tr>
    <tr class="text-center bold">
        <td>MANUEL SANABRIA CHACON</td>
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
<div style="margin-top: 2rem;">
    <table style="width:100%">
        <tr>
            <td width="30%" class="title">Nombre del cliente</td>
            <td width="20%" class="border"></td>
            <td width="30%" class="title">Nombre del beneficiario</td>
            <td width="20%" class="border"></td>
        </tr>

        <tr>
            <td width="30%" class="title">Cedula del cliente</td>
            <td width="20%" class="border"></td>
            <td width="30%" class="title">Cedula del beneficiario</td>
            <td width="20%" class="border"></td>
        </tr>
    </table>
</div>

<div style="margin-top: 2rem;">
    <table style="width:100%;">
        <tr>
            <td width="16%" class="title">Tipo de proceso</td>
            <td width="16%" class="border"></td>
            <td width="16%" class="title">Normatividad</td>
            <td width="16%" class="border"></td>
            <td width="16%" class="title">Entidad demandada</td>
            <td width="16%" class="border"></td>
        </tr>

        <tr>
            <td width="16%" class="title">Nro Radicado</td>
            <td width="16%" class="border"></td>
            <td width="16%" ></td>
            <td width="16%" class="title" colspan=2>Entidad Justicia 1a.Instancia</td>
            <td width="16%" class="border"></td>
        </tr>

        <tr>
            <td colspan=3></td>
            <td width="16%" class="title" colspan=2>Entidad Justicia 2a.Instancia</td>
            <td width="16%" class="border"></td>
        </tr>
    </table>
</div>

<div style="margin-top: 2rem;">
    <table style="width:100%" class="simple-table">
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Actuación</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Tipo resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>E1</td>
                <td>A1</td>
                <td></td>
                <td>DD-MM-YY</td>
                <td>DD-MM-YY</td>
                <td></td>
            </tr>

            <tr>
                <td class="bb">E1</td>
                <td class="bb">A1</td>
                <td class="bb"></td>
                <td class="bb">DD-MM-YY</td>
                <td class="bb">DD-MM-YY</td>
                <td class="bb"></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- FIN BODY -->


