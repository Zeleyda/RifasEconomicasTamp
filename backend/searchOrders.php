<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $searchValue = $input['searchValue'];

    $searchValue = $conn->real_escape_string($searchValue);

    $sql = "SELECT * FROM orders WHERE OrderId LIKE '%$searchValue%' OR PersonPhone LIKE '%$searchValue%'";
    $result = $conn->query($sql);

    $orders = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    $paid_orders = array_filter($orders, function ($order) {
        return $order['Status'] == 2;
    });

    $pending_orders = array_filter($orders, function ($order) {
        return $order['Status'] == 1;
    });

    $expired_orders = array_filter($orders, function ($order) {
        return $order['Status'] == 0;
    });

    $response = [
        'paid_orders' => $paid_orders,
        'pending_orders' => $pending_orders,
        'expired_orders' => $expired_orders
    ];

    echo json_encode($response);
}

$conn->close();
?>
