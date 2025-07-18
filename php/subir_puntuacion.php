<?php
    require_once('puntuaciones.class.php');

    // Establecemos la cabecera para JSON
    header('Content-Type: application/json; charset=utf-8');

    // Obtenemos los datos del POST
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['modo']) || !isset($data['puntuacion'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Datos incompletos']);
        exit;
    }

    $resultado = Puntuacion::guardar(
        $data['modo'],
        $data['puntuacion']
    );

    // Mostramos el resultado como JSON
    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error al guardar puntuación']);
    }
?>