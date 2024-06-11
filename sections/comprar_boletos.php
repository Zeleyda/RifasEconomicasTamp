<!DOCTYPE html>
<html lang="en">
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
<h3></h3>

    <div class="main-content">
        <div class="container">
            <h1>Buscador de Boletos</h1>
            <div class="search-bar">
                <input type="text" placeholder="Buscar un boleto del 0 al 50000...">
                <button>Buscar</button>
            </div>
            <div class="button-container" id="button-container">
                <!-- Los botones se generarán aquí -->
            </div>
        </div>
    </div>

    <div id="selected-numbers-bottomsheet">
        <h2>Boletos Seleccionados</h2>
        <div id="selected-numbers"></div>
       
    </div>
    
<?php include 'footer.html'; ?>
<script src="/RifasEconomicasTamp/js/boletos.js"></script>
</body>
</html>
