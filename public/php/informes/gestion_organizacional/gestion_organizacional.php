<?php
    include '../../classes/DataBase.php';

    $bd = new DataBase();

    //select * from usuario_contrato uc left join usuario u on u.id_usuario = uc.id_usuario where fecha_fin <= date_add(current_date(), INTERVAL 30 DAY);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTIÓN ORGANIZACIONAL</title>
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
        Reporte 5: GESTIÓN ORGANIZACIONAL
    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">CONSULTA</div>

    <div style="padding:0.5rem">
        <table style="width:100%">
            <tr>
                <td width="16%">Desde</td>
                <td class="border" width="16%"></td>
                <td width="16%">Hasta</td>
                <td width="16%" class="border"></td>
                <td width="16%">Responsable</td>
                <td width="16%" class="border"></td>
            </tr>
        </table>
    </div>

    <div style="padding:0.5rem">
        <table style="width:100%">
            <tr>
                <td width="16%">Tipo de proceso</td>
                <td class="border" width="16%"></td>
                <td width="16%">Etapa</td>
                <td width="16%" class="border"></td>
                <td width="16%"></td>
                <td width="16%"></td>
            </tr>
        </table>
    </div>

    <div style="padding:0.5rem">
        <table style="width:100%">
            <tr>
                <td width="25%">Entidad de Justicia 1a Intancia</td>
                <td class="border" width="25%"></td>
                <td width="25%">Entidad de Justicia 1a Intancia</td>
                <td width="25%" class="border"></td>
            </tr>
        </table>
    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">PRESENTACIÓN</div>

    <div style="padding:2rem">
        <table  style="width:100%">
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
                    <td class="border">R1</td>
                    <td class="border">P1</td>
                    <td class="border">E1</td>
                    <td class="border">A1</td>
                    <td class="border"></td>
                    <td class="border"></td>
                    <td class="border"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="padding:2rem">
        <table style="width:100%">
            <tr>
                <th colspan=3>Gestión de R2</th>
                <th colspan=2># Asignadas</th>
                <th># Completadas a tiempo</th>
                <th># Eficiencia</th>
            </tr>

            <tr>
                <td class="border">R1</td>
                <td class="border">P1</td>
                <td class="border">E1</td>
                <td class="border">A1</td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
            </tr>
        </table>
    </div>

    <div style="padding:2rem">
        <table style="width:100%">
            <tr>
                <th>Gestión de etapas</th>
                <td># Asignación</td>
                <td># completadas a tiempo</td>
                <td>% Eficiencia</td>
            </tr>

            <tr>
                <td class="border">E1</td>
                <td class="border">####</td>
                <td class="border">####</td>
                <td class="border"></td>
            </tr>
        </table>
    </div>

    <div style="padding:2rem">
        <table style="width:100%">
            <tr>
                <th>Gestión de Tipo de Procesos</th>
                <td># Asignación</td>
                <td># completadas a tiempo</td>
                <td>% Eficiencia</td>
            </tr>

            <tr>
                <td class="border">E1</td>
                <td class="border">####</td>
                <td class="border">####</td>
                <td class="border"></td>
            </tr>
        </table>
    </div>
</body>
</html>
