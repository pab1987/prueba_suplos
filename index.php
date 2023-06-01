<?php

require_once('Controllers/OfertaController.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once('Controllers/ProductoController.php');

    $datosRespuesta = ProductoController::buscarProductos();

    // Devuelve los resultados como una respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($datosRespuesta);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que se hayan enviado los datos esperados
    $requiredFields = ['objeto', 'actividad', 'descripcion', 'moneda', 'presupuesto'];

    $missingFields = array_diff($requiredFields, array_keys($_POST));
    if (!empty($missingFields)) {
        echo "Faltan campos obligatorios: " . implode(', ', $missingFields);
        return;
    }

    $oferta = OfertaController::agregarOferta($_POST);
    if (!empty($oferta)) {
        // Redirigir a la página de éxito
        header("Location: ./views/index.html");
        exit;
    } else {
        // Redirigir a la página de error
        header("Location: ./views/form.html");
        exit;
    }
}
