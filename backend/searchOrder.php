<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si se ha proporcionado 'query'
if (isset($data['query'])) {
    $query = $data['query'];
    $query = "%" . $query . "%";

    $sql = "SELECT * FROM orders WHERE PersonName LIKE ? OR PersonPhone LIKE ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $query, $query);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        echo json_encode(['orders' => $orders]);

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Error en la preparación de la consulta']);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó la consulta']);
}

$conn->close();
?>
