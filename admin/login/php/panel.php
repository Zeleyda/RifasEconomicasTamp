<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard App</title>
    <link rel="stylesheet" href="../styles/panel.css">
    <style>
        .order-box {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .order-box div {
            margin: 5px 0;
        }
        .order-box div span.label {
            font-weight: bold;
        }
        .status-paid {
            background-color: #00FF00; /* Verde fosforescente */
            padding: 2px 5px;
            display: inline-block;
            font-weight: bold;
        }
        .status-pending {
            background-color: #FFFF00; /* Amarillo fosforescente */
            padding: 2px 5px;
            display: inline-block;
            font-weight: bold;
        }
        .status-expired {
            background-color: #FF0000; /* Rojo fosforescente */
            padding: 2px 5px;
            display: inline-block;
            font-weight: bold;
        }
        .info-button {
            margin-left: 20px; /* Separar más los botones */
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .form-group label {
            font-weight: bold;
            margin-right: 10px;
        }
        .form-group input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 150px; /* Hacer más pequeña la entrada de texto */
            margin-right: 10px; /* Espacio entre la entrada de texto y el botón */
        }
        #obtenerOrdenesBtn {
            background-color: #006d4c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 0; /* Alinear con la entrada de texto */
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header-container img {
            width: 100px;
            height: 100px;
            margin: 0 10px;
        }
        .header-container h1 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <img src="../icons/mapachedebug1.png" alt="Icono Mapache 1">
            <h1>Panel de Administración</h1>
            <img src="../icons/mapachedebug.png" alt="Icono Mapache 2">
        </div>
        <a href="logout.php" class="logout-link">Salir</a>
        <div class="form-group">
            <label for="rifaId">Rifa ID:</label>
            <input type="text" id="rifaId">
            <button id="obtenerOrdenesBtn">Obtener Órdenes</button>
        </div>
        <div id="ordenes">
            <h2>Órdenes Pagadas</h2>
            <ul id="paidOrdersUl"></ul>
            <h2>Órdenes Pendientes</h2>
            <ul id="pendingOrdersUl"></ul>
            <h2>Órdenes Vencidas</h2>
            <ul id="expiredOrdersUl"></ul>
        </div>
    </div>

    <script>
        document.getElementById('obtenerOrdenesBtn').addEventListener('click', function () {
            const rifaId = document.getElementById('rifaId').value;
            fetch('../../../backend/getOrders.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ rifaId: rifaId })
            })
            .then(response => response.json())
            .then(data => {
                const paidOrdersUl = document.getElementById('paidOrdersUl');
                const pendingOrdersUl = document.getElementById('pendingOrdersUl');
                const expiredOrdersUl = document.getElementById('expiredOrdersUl');
                
                paidOrdersUl.innerHTML = '';
                pendingOrdersUl.innerHTML = '';
                expiredOrdersUl.innerHTML = '';

                // Órdenes Pagadas
                if (data.paid_orders.length > 0) {
                    data.paid_orders.forEach(order => {
                        const li = document.createElement('li');
                        li.className = 'order-box';

                        const orderIdDiv = document.createElement('div');
                        orderIdDiv.innerHTML = `<span class="label">ID:</span> ${order.OrderId}`;
                        li.appendChild(orderIdDiv);

                        const personNameDiv = document.createElement('div');
                        personNameDiv.innerHTML = `<span class="label">Nombre:</span> ${order.PersonName}`;
                        li.appendChild(personNameDiv);

                        const personPhoneDiv = document.createElement('div');
                        personPhoneDiv.innerHTML = `<span class="label">Teléfono:</span> ${order.PersonPhone}`;
                        li.appendChild(personPhoneDiv);

                        const statusDiv = document.createElement('div');
                        statusDiv.innerHTML = `<span class="status-paid"><span class="label">Estado:</span> Pagada</span>`;
                        li.appendChild(statusDiv);

                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Marcar como pendiente';
                        validateButton.className = 'validate-button';
                        validateButton.addEventListener('click', function () {
                            changeOrderStatus(order.OrderId, rifaId, 1);
                        });
                        li.appendChild(validateButton);

                        const infoButton = document.createElement('button');
                        infoButton.textContent = 'Generar Información';
                        infoButton.className = 'validate-button info-button';
                        infoButton.addEventListener('click', function () {
                            generateOrderInfo(order.OrderId);
                        });
                        li.appendChild(infoButton);

                        paidOrdersUl.appendChild(li);
                    });
                }

                // Órdenes Pendientes
                if (data.pending_orders.length > 0) {
                    data.pending_orders.forEach(order => {
                        const li = document.createElement('li');
                        li.className = 'order-box';

                        const orderIdDiv = document.createElement('div');
                        orderIdDiv.innerHTML = `<span class="label">ID:</span> ${order.OrderId}`;
                        li.appendChild(orderIdDiv);

                        const personNameDiv = document.createElement('div');
                        personNameDiv.innerHTML = `<span class="label">Nombre:</span> ${order.PersonName}`;
                        li.appendChild(personNameDiv);

                        const personPhoneDiv = document.createElement('div');
                        personPhoneDiv.innerHTML = `<span class="label">Teléfono:</span> ${order.PersonPhone}`;
                        li.appendChild(personPhoneDiv);

                        const statusDiv = document.createElement('div');
                        statusDiv.innerHTML = `<span class="status-pending"><span class="label">Estado:</span> Pendiente</span>`;
                        li.appendChild(statusDiv);

                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Marcar como pagada';
                        validateButton.className = 'validate-button';
                        validateButton.addEventListener('click', function () {
                            changeOrderStatus(order.OrderId, rifaId, 2);
                        });
                        li.appendChild(validateButton);

                        const infoButton = document.createElement('button');
                        infoButton.textContent = 'Generar Información';
                        infoButton.className = 'validate-button info-button';
                        infoButton.addEventListener('click', function () {
                            generateOrderInfo(order.OrderId);
                        });
                        li.appendChild(infoButton);

                        pendingOrdersUl.appendChild(li);
                    });
                }

                // Órdenes Vencidas
                if (data.expired_orders.length > 0) {
                    data.expired_orders.forEach(order => {
                        const li = document.createElement('li');
                        li.className = 'order-box';

                        const orderIdDiv = document.createElement('div');
                        orderIdDiv.innerHTML = `<span class="label">ID:</span> ${order.OrderId}`;
                        li.appendChild(orderIdDiv);

                        const personNameDiv = document.createElement('div');
                        personNameDiv.innerHTML = `<span class="label">Nombre:</span> ${order.PersonName}`;
                        li.appendChild(personNameDiv);

                        const personPhoneDiv = document.createElement('div');
                        personPhoneDiv.innerHTML = `<span class="label">Teléfono:</span> ${order.PersonPhone}`;
                        li.appendChild(personPhoneDiv);

                        const statusDiv = document.createElement('div');
                        statusDiv.innerHTML = `<span class="status-expired"><span class="label">Estado:</span> Vencida</span>`;
                        li.appendChild(statusDiv);

                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Marcar como pendiente';
                        validateButton.className = 'validate-button';
                        validateButton.addEventListener('click', function () {
                            changeOrderStatus(order.OrderId, rifaId, 1);
                        });
                        li.appendChild(validateButton);

                        const infoButton = document.createElement('button');
                        infoButton.textContent = 'Generar Información';
                        infoButton.className = 'validate-button info-button';
                        infoButton.addEventListener('click', function () {
                            generateOrderInfo(order.OrderId);
                        });
                        li.appendChild(infoButton);

                        expiredOrdersUl.appendChild(li);
                    });
                }
            })
            .catch(error => console.log('Error: ', error));
        });

        function changeOrderStatus(orderId, rifaId, status) {
            fetch('../../../backend/changeOrderStatus.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ orderId: orderId, newStatus: status, rifaId: rifaId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('obtenerOrdenesBtn').click();
                } else {
                    alert('Error al actualizar el estado de la orden.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function generateOrderInfo(orderId) {
            fetch('../../../backend/getOrderDetails.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ orderId: orderId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const numbers = data.numbers.map(num => num.Number).join(', ');
                    const message = `Nombre: ${data.order.PersonName}\nTeléfono: +52${data.order.PersonPhone.replaceAll(/\s/g,'')}\nFecha de Apartado: ${data.order.OrderDate}\nFecha de Pago: ${data.order.PaidDate}\nRifa: ${data.order.RifaName}\nDescripción: ${data.order.RifaDescription}\nFecha de Fin: ${data.order.EndDate}\nNúmeros: ${numbers} \nLink: http://localhost/rifaseconomicastamp/sections/informacion?paramId_rf=${data.order.OrderId}`;
                    const whatsappURL = `https://wa.me/+52${data.order.PersonPhone.replaceAll(/\s/g,'')}?text=${encodeURIComponent(message)}`;
                    window.open(whatsappURL, "_blank");
                } else {
                    alert('Error al obtener la información de la orden.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
