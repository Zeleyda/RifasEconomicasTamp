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
        <h1>Panel de Administración</h1>
        <a href="logout.php" class="logout-link">Logout</a>
        <label for="rifaId">Rifa ID:</label>
        <input type="text" id="rifaId">
        <button id="obtenerOrdenesBtn">Obtener Órdenes</button>
        <div id="ordenes"></div>
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
                        const ordenesDiv = document.getElementById('ordenes');
                        ordenesDiv.innerHTML = '';
                        if (data.paid_orders.length > 0) {
                            const paidOrdersHeader = document.createElement('h2');
                            paidOrdersHeader.textContent = 'Órdenes Pagadas';
                            ordenesDiv.appendChild(paidOrdersHeader);
                            const paidOrdersUl = document.createElement('ul');
                            data.paid_orders.forEach(order => {
                                const li = document.createElement('li');
                                li.className = 'order-box';
                                li.textContent = `ID: ${order.OrderId}, Nombre: ${order.PersonName}, Teléfono: ${order.PersonPhone}, Estado: Pagada`;
                                const validateButton = document.createElement('button');
                                validateButton.textContent = 'Marcar como pendiente';
                                validateButton.className = 'validate-button';
                                validateButton.addEventListener('click', function () {
                                    changeOrderStatus(order.OrderId, rifaId, 1);
                                });
                                const infoButton = document.createElement('button');
                                infoButton.textContent = 'Generar Información';
                                infoButton.className = 'validate-button';
                                infoButton.addEventListener('click', function () {
                                    generateOrderInfo(order.OrderId);
                                });
                                li.appendChild(validateButton);
                                li.appendChild(infoButton);
                                paidOrdersUl.appendChild(li);
                            });
                            ordenesDiv.appendChild(paidOrdersUl);
                        }
                        if (data.pending_orders.length > 0) {
                            const pendingOrdersHeader = document.createElement('h2');
                            pendingOrdersHeader.textContent = 'Órdenes Pendientes';
                            ordenesDiv.appendChild(pendingOrdersHeader);
                            const pendingOrdersUl = document.createElement('ul');
                            data.pending_orders.forEach(order => {
                                const li = document.createElement('li');
                                li.className = 'order-box';
                                li.textContent = `ID: ${order.OrderId}, Nombre: ${order.PersonName}, Teléfono: ${order.PersonPhone}, Estado: Pendiente`;
                                const validateButton = document.createElement('button');
                                validateButton.textContent = 'Validar Pago';
                                validateButton.className = 'validate-button';
                                validateButton.addEventListener('click', function () {
                                    changeOrderStatus(order.OrderId, rifaId, 2);
                                });
                                li.appendChild(validateButton);
                                pendingOrdersUl.appendChild(li);
                            });
                            ordenesDiv.appendChild(pendingOrdersUl);
                        }
                        if (data.deleted_orders.length > 0) {
                            const deletedOrdersHeader = document.createElement('h2');
                            deletedOrdersHeader.textContent = 'Órdenes Vencidas';
                            ordenesDiv.appendChild(deletedOrdersHeader);
                            const deletedOrdersUl = document.createElement('ul');
                            data.deleted_orders.forEach(order => {
                                const li = document.createElement('li');
                                li.className = 'order-box';
                                li.textContent = `ID: ${order.OrderId}, Nombre: ${order.PersonName}, Teléfono: ${order.PersonPhone}, Estado: Vencida`;
                                const validateButton = document.createElement('button');
                                validateButton.textContent = 'Validar Pago';
                                validateButton.className = 'validate-button';
                                validateButton.addEventListener('click', function () {
                                    changeOrderStatus(order.OrderId, rifaId, 2);
                                });
                                li.appendChild(validateButton);
                                deletedOrdersUl.appendChild(li);
                            });
                            ordenesDiv.appendChild(deletedOrdersUl);
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
                            //alert('Estado de la orden actualizado.');
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
                            console.log(whatsappURL);
                            //window.location.href = whatsappURL;
                            window.open(whatsappURL, "_blank");
                        } else {
                            alert('Error al obtener la información de la orden.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>
    </div>
</body>
</html>

