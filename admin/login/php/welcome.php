<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>You have successfully logged in.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
