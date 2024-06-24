<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded credentials for demonstration purposes
    $valid_username = 'admin';
    $valid_password = 'password123';

    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: welcome.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="../icons/logotipoempresa.png" alt="Envelope Icon">
        </div>
        <form class="login-form" action="login.php" method="post">
            <div class="input-container">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>

