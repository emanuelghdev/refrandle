<?php
    require_once('refranes.class.php');

    // Establecemos la cabecera para JSON
    header('Content-Type: application/json; charset=utf-8');

    // Obtenenemos todos los refranes de la BD
    $refranes = Refran::obtenerTodos();

    // Mostramos el resultado como JSON
    echo json_encode($refranes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>