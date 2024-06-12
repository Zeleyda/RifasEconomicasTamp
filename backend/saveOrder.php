<?php
header('Content-Type: application/json');

try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rifasdb";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception('Conexión fallida: ' . $conn->connect_error);
    }

    // Obtener datos de la solicitud POST
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        throw new Exception('Datos inválidos...');
    }

    $personName = isset($data['personName']) ? $conn->real_escape_string($data['personName']) : '';
    $personPhone = isset($data['personPhone']) ? $conn->real_escape_string($data['personPhone']) : '';
    $estado = isset($data['estado']) ? $conn->real_escape_string($data['estado']) : '';
    $numeros = isset($data['numeros']) ? $data['numeros'] : [];
    $rifaId = isset($data['rifaId']) ? (int)$data['rifaId'] : 0;

    if (!is_array($numeros) || empty($personName) || empty($personPhone) || empty($estado) || $rifaId <= 0) {
        throw new Exception("Datos invalidos.");
    }

    // Obtener el máximo de números permitidos para la rifa actual
    $query = "SELECT MaxNumbers FROM rifas WHERE RifaId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $rifaId);
    $stmt->execute();
    $stmt->bind_result($maxNumbers);
    $stmt->fetch();
    $stmt->close();

    if (!isset($maxNumbers)) {
        throw new Exception('No se pudo obtener el máximo de números.');
    }

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        foreach ($numeros as $numero) {
            $numero = (int)$numero;
            if ($numero <= 0 || $numero > $maxNumbers) {
                throw new Exception('Número fuera de rango.');
            }

            $query = "
                SELECT orders.OrderId
                FROM numbers
                JOIN orders ON numbers.OrderId = orders.OrderId
                WHERE numbers.Number = ? AND orders.RifaId = ?
                AND ((orders.Status = 1 AND orders.OrderDate >= DATE_SUB(NOW(), INTERVAL 2 DAY))
                OR orders.Status = 2)
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $numero, $rifaId);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->close();
                throw new Exception('El número ya está reservado en una orden pendiente de pago o es reciente.');
            }
            $stmt->close();
        }

        // Insertar la orden
        $stmt = $conn->prepare("INSERT INTO orders (RifaId, OrderDate, Status, PersonName, PersonPhone, Estado) VALUES (?, NOW(), 1, ?, ?, ?)");
        $stmt->bind_param("isss", $rifaId, $personName, $personPhone, $estado);
        $stmt->execute();
        $orderId = $stmt->insert_id;
        $stmt->close();

        // Insertar los números
        $stmt = $conn->prepare("INSERT INTO numbers (OrderId, Number) VALUES (?, ?)");
        foreach ($numeros as $numero) {
            $stmt->bind_param("ii", $orderId, $numero);
            $stmt->execute();
        }
        $stmt->close();

        // Confirmar la transacción
        $conn->commit();

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        throw $e;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit();
}

$conn->close();
?>
