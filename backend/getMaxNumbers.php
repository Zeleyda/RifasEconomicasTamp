<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Obtener datos de la solicitud GET
$rifaId = isset($_GET['rifaId']) ? (int)$_GET['rifaId'] : 0;

if ($rifaId <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID de rifa inválido.']);
    exit();
}

// Obtener el máximo de números permitidos para la rifa actual
$query = "SELECT MaxNumbers FROM rifas WHERE RifaId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $rifaId);
$stmt->execute();
$stmt->bind_result($maxNumbers);
$stmt->fetch();
$stmt->close();

if (isset($maxNumbers)) {
    echo json_encode(['success' => true, 'maxNumbers' => $maxNumbers]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo obtener el máximo de números.']);
}

$conn->close();
?>
