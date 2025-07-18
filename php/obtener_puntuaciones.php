<?php
    require_once('puntuaciones.class.php');

    // Establecer cabecera para JSON
    header('Content-Type: application/json; charset=utf-8');

    try {
        if (!isset($_GET['mode'])) {
            // Si no viene el modo, devolvemos array vacío
            echo json_encode([]);
            exit;
        }

        $mode = intval($_GET['mode']);

        // Llamamos al método que recupera las puntuaciones de la BD
        $scores = Puntuacion::obtenerDistribucion($mode);

        // Aseguramos que sea array de enteros
        // El método ya hace intval internamente
        if (!is_array($scores)) {
            $scores = [];
        }
        echo json_encode($scores);
    } catch (Exception $e) {
        error_log("Error en obtener_puntuaciones.php: " . $e->getMessage());
        echo json_encode([]);
    }
?>