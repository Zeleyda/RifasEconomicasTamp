<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/boletos.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/navbar.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/footer.css">
    <title>RIFAS ECONOMICAS TAMPICO</title>
</head>
<body>
<?php include 'navbar.html'; ?>

<div class="container">
    <h1 class="main-title">Comprar Boletos</h1>
    <div id="search-container">
        <input type="text" id="search-input" placeholder="Buscar un número entre el 0 y el 50000">
        <button id="reserve-button">Apartar número</button>
    </div>

    <div id="buttons-container">
        <!-- Aquí deberías generar los botones dinámicamente con JavaScript o con un bucle en PHP -->
        <button class="button">1</button>
        <button class="button">2</button>
        <button class="button">3</button>
        <!-- Agrega más botones según sea necesario -->
    </div>
</div>

<div id="selected-numbers-footer">
    <button id="close-footer">X</button>
    <h3>Números seleccionados:</h3>
    <ul id="selected-numbers-list"></ul>
    <button id="apart-boletos-button">Apartar Boletos</button>
</div>

<div class="form-container" id="reservation-form">
    <button id="close-form">X</button>
    <h3>LLENA TUS DATOS Y DA CLICK EN APARTAR</h3>
    <form>
        <label for="name">Nombre Completo</label>
        <input type="text" id="name" placeholder="Nombre y Apellidos">
        <label for="states-toggle">Cargar Estados de USA</label>
        <input type="checkbox" id="states-toggle">
        <label for="state">Estado</label>
        <select id="state">
            <option value="">Seleccionar...</option>
        </select>
        <label for="phone">Número de Celular (WhatsApp)</label>
        <input type="text" id="phone" placeholder="10 dígitos sin espacios">
        <p>¡Al finalizar serás redirigido a WhatsApp para enviar la información de tu boleto!</p>
        <p>Tu boleto sólo dura 24 horas apartado</p>
        <button type="submit">Apartar Boleto</button>
    </form>
</div>

<script src="/RifasEconomicasTamp/js/boletos.js"></script>

<?php include 'footer.html'; ?>
</body>
</html>
