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
    die(json_encode(['available' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Obtener datos de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$numero = isset($data['numero']) ? (int)$data['numero'] : 0;
$rifaId = isset($data['rifaId']) ? (int)$data['rifaId'] : 0;

if ($numero <= 0 || $rifaId <= 0) {
    echo json_encode(['available' => false, 'message' => 'Datos inválidos.']);
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

if (!isset($maxNumbers) || $numero > $maxNumbers) {
    echo json_encode(['available' => false, 'message' => 'Número fuera de rango.']);
    exit();
}

// Verificar si el número ya está en una orden pendiente de pago o reciente
$query = "
    SELECT orders.OrderDate, orders.Status, orders.PersonName, orders.Estado
    FROM numbers
    JOIN orders ON numbers.OrderId = orders.OrderId
    WHERE numbers.Number = ? AND orders.RifaId = ?
    AND ((orders.Status = 1 AND orders.OrderDate >= DATE_SUB(NOW(), INTERVAL 2 DAY))
    OR orders.Status = 2)
";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $numero, $rifaId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    $order['Status'] = $order['Status'] == 1 ? 'Pendiente de Pago' : 'Pagado';
    echo json_encode(['available' => false, 'order' => $order]);
} else {
    echo json_encode(['available' => true]);
}

$stmt->close();
$conn->close();
?>
