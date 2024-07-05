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

        <h2>Seleccionar Rifa</h2>
        <form>
            <label for="rifa_select">Elige una rifa:</label>
            <select id="rifa_select" name="rifa">
                <option>Seleccione una opcion</option>
            </select>
        </form>
        <a href="logout.php" class="logout-link">Salir</a>
        <div class="form-group">
            <button id="obtenerOrdenesBtn">Actualizar</button>
            <label for="txtSearch">Buscar:</label>
            <input type="text" id="txtSearch" placeholder="Por nombre o telefono">
        </div>

        <div id="searchResults" style="display: none;">
            <h2>Resultados de la Búsqueda</h2>
            <ul id="searchResultsList"></ul>
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
        function getRifas() {
            fetch('../../../backend/getRifas.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const select = document.getElementById('rifa_select');
                        data.rifas.forEach(rifa => {
                            const option = document.createElement('option');
                            option.value = rifa.RifaId;
                            option.textContent = rifa.RifaName;
                            select.appendChild(option);
                        });
                        const comboBox = document.getElementById('rifa_select');
                        comboBox.selectedIndex = comboBox.options.length - 1;
                        getOrders();
                    } else {
                        alert('No se pudieron cargar las rifas');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function getOrders() {
            const comboBox = document.getElementById('rifa_select');
            const selectedIndex = comboBox.options[comboBox.selectedIndex].value;

            const rifaId = selectedIndex;
            fetch('../../../backend/getOrders.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ rifaId: rifaId })
            })
            .then(response => response.json())
            .then(data => {
                displayOrders(data);
            })
            .catch(error => console.log('Error: ', error));
        }

        function displayOrders(data) {
            const paidOrdersList = document.getElementById('paidOrdersList');
            const pendingOrdersList = document.getElementById('pendingOrdersList');
            const expiredOrdersList = document.getElementById('expiredOrdersList');

            paidOrdersList.innerHTML = '';
            pendingOrdersList.innerHTML = '';
            expiredOrdersList.innerHTML = '';

            data.paid_orders.forEach(order => createOrderElement(order, paidOrdersList, 'Pagada', 'lime', 1));
            data.pending_orders.forEach(order => createOrderElement(order, pendingOrdersList, 'Pendiente', 'yellow', 2));
            data.deleted_orders.forEach(order => createOrderElement(order, expiredOrdersList, 'Vencida', 'red', 2));
        }

        function createOrderElement(order, listElement, status, color, newStatus) {
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
            statusDiv.innerHTML = `<b>Estado: ${status}</b>`;
            statusDiv.style.backgroundColor = color;
            statusDiv.style.padding = '2px 4px';
            statusDiv.style.display = 'inline-block';
            li.appendChild(statusDiv);

            const buttonContainer = document.createElement('div');
            buttonContainer.className = 'button-container';
            li.appendChild(buttonContainer);

            const validateButton = document.createElement('button');
            validateButton.textContent = `Marcar como ${status === 'Pagada' ? 'pendiente' : 'pagada'}`;
            validateButton.className = 'validate-button';
            validateButton.addEventListener('click', function () {
                changeOrderStatus(order.OrderId, order.RifaId, newStatus);
            });
            buttonContainer.appendChild(validateButton);

            if (status === 'Pagada') {
                const infoButton = document.createElement('button');
                infoButton.textContent = 'Generar Información';
                infoButton.className = 'info-button validate-button';
                infoButton.addEventListener('click', function () {
                    generateOrderInfo(order.OrderId);
                });
                buttonContainer.appendChild(infoButton);
            }

            listElement.appendChild(li);
        }

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
                    const message = `_Hola! Hemos recibido el pago de tu orden en *RIFAS ECONOMICAS TAMPICO*, muchas gracias y muchisima suerte!!_ \n *Nombre:* ${data.order.PersonName}\n*Teléfono:* ${data.order.PersonPhone.replaceAll(/\s/g,'')}\nFecha de Apartado: ${data.order.OrderDate}\n*Fecha de Pago:* ${data.order.PaidDate}\n*Rifa: ${data.order.RifaName}*\nDescripción: ${data.order.RifaDescription}\nFecha de Fin: ${data.order.EndDate}\nNúmeros: *${numbers}* \nLink: http://localhost/rifaseconomicastamp/sections/informacion?paramId_rf=${data.order.OrderId}`;
                    
                    const whatsappUrl = `https://wa.me/${data.order.PersonPhone.replace(/\s/g, '')}?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                } else {
                    alert('Error al generar la información de la orden.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function filterOrders(query) {
            const lists = [
                document.getElementById('paidOrdersList'),
                document.getElementById('pendingOrdersList'),
                document.getElementById('expiredOrdersList')
            ];
            
            lists.forEach(list => {
                Array.from(list.children).forEach(item => {
                    const personName = item.querySelector('div:nth-child(2)').textContent.toLowerCase();
                    const personPhone = item.querySelector('div:nth-child(3)').textContent.toLowerCase().replace(/\s/g, '');
                    const searchText = query.toLowerCase();
                    if (personName.includes(searchText) || personPhone.includes(searchText)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        document.getElementById('obtenerOrdenesBtn').addEventListener('click', getOrders);
        document.getElementById('rifa_select').addEventListener('change', getOrders)
        document.getElementById('txtSearch').addEventListener('input', function () {
            filterOrders(this.value);
        });

        window.onload = getRifas;
    </script>
</body>
</html>
