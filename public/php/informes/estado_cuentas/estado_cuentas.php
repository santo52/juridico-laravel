<?php
    include '../../classes/DataBase.php';

    $bd = new DataBase();

    $strSQL = "SELECT ";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de cuentas</title>
    <style>
        body {
            font-family: arial;
            font-size: 12px
        }

        .border{
            border: 1px solid;
        }

        .tableEstado thead tr th,
        .tableEstado tbody tr td
        {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div style="text-align:center; color:#3B9ED9">
        Reporte 3: ESTADO DE CUENTA DE PROCESOS
    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">CONSULTA</div>

    <div style="padding: 2rem 30rem;text-align:center">
        <div style="display:inline-block">Nombre del cliente</div>
        <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
        <div style="display:inline-block">Cedula del cliente</div>
        <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
        <div style="display:inline-block">Tipo de proceso</div>
        <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
    </div>


    <div style="margin-top: 2rem;padding-left: 5rem;width: 100%;">
        <table style="width:100%;font-size: 10px;" cellspacing=0>
            <tr>
                <td rowspan=10 width="10%">Actuaciones</td>
                <td class="border">A1</td>
            </tr>
            <tr>
                <td class="border">A2</td>
            </tr>
            <tr>
                <td class="border">A3</td>
            </tr>
            <tr>
                <td class="border">A4</td>
            </tr>
            <tr>
                <td class="border">A5</td>
            </tr>
            <tr>
                <td class="border">A6</td>
            </tr>
            <tr>
                <td class="border">A7</td>
            </tr>
            <tr>
                <td class="border">A8</td>
            </tr>
            <tr>
                <td class="border">A9</td>
            </tr>
            <tr>
                <td class="border">A10</td>
            </tr>
        </table>

    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">PRESENTACIÓN</div>

    <div style="margin-top: 2rem;">
        <table style="width:100%">
            <tr>
                <td width="30%" style="float:right">Nombre del cliente</td>
                <td width="20%" class="border"></td>
                <td width="30%" style="float:right">Nombre del beneficiario</td>
                <td width="20%" class="border"></td>
            </tr>

            <tr>
                <td width="30%" style="float:right">Cedula del cliente</td>
                <td width="20%" class="border"></td>
                <td width="30%" style="float:right">Cedula del beneficiario</td>
                <td width="20%" class="border"></td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        <table style="width:100%;font-size: 10px;">
            <tr>
                <td width="16%" >Tipo de proceso</td>
                <td width="16%" class="border"></td>
                <td width="16%">Normatividad</td>
                <td width="16%" class="border"></td>
                <td width="16%">Entidad demandada</td>
                <td width="16%" class="border"></td>
            </tr>

            <tr>
                <td width="16%">Nro Radicado</td>
                <td width="16%" class="border"></td>
                <td width="16%" ></td>
                <td width="16%" colspan=2>Entidad Justicia 1a.Instancia</td>
                <td width="16%" class="border"></td>
            </tr>

            <tr>
                <td colspan=3></td>
                <td width="16%" colspan=2>Entidad Justicia 2a.Instancia</td>
                <td width="16%" class="border"></td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        <table style="width:100%" class="tableEstado">
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
                    <td>E1</td>
                    <td>A1</td>
                    <td></td>
                    <td>DD-MM-YY</td>
                    <td>DD-MM-YY</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
