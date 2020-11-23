<?php
    include '../../classes/DataBase.php';

    $bd = new DataBase();

    $strSQL = "SELECT
                nombre_tipo_proceso,
                p.fecha_actualizacion,
                primer_apellido,
                segundo_apellido,
                primer_nombre,
                segundo_nombre,
                numero_documento
                FROM proceso p
                LEFT JOIN tipo_proceso tp on p.id_tipo_proceso = tp.id_tipo_proceso
                LEFT JOIN cliente c on p.id_cliente = c.id_cliente
                LEFT JOIN persona pe on c.id_persona = pe.id_persona
                WHERE id_proceso=27";
    $proceso = $bd->query($strSQL)->single();
    if($proceso){
        extract($proceso);
    }

    $strSQL = "SELECT * FROM proceso_etapa pe LEFT JOIN etapa_proceso ep on pe.id_etapa_proceso=ep.id_etapa_proceso WHERE id_proceso=27";
    $etapas = $bd->query($strSQL)->resultset();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de procesos activos</title>
    <style>
        body {
            font-family: arial;
        }
    </style>
</head>
<body>
    <div style="text-align:center; color:#3B9ED9">
        Reporte 2: GESTIÓN DE PROCESOS ACTIVOS
    </div>

    <div style="color:#3B9ED9;border-bottom:1px solid black">CONSULTA</div>

    <div style="padding: 2rem 30rem;text-align:center">
        <div style="display:inline-block">Periodo</div>
        <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
        <div style="display:inline-block">Desde</div>
        <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
        <div style="display:inline-block">Hasta</div>
        <div style="border: 1px solid;width: 10rem;display:inline-block"></div>
    </div>

    <table style="width:100%">
        <tr>
            <td>Tipo de proceso: <?=$nombre_tipo_proceso?></td>
            <td>Tipo de actuación</td>
            <td>Última actualizada: <?=$fecha_actualizacion?></td>
        </tr>

        <tr>
            <td>Etapa</td>
            <td colspan=2>Actuación</td>
        </tr>
    </table>

    <table style="width:100%;margin-top:5rem">
        <tr>
            <td>Entidad de justicia 1a. Instancia</td>
            <td>Información complementaria del proceso</td>
        </tr>

        <tr>
            <td rowspan=4>Entidad de justicia 2a. Instancia</td>
            <td>Campo 1</td>
        </tr>

        <tr>
            <td>Campo 2</td>
        </tr>
        <tr>
            <td>Campo 3</td>
        </tr>

        <tr>
            <td>Campo 4</td>
        </tr>
    </table>

    <div style="color:#3B9ED9;border-bottom:1px solid black">PRESENTACIÓN</div>

    <table style="width:100%">
        <tr>
            <td width="40%">Tipo Proceso: <?=$nombre_tipo_proceso?></td>
            <td>Periodo</td>
            <td>Desde</td>
            <td>Hasta</td>
        </tr>
    </table>
    <?php
        foreach ($etapas as $key => $value) {
            $strSQL="SELECT * FROM actuacion_etapa_proceso ae LEFT JOIN actuacion a ON ae.id_actuacion=a.id_actuacion LEFT JOIN tipo_resultado tr ON a.tipo_resultado = tr.id_tipo_resultado WHERE ae.id_etapa_proceso = '{$value['id_etapa_proceso']}'";
            $actuacion = $bd -> query($strSQL)->resultset();

            echo '<table style="width:100%">
                    <tr>
                        <td colspan=4>Etapa: '.$value['nombre_etapa_proceso'].'</td>
                    </tr>
                </table>';

            echo '<table style="width:100%">
                    <tr>
                        <td rowspan=2>1</td>
                        <td>Cliente: '.$primer_apellido.' '.$segundo_apellido.' '.$primer_nombre.' '.$segundo_nombre.'</td>
                        <td>Cedula: '.$numero_documento.'</td>
                        <td>Entidad Justicia 1a Inst</td>
                        <td>Entidad Justicia 2a Inst</td>
                    </tr>

                    <tr>
                        <td>Campo 1</td>
                        <td>Campo 2</td>
                        <td>Campo 3</td>
                        <td>Campo 4</td>
                    </tr>
                </table>

                <div style="margin-top: 3rem;margin-left: 10rem;">
                    <table style="width:100%" border=1 cellspacing=0>
                        <tr>
                            <th>Tipo Actuación</th>
                            <th>Estado</th>
                            <th>Actuación</th>
                            <th>Tipo Resultado</th>
                            <th>Responsable</th>
                        </tr>';

                $tiposActuacion = [
                    1 => 'Interno',
                    2 => 'Externo',
                    3 => 'Rama'
                ];

                $responsable = [
                    1 => 'Recepción',
                    2 => 'Administración',
                    3 => 'Agotamientos de via',
                    4 => 'Sustantación',
                    5 => 'Dependencia',
                    6 => 'Mensajeria'
                ];


                foreach ($actuacion as $k => $val) {
                    $estado = 'Inactivo';
                    if($val['estado_actuacion'] == 1 ){
                        $estado = "Activo";
                    }
                    echo '<tr>
                            <td>'.$tiposActuacion[$val['tipo_actuacion']].'</td>
                            <td>'.$estado.'</td>
                            <td>'.$val['nombre_actuacion'].'</td>
                            <td>'.$val['nombre_tipo_resultado'].'</td>
                            <td>'.$responsable[$val['area_responsable']].'</td>
                        </tr>';
                }
                echo '    </table>
                </div>';
        }

    ?>

</body>
</html>
