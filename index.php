<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIFAS ECONOMICAS TAMPICO</title>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/carousel.css">
    <link rel="stylesheet" href="styles/info.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/background.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background-image"></div>
    <div class="overlay"></div>
    <div class="content">
    <?php include 'sections/navbar.html'; ?>

        <div class="main-container" id="mainContainer">
            <div class="carousel-container" id="carouselContainer">
                <div class="carousel">

                    <div class="slide">
                       <img src="images/camioneta1.jpg" alt="Slide 1">
                    <button class="buy-button">COMPRAR BOLETO</button>
                    </div>

                    <div class="slide">
                        <img src="images/camioneta2.jpg" alt="Slide 2">
                        <button class="buy-button">COMPRAR BOLETO</button>
                    </div>

                    <div class="slide">
                        <img src="images/camioneta3.jpg" alt="Slide 3" >
                        <button class="buy-button">COMPRAR BOLETO</button>

                        
                    </div>
                    
                </div>
                <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next" onclick="moveSlide(1)">&#10095;</button>
            </div>

            <h2 class="info-title" id="info1-title">¿QUIENES SOMOS?</h2>
            <div class="info-container" id="info5-container">
                <div class="info-box" id="info00">
                    <h3>RIFAS ECONOMICAS TAMPICO</h3>
                    <p>¡Bienvenidos! a <em>Rifas ECONOMICAS TAMPICO</em>, realizamos sorteos en base a la Lotería Nacional, en nuestros sorteos participan amigos de todo México, estamos ubicados en Tampico Tamaulipas.</p>
                    <img src="images/logotipoempresa.png" alt="Logo Rifa entre amigos" class="info-image">
                </div>
            </div>

            <h2 class="info-title" id="info2-title">PREGUNTAS FRECUENTES</h2>
            <div class="info-container" id="info2-container">
                <div class="info-box" id="info2">
                    <!-- Acordeón de preguntas frecuentes -->
                    <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-button">¿CÓMO SE ELIGEN A LOS GANADORES?</button>
                            <div class="accordion-content">
                                <p>Los ganadores se eligen a través de un sorteo basado en los números de la Lotería Nacional.</p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button">¿QUÉ SUCEDE CUANDO EL NÚMERO GANADOR ES UN BOLETO NO VENDIDO?</button>
                            <div class="accordion-content">
                                <p>Si el número ganador corresponde a un boleto no vendido, se vuelve a realizar el sorteo hasta que haya un ganador válido.</p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button">¿DÓNDE SE PUBLICA A LOS GANADORES?</button>
                            <div class="accordion-content">
                                <p>Los ganadores se publican en nuestro sitio web y en nuestras redes sociales oficiales.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="info-title" id="info3-title">SE VA 1 VEHÍCULO 1 GANADOR</h2>
            <div class="info-container" id="info2-container">
                <div class="info-box" id="info2">
                    <!-- Contenido nuevo según la imagen proporcionada -->
                    <img src="images/camioneta1.jpg" alt="Vehicle Image" class="vehicle-image"> <!-- Imagen del vehículo -->
                    <h3>Primer Lugar</h3>
                    <h2>NISSAN PATFINDER PREMIER 2015</h2>
                    <h3>Segundo Lugar</h3>
                    <h2>CADILLAC SRX 2</h2>
                    <h3>Tercer Lugar</h3>
                    <h2>PREMIO SORPRESA</h2>
                    <div class="pricing-info">
                        <p>1 boleto por $30 (5 Oportunidades)</p>
                        <p>2 boletos por $60 (10 Oportunidades)</p>
                        <p>3 boletos por $90 (15 Oportunidades)</p>
                        <p>5 boletos por $150 (25 Oportunidades)</p>
                        <p>10 boletos por $300 (50 Oportunidades)</p>
                    </div>
                    <button class="buy-button">COMPRAR BOLETO</button>
                </div>
            </div>

            <h2 class="info-title" id="info4-title">MÉTODOS DE PAGO</h2>
            <div class="info-container" id="info1-container">
                <div class="info-box payment-box" id="info1">
                    <div class="payment-method">
                        <h3>Depósito OXXO o Transferencia</h3>
                        <img src="images/bbva.png" alt="BBVA Logo" class="bbva-logo">
                        <p><strong>Tarjeta:</strong> 4152 3136 7897 7070</p>
                        <p><strong>Beneficiario:</strong> ERICK EDUARDO CASTRO MARCELINO</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'sections/footer.html'; ?>
    </div>

    <script src="js/navbar.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/info.js"></script>
    <script src="js/accordion.js"></script>
</body>
</html>
