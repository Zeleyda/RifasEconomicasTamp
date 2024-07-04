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
        .password-container {
            position: relative;
        }
        .password-container .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .loading-bar {
            display: none;
            margin-top: 10px;
        }
        .loading-bar .bar {
            height: 4px;
            background-color: #4c4c4c;
            width: 0%;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="../icons/logotipoempresa.png" alt="Logo Empresa">
        </div>
        <form class="login-form" action="../../../backend/login.php" method="post" onsubmit="showLoading()">
            <div class="input-container">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-container password-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility()">
                    <img src="../icons/eye.svg" alt="Eye Icon">
                </span>
            </div>
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
            <div class="loading-bar" id="loadingBar">
                <div class="bar"></div>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.innerHTML = '<img src="../icons/eye-fill.svg" alt="Eye Slash Icon">';
            } else {
                passwordField.type = 'password';
                passwordToggle.innerHTML = '<img src="../icons/eye-slash-fill.svg" alt="Eye Icon">';
            }
        }

        function showLoading() {
            document.querySelector('.loading-bar').style.display = 'block';
            setTimeout(function() {
                document.querySelector('.bar').style.width = '100%';
            }, 100);
        }
    </script>
</body>
</html>
