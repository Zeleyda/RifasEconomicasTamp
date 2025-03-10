<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIFAS ECONOMICAS TAMPICO</title>
    <link rel="stylesheet" href="../styles/verificador.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/background.css">
</head>
<body>
<div class="background-image"></div>
    <div class="overlay"></div>
    <div class="content">
    <?php include 'navbar.html'; ?>
    <h3>Verificar Boleto</h3>

    <div class="container">
        <h1 class="main-title">Verificar Boleto</h1>      
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Introduce un número...">
            <button id="reserve-button">Buscar</button>
        </div>
        <div id="message"></div>
    </div>

    <!-- Modal para mostrar información de la orden -->
    <div id="order-info-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Información de la Orden</h2>
            <div id="order-info"></div>
        </div>
    </div>

    <?php include 'footer.html'; ?>
    <script src="../js/verificador.js"></script>
</body>
</html>
