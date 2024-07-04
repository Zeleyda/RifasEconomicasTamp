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
</head>
<body>
    <div class="container">


       <div class="header-container">
            <img src="../icons/mapachedebug1.png" alt="Icono 1">
            <h1>Panel de Administración</h1>
            <img src="../icons/mapachedebug.png" alt="Icono">
        </div>

        <a class="actualizar-link">Actualizar</a>
        <a href="logout.php" class="logout-link">Salir</a>
        <div class="form-group">
            <label for="rifaId">Rifa ID:</label>
            <input type="text" id="rifaId">
            <button id="obtenerOrdenesBtn">Obtener Órdenes</button>
           
            <label for="orderId">Orden ID:</label>
            <input type="text" id="rifaId">
            <button id="buscarOrdenesBtn">Buscar Órdenes</button>
        </div>

  

        <div id="ordenes">
            <h2>Órdenes Pagadas</h2>
            <ul id="paidOrdersList"></ul>
            <h2>Órdenes Pendientes</h2>
            <ul id="pendingOrdersList"></ul>
            <h2>Órdenes Vencidas</h2>
            <ul id="expiredOrdersList"></ul>
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
                const paidOrdersList = document.getElementById('paidOrdersList');
                const pendingOrdersList = document.getElementById('pendingOrdersList');
                const expiredOrdersList = document.getElementById('expiredOrdersList');

                paidOrdersList.innerHTML = '';
                pendingOrdersList.innerHTML = '';
                expiredOrdersList.innerHTML = '';

                if (data.paid_orders.length > 0) {
                    data.paid_orders.forEach(order => {
                        const li = document.createElement('li');
                        li.className = 'order-box';

                        const orderIdDiv = document.createElement('div');
                        orderIdDiv.innerHTML = `<b>ID:</b> ${order.OrderId}`;
                        li.appendChild(orderIdDiv);

                        const personNameDiv = document.createElement('div');
                        personNameDiv.innerHTML = `<b>Nombre:</b> ${order.PersonName}`;
                        li.appendChild(personNameDiv);

                        const personPhoneDiv = document.createElement('div');
                        personPhoneDiv.innerHTML = `<b>Teléfono:</b> ${order.PersonPhone}`;
                        li.appendChild(personPhoneDiv);

                        const statusDiv = document.createElement('div');
                        statusDiv.innerHTML = '<b>Estado:</b> Pagada';
                        statusDiv.style.backgroundColor = 'lime';
                        statusDiv.style.padding = '2px 4px';
                        statusDiv.style.display = 'inline-block';
                        li.appendChild(statusDiv);

                        const buttonContainer = document.createElement('div');
                        buttonContainer.className = 'button-container';
                        li.appendChild(buttonContainer);

                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Marcar como pendiente';
                        validateButton.className = 'validate-button';
                        validateButton.addEventListener('click', function () {
                            changeOrderStatus(order.OrderId, rifaId, 1);
                        });
                        buttonContainer.appendChild(validateButton);

                        const infoButton = document.createElement('button');
                        infoButton.textContent = 'Generar Información';
                        infoButton.className = 'info-button validate-button';
                        infoButton.addEventListener('click', function () {
                            generateOrderInfo(order.OrderId);
                        });
                        buttonContainer.appendChild(infoButton);

                        paidOrdersList.appendChild(li);
                    });
                }

                if (data.pending_orders.length > 0) {
                    data.pending_orders.forEach(order => {
                        const li = document.createElement('li');
                        li.className = 'order-box';

                        const orderIdDiv = document.createElement('div');
                        orderIdDiv.innerHTML = `<b>ID:</b> ${order.OrderId}`;
                        li.appendChild(orderIdDiv);

                        const personNameDiv = document.createElement('div');
                        personNameDiv.innerHTML = `<b>Nombre:</b> ${order.PersonName}`;
                        li.appendChild(personNameDiv);

                        const personPhoneDiv = document.createElement('div');
                        personPhoneDiv.innerHTML = `<b>Teléfono:</b> ${order.PersonPhone}`;
                        li.appendChild(personPhoneDiv);

                        const statusDiv = document.createElement('div');
                        statusDiv.innerHTML = '<b>Estado:</b> Pendiente';
                        statusDiv.style.backgroundColor = 'yellow';
                        statusDiv.style.padding = '2px 4px';
                        statusDiv.style.display = 'inline-block';
                        li.appendChild(statusDiv);

                        const buttonContainer = document.createElement('div');
                        buttonContainer.className = 'button-container';
                        li.appendChild(buttonContainer);

                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Marcar como pagada';
                        validateButton.className = 'validate-button';
                        validateButton.addEventListener('click', function () {
                            changeOrderStatus(order.OrderId, rifaId, 2);
                        });
                        buttonContainer.appendChild(validateButton);

                        const infoButton = document.createElement('button');
                        infoButton.textContent = 'Generar Información';
                        infoButton.className = 'info-button validate-button';
                        infoButton.addEventListener('click', function () {
                            generateOrderInfo(order.OrderId);
                        });
                        buttonContainer.appendChild(infoButton);

                        pendingOrdersList.appendChild(li);
                    });
                }

                if (data.deleted_orders.length > 0) {
                    data.deleted_orders.forEach(order => {
                        const li = document.createElement('li');
                        li.className = 'order-box';

                        const orderIdDiv = document.createElement('div');
                        orderIdDiv.innerHTML = `<b>ID:</b> ${order.OrderId}`;
                        li.appendChild(orderIdDiv);

                        const personNameDiv = document.createElement('div');
                        personNameDiv.innerHTML = `<b>Nombre:</b> ${order.PersonName}`;
                        li.appendChild(personNameDiv);

                        const personPhoneDiv = document.createElement('div');
                        personPhoneDiv.innerHTML = `<b>Teléfono:</b> ${order.PersonPhone}`;
                        li.appendChild(personPhoneDiv);

                        const statusDiv = document.createElement('div');
                        statusDiv.innerHTML = '<b>Estado:</b> Vencida';
                        statusDiv.style.backgroundColor = 'red';
                        statusDiv.style.padding = '2px 4px';
                        statusDiv.style.display = 'inline-block';
                        li.appendChild(statusDiv);

                        const buttonContainer = document.createElement('div');
                        buttonContainer.className = 'button-container';
                        li.appendChild(buttonContainer);

                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Marcar como pagada';
                        validateButton.className = 'validate-button';
                        validateButton.addEventListener('click', function () {
                            changeOrderStatus(order.OrderId, rifaId, 2);
                        });
                        buttonContainer.appendChild(validateButton);

                        const infoButton = document.createElement('button');
                        infoButton.textContent = 'Generar Información';
                        infoButton.className = 'info-button validate-button';
                        infoButton.addEventListener('click', function () {
                            generateOrderInfo(order.OrderId);
                        });
                        buttonContainer.appendChild(infoButton);

                        expiredOrdersList.appendChild(li);
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
                    const message = `Nombre: ${data.order.PersonName}\nTeléfono: +52${data.order.PersonPhone.replaceAll(/\s/g,'')}\nFecha de Apartado: ${data.order.OrderDate}\nFecha de Pago: ${data.order.PaidDate}\nRifa: ${data.order.RifaName}\nDescripción: ${data.order.RifaDescription}\nTermina: ${data.order.EndDate}\nNúmero(s): ${numbers}`;
                    
                    // Redirigir a WhatsApp con el mensaje
                    const whatsappUrl = `https://wa.me/52${data.order.PersonPhone.replace(/\s/g, '')}?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                } else {
                    alert('Error al generar la información de la orden.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
