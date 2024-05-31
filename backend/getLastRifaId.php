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

// Obtener el último ID de rifa
$query = "SELECT MAX(RifaId) as LastRifaId FROM rifas";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastRifaId = $row['LastRifaId'];
    echo json_encode(['success' => true, 'rifaId' => $lastRifaId]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo obtener el último ID de rifa.']);
}

$conn->close();
?>
