<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');


    require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
    ob_start(); # apertura de bufer
    include( 'honorarios.php' );
    $text = ob_get_contents();
    ob_end_clean(); # cierre de bufer

    $mpdf = new \Mpdf\Mpdf(['format' => 'Letter']);
    $mpdf->WriteHTML($text);
    $mpdf->Output();


?>
