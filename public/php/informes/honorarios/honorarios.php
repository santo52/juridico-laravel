<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

    include '../../classes/DataBase.php';

    $bd = new DataBase();

    $strSQL = "SELECT nombre_tipo_proceso,nombre_entidad_demandada,numero_documento,concat(primer_nombre,' ',segundo_nombre,' ',primer_apellido ) as nombreCompleto
    FROM proceso pr
    LEFT JOIN cliente c on pr.id_cliente = c.id_cliente
    LEFT JOIN persona pe on pe.id_persona = c.id_persona
    LEFT JOIN entidad_demandada ed on ed.id_entidad_demandada = pr.id_entidad_demandada
    LEFT JOIN tipo_proceso tp on tp.id_tipo_proceso = pr.id_tipo_proceso
    WHERE id_proceso=27";
    $proceso = $bd->query($strSQL)->single();
    if($proceso){
        extract($proceso);
    }
    print_r($proceso);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HONORARIOS Y GASTOS PROCESALES</title>
    <style>
        body {
            font-family: arial;
            font-size: 12px
        }

        .border{
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div style="text-align:center; color:#3B9ED9">
        Reporte 4: HONORARIOS Y GASTOS PROCESALES
    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">CONSULTA</div>

    <div style="padding:0.5rem">
        <table style="width:100%">
            <tr>
                <td width="16%">Desde</td>
                <td class="border" width="16%"></td>
                <td width="16%">Hasta</td>
                <td width="16%" class="border"></td>
                <td width="16%">Tipo de proceso</td>
                <td width="16%" class="border"><?=$nombre_tipo_proceso?></td>
            </tr>
        </table>
    </div>

    <div style="padding:0.5rem">
        <table style="width:100%">
            <tr>
                <td width="16%">Nombre del cliente</td>
                <td class="border" width="16%"><?=$nombreCompleto?></td>
                <td width="16%">Cedula del cliente</td>
                <td width="16%" class="border"><?=$numero_documento?></td>
                <td width="16%">Intermediario</td>
                <td width="16%" class="border"></td>
            </tr>
        </table>
    </div>

    <div style="padding:0.5rem">
        <table style="width:100%">
            <tr>
                <td width="16%">Entidad demandada</td>
                <td class="border" width="16%"><?=$nombre_entidad_demandada?></td>
                <td width="16%">Ciudad 1a. Instancia</td>
                <td width="16%" class="border"></td>
                <td width="16%">Ciudad 2a. Instancia</td>
                <td width="16%" class="border"></td>
            </tr>
        </table>
    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">PRESENTACIÓN</div>

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
</body>
</html>
