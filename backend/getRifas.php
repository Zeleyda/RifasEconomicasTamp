<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

$query = "SELECT RifaId, RifaName FROM rifas";
$result = $conn->query($query);

$rifas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rifas[] = $row;
    }
}

$response = [
    'success' => true,
    'rifas' => $rifas
];

$conn->close();

echo json_encode($response);
?>
