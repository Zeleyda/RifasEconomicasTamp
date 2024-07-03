<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Panel: Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="icons/logotipoempresa.png" alt="Envelope Icon">
        </div>
        <form class="login-form" action="php/login.php" method="post">
            <div class="input-container">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
