<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Método no permitido']));
}

// Obtener el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si el cuerpo de la solicitud contiene orderId
if (!isset($data['orderId'])) {
    die(json_encode(['success' => false, 'message' => 'No se especificó orderId']));
}

$orderId = $data['orderId'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Consultar detalles de la orden y la rifa, incluyendo el precio del boleto
$query = "SELECT o.OrderId, o.PersonName, o.PersonPhone, o.OrderDate, o.PaidDate, r.RifaName, r.RifaDescription, r.EndDate, r.PricePerNum, o.UUID 
          FROM orders o 
          JOIN rifas r ON o.RifaId = r.RifaId 
          WHERE o.OrderId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$result = $stmt->get_result();
$orderDetails = $result->fetch_assoc();
$stmt->close();

if (!$orderDetails) {
    die(json_encode(['success' => false, 'message' => 'OrderId no encontrado: ' . $orderId]));
}

// Consultar números de la orden
$queryNumbers = "SELECT Number FROM numbers WHERE OrderId = ?";
$stmtNumbers = $conn->prepare($queryNumbers);
$stmtNumbers->bind_param("i", $orderId);
$stmtNumbers->execute();
$resultNumbers = $stmtNumbers->get_result();
$numbers = $resultNumbers->fetch_all(MYSQLI_ASSOC);
$stmtNumbers->close();

// Calcular total a pagar
$totalNumbers = count($numbers);
$pricePerNum = isset($orderDetails['PricePerNum']) ? $orderDetails['PricePerNum'] : 0;
$totalToPay = $totalNumbers * $pricePerNum;

// Construir respuesta
$response = [
    'success' => true,
    'order' => $orderDetails,
    'numbers' => $numbers,
    'totalToPay' => $totalToPay
];

// Cerrar conexión
$conn->close();

// Devolver respuesta en formato JSON
echo json_encode($response);
?>
