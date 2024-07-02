<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/boletos.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/navbar.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/footer.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/formulario.css">
    <link rel="stylesheet" href="/RifasEconomicasTamp/styles/background.css">
    <title>RIFAS ECONOMICAS TAMPICO</title>
    <style>
        .gif-button-container {
            border: none; /* Eliminar borde */
            background: none; /* Sin fondo */
            cursor: pointer; /* Mostrar cursor de mano */
            color: inherit; /* Mantener color de texto */
            text-align: center;
            margin: 20px 0;
        }
        .gif-button {
            border: none; /* Eliminar borde */
            background: none; /* Sin fondo */
            cursor: pointer; /* Mostrar cursor de mano */
            color: inherit; /* Mantener color de texto */
            padding: 10px;
            border-radius: 10px;
        }
        .gif-button img {
            border: none; /* Eliminar borde */
            background: none; /* Sin fondo */
            color: inherit; /* Mantener color de texto */
            width: 100%;
            max-width: 300px; /* Ajustar el tamaño máximo para la vista de escritorio */
            height: auto;
        }
        @media (max-width: 600px) {
            .gif-button img {
               
                max-width: 200px; /* Ajustar el tamaño máximo para la vista móvil */
            }
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000; /* Asegurar que esté por encima de todos los componentes */
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0,0,0,0.4);
            padding-top: 0;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #fefefe;
            width: 80%;
            max-width: 600px;
            height: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        .modal-content.scrollable {
            height: 80%; /* Ajustar según sea necesario */
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .numeros-generados {
    background-color: green;
    color: white;
    padding: 10px;
    margin-top: 20px;
    text-align: center;
    word-wrap: break-word; /* Permitir que el texto se ajuste y salte de línea */
    white-space: pre-wrap; /* Mantener saltos de línea y ajustar texto */
    max-width: 100%; /* Asegurar que el ancho máximo no exceda el contenedor */
}


        #agregarLista {
            display: block;
            margin: 20px auto 0; /* Centrando el botón y separándolo de la sección de números generados */
            border: none; /* Eliminar borde */
            background: none; /* Sin fondo */
            cursor: pointer; /* Mostrar cursor de mano */
            color: inherit; /* Mantener color de texto */
        }

        @media (max-width: 600px) {
            .modal-content {
                width: 90%; /* Ancho más grande en dispositivos móviles */
                height: auto;
                padding: 10px;
            }
        }

        /* Ajustes para navbar y bottomsheet */
        .navbar {
            z-index: 500;
        }
        
        #selected-numbers-bottomsheet {
            z-index: 500;
        }

        /* Ajustes responsivos adicionales */
        @media (max-width: 600px) {
            .main-content h1 {
                font-size: 1.5em;
            }
            .search-bar {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .search-bar input {
                width: 100%;
                box-sizing: border-box;
                text-align: center;
            }
            .search-bar button {
                width: 100%;
                margin-top: 10px;
            }
            .gif-button-container {
                margin: 10px 0;
            }
            .modal-content {
                padding: 10px;
                max-width: 90%;
            }
            .modal-content h2 {
                font-size: 1.2em;
            }
            .modal-content label,
            .modal-content select,
            .modal-content input,
            .modal-content button {
                width: 100%;
                box-sizing: border-box;
                margin: 5px 0;
            }
            .bottomsheet-header {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .bottomsheet-header h2 {
                margin-bottom: 10px;
            }
            .bottomsheet-header button {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Bloquear el scroll cuando se abre un modal */
        body.modal-open {
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="background-image"></div>
    <div class="overlay"></div>
    <div class="content">
<?php include 'navbar.html'; ?>
<h3></h3>

    <div class="main-content">
        <div class="container">
            <h1>Buscador de Boletos</h1>
            <div class="search-bar">
                <input type="text" id="searchTxt" placeholder="Buscar un boleto">
                <button>Buscar</button>
            </div>
            <div class="gif-button-container">
                <button class="gif-button" id="openFormButton">
                    <img src="/RifasEconomicasTamp/images/mapache.gif" alt="GIF Button">
                </button>
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
            <button class="close-bottomsheet">&times;</button>
        </div>    
        <div id="selected-numbers"></div>
    </div>

    <!-- Modal para seleccionar boletos -->
    <div id="boletosModal" class="modal">
        <div class="modal-content" id="boletosModalContent">
        <span class="close">&times;</span>
            <h2>Selecciona la cantidad de boletos y genera tus números de la suerte</h2>
            <label for="cantidadBoletos">Cantidad de boletos:</label>
            <select id="cantidadBoletos">
                <option value="1">1 Boleto</option>
                <option value="2">2 Boletos</option>
                <option value="3">3 Boletos</option>
                <option value="4">4 Boletos</option>
                <option value="5">5 Boletos</option>
                <option value="6">6 Boletos</option>
                <option value="7">7 Boletos</option>
                <option value="8">8 Boletos</option>
                <option value="9">9 Boletos</option>
                <option value="10">10 Boletos</option>
                <option value="50">50 Boletos</option>
                <option value="100">100 Boletos</option>
            </select>
            <p>Haz clic en la imagen para generar tus números de la suerte:</p>
            <div class="gif-button-container">
                <button class="gif-button" id="generarNumerosButton">
                    <img id="generarNumerosGif" src="/RifasEconomicasTamp/images/rul_2.png" alt="Generar Números">
                </button>
            </div>
            <div id="numerosGenerados" class="numeros-generados" style="display:none;">
                <!-- Los números generados se mostrarán aquí -->
            </div>
            <button id="agregarLista" style="display:none;">Agregar a la lista</button>
        </div>
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
<script>
    // Abrir y cerrar modal
    document.getElementById('openFormButton').onclick = function() {
        document.getElementById('boletosModal').style.display = 'block';
        document.body.classList.add('modal-open');
    }

    document.querySelectorAll('.close').forEach(function(element) {
        element.onclick = function() {
            document.getElementById('boletosModal').style.display = 'none';
            document.getElementById('apartar-modal').style.display = 'none';
            document.body.classList.remove('modal-open');
            document.getElementById('boletosModalContent').classList.remove('scrollable');
        }
    });

    window.onclick = function(event) {
        if (event.target == document.getElementById('boletosModal')) {
            document.getElementById('boletosModal').style.display = 'none';
            document.body.classList.remove('modal-open');
            document.getElementById('boletosModalContent').classList.remove('scrollable');
        }
        if (event.target == document.getElementById('apartar-modal')) {
            document.getElementById('apartar-modal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    }

    // Generar números de la suerte al hacer clic en el GIF
    /*document.getElementById('generarNumerosButton').onclick = function() {
        var gif = document.getElementById('generarNumerosGif');
        
        gif.src = '/RifasEconomicasTamp/images/rul_1.gif'; // Cambiar al GIF animado

        var cantidad = document.getElementById('cantidadBoletos').value;
        var numerosGenerados = '';
        for (var i = 0; i < cantidad; i++) {
            numerosGenerados += Math.floor(Math.random() * 50000) + 1;
            if (i < cantidad - 1) {
                numerosGenerados += ' - ';
            }
        }

        // Duración de la animación del GIF en milisegundos
        var gifDuration = 3000; // Ajustar según la duración real del GIF

        if (cantidad == 100) {
            document.getElementById('boletosModalContent').classList.add('scrollable');
        } else {
            document.getElementById('boletosModalContent').classList.remove('scrollable');
        }

        setTimeout(function() {
            gif.src = '/RifasEconomicasTamp/images/rul_2.png'; // Volver a la imagen estática
            document.getElementById('numerosGenerados').innerHTML = '<p>Números Generados: ' + numerosGenerados + '</p>';
            document.getElementById('numerosGenerados').style.display = 'block';
            document.getElementById('agregarLista').style.display = 'block';
        }, gifDuration);
    }*/

    // Agregar a la lista
    document.getElementById('agregarLista').onclick = function() {
        var numeros = document.getElementById('numerosGenerados').innerText;
        if (numeros) {
            var lista = document.getElementById('selected-numbers');
            var newItem = document.createElement('div');
            newItem.innerText = numeros;
            lista.appendChild(newItem);
            document.getElementById('boletosModal').style.display = 'none';
            document.body.classList.remove('modal-open');
            document.getElementById('boletosModalContent').classList.remove('scrollable');
        } else {
            alert('Primero debe generar los números.');
        }
    }


    // Mostrar el bottomsheet
    document.getElementById('apartar-button').onclick = function() {
        document.getElementById('apartar-modal').style.display = 'block';
        document.body.classList.add('modal-open');
    }

    // Cerrar el bottomsheet
    document.querySelector('.close-bottomsheet').onclick = function() {
        document.getElementById('selected-numbers-bottomsheet').classList.remove('show');
    }

    // Cerrar modal de datos
    document.querySelector('#apartar-modal .close').onclick = function() {
        document.getElementById('apartar-modal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }
</script>
</body>
</html>
