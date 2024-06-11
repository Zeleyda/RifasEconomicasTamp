<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/boletos.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/navbar.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/footer.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/formulario.css"> <!-- Nueva hoja de estilos -->
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
        <div class="bottomsheet-header">
            <h2>Boletos Seleccionados</h2>
            <button id="apartar-button">Apartar boletos</button>
        </div>    
        <div id="selected-numbers"></div>
        <!--<button id="apart-button">Apartar boletos</button>!-->
    </div>

    <div id="formulario-bottomsheet">
        <button class="close-btn">&times;</button>
        <h2>LLENA TUS DATOS Y DA CLICK EN APARTAR</h2>
        <form>
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre y Apellidos" required>

            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="">Seleccionar...</option>
                <!-- Añade las opciones aquí -->
            </select>

            <label for="celular">Número de Celular (WhatsApp)</label>
            <input type="text" id="celular" name="celular" placeholder="10 dígitos sin espacios" required>

            <p>¡Al finalizar serás redirigido a whatsapp para enviar la información de tu boleto!</p>
            <p>Tu boleto sólo dura 24 horas apartado</p>

            <button type="submit">Apartar Boleto</button>
        </form>
    </div>

    <!-- Modal para pedir datos -->
    <div id="apartar-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>LLENA TUS DATOS Y DA CLICK EN APARTAR</h2>
            <form id="apartar-form">
                <label for="personName">Nombre Completo:</label>
                <input type="text" id="personName" name="personName" placeholder="Nombre y Apellidos" required>
                
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="" disabled selected>Selecciona...</option>
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Ciudad de México">Ciudad de México</option>
                    <option value="Coahuila">Coahuila</option>
                    <option value="Colima">Colima</option>
                    <option value="Durango">Durango</option>
                    <option value="Estado de México">Estado de México</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco">Jalisco</option>
                    <option value="Michoacán">Michoacán</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo León">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Querétaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosí">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>
                </select>
                
                <label for="personPhone">Número de Celular (WhatsApp):</label>
                <input type="text" id="personPhone" name="personPhone" placeholder="10 dígitos sin espacios" required>
                
                <p>¡Al finalizar serás redirigido a whatsapp para enviar la información de tu boleto!</p>
                <p>Tu boleto sólo durará 24 horas apartado.</p>
                
                <button type="submit">Apartar Boleto</button>
            </form>
        </div>
    </div>
    
<?php include 'footer.html'; ?>
<script src="/RifasEconomicasTamp/js/boletos.js"></script>
<script src="/RifasEconomicasTamp/js/formulario.js"></script> <!-- Nuevo script -->
</body>
</html>
