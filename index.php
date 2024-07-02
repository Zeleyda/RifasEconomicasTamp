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
    <link rel="stylesheet" href="styles/accordion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Estilos para el botón flotante */
        /* Estilos para el botón flotante */
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .whatsapp-button img {
            width: 40px;
            height: 40px;
        }
        .whatsapp-button:hover {
            background-color: #20c65a;
        }
    </style>
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
                       <a href="/RifasEconomicasTamp/sections/comprar_boletos.php" class="buy-button"><span>COMPRAR BOLETO</span></a>
                    </div>
                    <div class="slide">
                        <img src="images/camioneta2.jpg" alt="Slide 2">
                        <a href="/RifasEconomicasTamp/sections/comprar_boletos.php" class="buy-button"><span>COMPRAR BOLETO</span></a>
                    </div>
                    <div class="slide">
                        <img src="images/camioneta3.jpg" alt="Slide 3">
                        <a href="/RifasEconomicasTamp/sections/comprar_boletos.php" class="buy-button"><span>COMPRAR BOLETO</span></a>
                    </div>
                </div>
                <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next" onclick="moveSlide(1)">&#10095;</button>
            </div>

            <h2 class="info-title" id="info1-title">¿QUIENES SOMOS?</h2>
            <div class="info-container" id="info5-container">
                <div class="info-box" id="info00">
                    <h3>RIFAS ECONOMICAS TAMPICO</h3>
                    <p>¡Bienvenidos! a <strong>RIFAS ECONOMICAS TAMPICO</strong>, realizamos sorteos en base a la Lotería Nacional, en nuestros sorteos participan amigos de todo México, estamos ubicados en Tampico Tamaulipas.</p>
                    <img src="images/logotipoempresa.png" alt="Logo Rifa entre amigos" class="info-image">
                </div>
            </div>

            <h2 class="info-title" id="info2-title">PREGUNTAS FRECUENTES</h2>
            <div class="info-container" id="info2-container">
                <div class="info-box" id="info2">
                    <!-- Acordeón de preguntas frecuentes -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" onclick="toggleAccordion(0)">
                                    ¿CÓMO SE ELIGEN A LOS GANADORES?
                                </button>
                            </h2>
                            <div class="accordion-content" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Los ganadores se eligen a través de un sorteo basado en los números de la Lotería Nacional.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" onclick="toggleAccordion(1)">
                                    ¿QUÉ SUCEDE CUANDO EL NÚMERO GANADOR ES UN BOLETO NO VENDIDO?
                                </button>
                            </h2>
                            <div class="accordion-content" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Si el número ganador corresponde a un boleto no vendido, se vuelve a realizar el sorteo hasta que haya un ganador válido.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" onclick="toggleAccordion(2)">
                                    ¿DÓNDE SE PUBLICA A LOS GANADORES?
                                </button>
                            </h2>
                            <div class="accordion-content" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Los ganadores se publican en nuestro sitio web y en nuestras redes sociales oficiales.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" onclick="toggleAccordion(3)">
                                    ¿CUANTO TIEMPO TENGO PARA PAGAR BOLETOS APARTADOS?
                                </button>
                            </h2>
                            <div class="accordion-content" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Se cuenta un lapso de 24 horas para el pago de los boletos, si no se pagan dentro del lapso, los boletos son cancelados.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="info-title" id="info3-title">SE VA 1 VEHÍCULO 1 GANADOR</h2>
            <div class="info-container" id="info2-container">
                <div class="info-box" id="info2">
                    <img src="images/camioneta1.jpg" alt="Vehicle Image" class="vehicle-image">
                    <h1>BOLETO GANADOR</h1>
                    <h2>MODELO DEL CARRO</h2>
                    <div class="pricing-info">
                        <h2>1 BOLETO POR $7</h2>
                        <h2>2 BOLETOS POR $14</h2>
                        <h2>10 BOLETOS POR $70</h2>
                        <h2>20 BOLETOS POR $140</h2>
                        <h2>40 BOLETOS POR $280</h2>
                    </div>
                    
                    <a href="/RifasEconomicasTamp/sections/comprar_boletos.php" class="buy-button">COMPRAR BOLETO</a>
                </div>

                <h2 class="info-title" id="info4-title">MÉTODOS DE PAGO</h2>
                <div class="info-container" id="info1-container">
                    <div class="info-box payment-box" id="info1">
                        <div class="payment-method">
                            <h3>Depósito OXXO o Transferencia</h3>
                            <img src="images/bbva.png" alt="BBVA Logo" class="bbva-logo">
                            <p><strong>Tarjeta:</strong> 4152 3136 7897 7070</p>
                            <p><strong>Beneficiario:</strong></p>
                            <p>ERICK EDUARDO CASTRO MARCELINO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'sections/footer.html'; ?>
    </div>

    <!-- Botón flotante de WhatsApp -->
    <button class="whatsapp-button" onclick="window.location.href='https://wa.me/528333399875'">
        <img src="/RifasEconomicasTamp/images/whats3.png" alt="WhatsApp">
    </button>

    <script src="/RifasEconomicasTamp/js/navbar.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/info.js"></script>
    <script src="js/accordion.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
