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
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    exit();
}

// Consulta para obtener todos los números ocupados o pendientes de una rifa
$query = "
    SELECT n.Number, o.Status, o.PersonName, o.PersonPhone
    FROM numbers n
    JOIN orders o ON n.OrderId = o.OrderId
    WHERE o.RifaId = ?
    AND (o.Status = 2 OR (o.Status = 1 AND o.OrderDate >= DATE_SUB(NOW(), INTERVAL 2 DAY)))
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $rifaId);
$stmt->execute();
$result = $stmt->get_result();

$numbers = [];
while ($row = $result->fetch_assoc()) {
    $numbers[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'numbers' => $numbers]);
?>
