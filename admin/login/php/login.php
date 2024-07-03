<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: panel.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Panel: Iniciar Sesión</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <style>
        .login-header img {
            user-drag: none; /* Deshabilitar arrastrado en navegadores webkit */
            pointer-events: none; /* Deshabilitar eventos del mouse en la imagen */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="../icons/logotipoempresa.png" alt="Envelope Icon">
        </div>
        <form class="login-form" action="../../../backend/login.php" method="post">
            <div class="input-container">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('dragstart', function (event) {
                event.preventDefault();
            });
        });
    </script>
</body>
</html>
