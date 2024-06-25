<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifasdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'] ?? null;
    $inputPassword = $_POST['password'] ?? null;

    // Check if input is null
    if ($inputUsername === null || $inputPassword === null) {
        header('Location: ../index.php?error=Missing username or password');
        exit;
    }

    // Query to check username and password
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $inputUsername, $inputPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $inputUsername;
        $_SESSION['loggedin'] = true;
        header('Location: ../admin/login/php/welcome.php');
    } else {
        header('Location: ../admin/login/php/login.php');
    }

    $stmt->close();
}

$conn->close();
?>
