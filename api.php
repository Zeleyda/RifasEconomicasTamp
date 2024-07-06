<?php
header('Content-Type: application/json');

// Obtener el nombre de la API desde la query string
$api = isset($_GET['api']) ? $_GET['api'] : '';

// Definir el path completo del script en el backend
$backendPath = __DIR__ . '/../backend/' . $api . '.php';

// Verificar si el archivo existe
if (file_exists($backendPath)) {
    // Reenviar la solicitud a la API correspondiente
    // Parámetros GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $params = $_GET;
    }
    // Parámetros POST
    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener el cuerpo de la solicitud si es JSON
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $params = json_decode(file_get_contents("php://input"), true);
        } else {
            $params = $_POST;
        }
    }

    // Pasar los parámetros a la API
    $_REQUEST = $params;

    // Incluir el archivo de la API
    include($backendPath);
} else {
    // Manejar el error si el archivo no existe
    http_response_code(404);
    echo json_encode(['error' => 'API not found']);
}
?>
