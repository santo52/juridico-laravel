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

<div style="margin:30px">
    <table style="width:100%">
        <tr>
            <td width="30%" class="title">Nombre del cliente</td>
            <td width="20%" class="border"></td>
            <td width="30%" class="title">Nombre del beneficiario</td>
            <td width="20%" class="border"></td>
        </tr>
        <tr class="bb">
            <td width="30%" class="title">Cedula del cliente</td>
            <td width="20%" class="border"></td>
            <td width="30%" class="title">Cedula del beneficiario</td>
            <td width="20%" class="border"></td>
        </tr>
    </table>
</div>

<div style="margin:30px">
    <table style="width:100%;">
        <tr>
            <td width="16%" class="subtitle" >Tipo de proceso</td>
            <td width="16%" class="border"></td>
            <td width="16%" class="subtitle">Normatividad</td>
            <td width="16%" class="border"></td>
        </tr>

        <tr>
            <td width="16%" class="subtitle">Entidad demandada</td>
            <td width="16%" class="border"></td>
            <td width="16%"class="subtitle">Nro Radicado</td>
            <td width="16%" class="border"></td>
        </tr>

        <tr class="bb">
            <td width="16%" class="subtitle">Entidad Justicia 1a.Instancia</td>
            <td width="16%" class="border"></td>
            <td width="16%" class="subtitle">Entidad Justicia 2a.Instancia</td>
            <td width="16%" class="border"></td>
        </tr>
    </table>
</div>

<div style="padding: 2rem 30rem;text-align:center">
    <div style="display:inline-block">Periodo</div>
    <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
    <div style="display:inline-block">Desde</div>
    <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
    <div style="display:inline-block">Hasta</div>
    <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
</div>


<div style="width:100%;text-align:center;display: inline-block;">
    <div style="display: inline-block;">Tipo de proceso:  </div>
    <div class="border" style="width: 10rem;margin-left:1rem;display: inline-block;">1</div>
</div>

<div style="margin-top: 2rem;">
    <table style="width:100%;font-size:10px">
        <thead>
            <tr>
                <th></th>
                <th>Entidad Demandada</th>
                <th>Nro Radicado</th>
                <th>Nombre Cliente</th>
                <th>Cedula Cliente</th>
                <th>Ciudad 1a.Ins</th>
                <th>Ciudad 2a.Ins</th>
                <th>Honorarios</th>
                <th></th>
                <th>Comisión</th>
                <th></th>
                <th>Gastos de proceso</th>
                <th>Intermediario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Proceso 1</td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border">$$$$$</td>
                <td class="border">%</td>
                <td class="border">$$$$$</td>
                <td class="border">%</td>
                <td class="border">$$$$$</td>
                <td class="border"></td>
            </tr>

            <tr>
                <td>Proceso 2</td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border">$$$$$</td>
                <td class="border">%</td>
                <td class="border">$$$$$</td>
                <td class="border">%</td>
                <td class="border">$$$$$</td>
                <td class="border"></td>
            </tr>

            <tr>
                <td>Proceso 3</td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border">$$$$$</td>
                <td class="border">%</td>
                <td class="border">$$$$$</td>
                <td class="border">%</td>
                <td class="border">$$$$$</td>
                <td class="border"></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">
    <table style="width:100%">
        <tr>
            <td>
                Total Tipo Proceso P1
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
        </tr>
        <tr>
            <td>
                Subotal por Entidad Demandada (1, 2,3,…N)
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
        </tr>
        <tr>
            <td>
                Subtotal por Ciudad 1a. Instancia (1,2,3,…n)
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
        </tr>
        <tr>
            <td>
                Subtotal por Ciudad 2a. Instancia (1,2,3…n)
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
            <td class="border">
                $$$$$
            </td>
        </tr>
    </table>
</div>

<!-- FIN BODY -->


