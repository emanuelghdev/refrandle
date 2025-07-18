<?php
    require_once('refranes.class.php');

    // Establecemos la cabecera para JSON
    header('Content-Type: application/json; charset=utf-8');

    // Obtenemos el refrán aleatorio
    $refran = Refran::obtenerAleatorioConVariantes();

    // Mostramos el resultado como JSON
    echo json_encode($refran, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>