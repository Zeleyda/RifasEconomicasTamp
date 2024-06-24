<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

// Obtener los parámetros de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$rifaId = isset($data['rifaId']) ? (int)$data['rifaId'] : 0;
$orderId = isset($data['orderId']) ? (int)$data['orderId'] : 0;
$newStatus = isset($data['newStatus']) ? (int)$data['newStatus'] : 0;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Actualizar el estado de la orden

$query = "";
if($newStatus == 2)
{
    $query = "UPDATE orders SET Status = ?, PaidDate = NOW() WHERE OrderId = ? AND RifaId = ?";
}
else
{
    $query = "UPDATE orders SET Status = ?, PaidDate = null WHERE OrderId = ? AND RifaId = ?";
}

$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $newStatus, $orderId, $rifaId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $response = ['success' => true, 'message' => 'Orden actualizada correctamente'];
} else {
    $response = ['success' => false, 'message' => 'No se pudo actualizar la orden'];
}

// Cerrar conexión
$stmt->close();
$conn->close();

// Devolver respuesta en formato JSON
echo json_encode($response);
?>
