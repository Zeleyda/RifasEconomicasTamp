<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/boletos.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/navbar.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/footer.css">
    <title>Comprar Boletos</title>
  
</head>
<body>
<?php include 'navbar.html'; ?>

    <div>
        <h1>Comprar Boletos</h1>
        <div>
            <input type="text" placeholder="Buscar un número entre el 0 y el 50000">
            <button>Apartar número</button>
        </div>

        <div></div>
    </div>



    <div>
        <button>X</button>
        <h3>Números seleccionados:</h3>
        <ul></ul>
        <button>Apartar Boletos</button>
    </div>



    <div>
        <button>X</button>
        <h3>LLENA TUS DATOS Y DA CLICK EN APARTAR</h3>
        <form>
            <label for="name">Nombre Completo</label>
            <input type="text" placeholder="Nombre y Apellidos">
            <label for="states-toggle">Cargar Estados de USA</label>
            <input type="checkbox">
            <label for="state">Estado</label>
            <select id="state">
                <option value="">Seleccionar...</option>
            </select>
            <label for="phone">Número de Celular (WhatsApp)</label>
            <input type="text" placeholder="10 dígitos sin espacios">
            <p>¡Al finalizar serás redirigido a WhatsApp para enviar la información de tu boleto!</p>
            <p>Tu boleto sólo dura 24 horas apartado</p>
            <button type="submit">Apartar Boleto</button>
        </form>
    </div>


    
    <script src="scripts/boletos.js"></script>

    <?php include 'footer.html'; ?>
</body>
</html>
