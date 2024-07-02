<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

// Obtener la RifaId de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$rifaId = isset($data['rifaId']) ? (int)$data['rifaId'] : 0;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Consultar órdenes pagadas (status 2) para la RifaId específica
$queryPaid = "SELECT OrderId, RifaId, OrderDate, PersonName, PersonPhone, Estado FROM orders WHERE Status = 2 AND RifaId = ?";
$stmtPaid = $conn->prepare($queryPaid);
$stmtPaid->bind_param("i", $rifaId);
$stmtPaid->execute();
$resultPaid = $stmtPaid->get_result();
$paidOrders = $resultPaid->fetch_all(MYSQLI_ASSOC);
$stmtPaid->close();

// Consultar órdenes pendientes (status 1) para la RifaId específica
$queryPending = "SELECT OrderId, RifaId, OrderDate, PersonName, PersonPhone, Estado FROM orders WHERE Status = 1 AND RifaId = ? AND OrderDate >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
$stmtPending = $conn->prepare($queryPending);
$stmtPending->bind_param("i", $rifaId);
$stmtPending->execute();
$resultPending = $stmtPending->get_result();
$pendingOrders = $resultPending->fetch_all(MYSQLI_ASSOC);
$stmtPending->close();

// Consultar órdenes eliminadas (status 1 y fecha de orden mayor a 2 días) para la RifaId específica
$queryDeleted = "SELECT OrderId, RifaId, OrderDate, PersonName, PersonPhone, Estado FROM orders WHERE Status = 1 AND RifaId = ? AND OrderDate < DATE_SUB(NOW(), INTERVAL 1 DAY)";
$stmtDeleted = $conn->prepare($queryDeleted);
$stmtDeleted->bind_param("i", $rifaId);
$stmtDeleted->execute();
$resultDeleted = $stmtDeleted->get_result();
$deletedOrders = $resultDeleted->fetch_all(MYSQLI_ASSOC);
$stmtDeleted->close();

// Construir respuesta
$response = [
    'success' => true,
    'paid_orders' => $paidOrders,
    'pending_orders' => $pendingOrders,
    'deleted_orders' => $deletedOrders
];

// Cerrar conexión
$conn->close();

// Devolver respuesta en formato JSON
echo json_encode($response);
?>
