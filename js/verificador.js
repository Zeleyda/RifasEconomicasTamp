document.addEventListener('DOMContentLoaded', () => {
    const searchButton = document.getElementById('reserve-button');
    const searchInput = document.getElementById('search-input');
    const messageDiv = document.getElementById('message');
    const orderInfoModal = document.getElementById('order-info-modal');
    const orderInfoDiv = document.getElementById('order-info');
    const closeModalButton = document.querySelector('.close-button');
    let rifaId = null;
    let maxNumbers = 50000; // Valor por defecto

    // Obtener el último ID de rifa
    fetch('/api.php?api=getLastRifaId')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                rifaId = data.rifaId;
                fetchMaxNumbers(); // Obtener el número máximo de números después de obtener el rifaId
            } else {
                console.error('Error al obtener el ID de la última rifa:', data.message);
            }
        })
        .catch(error => console.error('Error al obtener el ID de la última rifa:', error));

    // Obtener el número máximo de números
    function fetchMaxNumbers() {
        fetch(`/api.php?api=getMaxNumbers&rifaId=${rifaId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    maxNumbers = data.maxNumbers;
                    updatePlaceholder(); // Actualizar el placeholder del campo de búsqueda
                } else {
                    console.error('Error al obtener el máximo de números:', data.message);
                }
            })
            .catch(error => console.error('Error al obtener el máximo de números:', error));
    }

    // Actualizar el placeholder del campo de búsqueda con el número máximo de números
    function updatePlaceholder() {
        searchInput.placeholder = `Introduce un número del 0 al ${maxNumbers}...`;
    }

    searchButton.addEventListener('click', () => {
        const numero = parseInt(searchInput.value, 10);

        if (isNaN(numero) || numero < 1 || numero > maxNumbers) {
            messageDiv.textContent = `Por favor, ingrese un número válido entre 1 y ${maxNumbers}.`;
            messageDiv.style.color = 'red';
            return;
        }

        if (rifaId === null) {
            messageDiv.textContent = 'Error al obtener el ID de la rifa. Inténtelo de nuevo más tarde.';
            messageDiv.style.color = 'red';
            return;
        }

        return fetch('/api.php?api=checkNumber', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ numero, rifaId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                messageDiv.textContent = 'El número está disponible.';
                messageDiv.style.color = 'green';
            } else {
                if (data.order) {
                    messageDiv.textContent = '';
                    messageDiv.textContent = data.message || 'El número ya está ocupado.';
                    messageDiv.style.color = 'red';
                    showOrderInfo(data.order);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageDiv.textContent = 'Ocurrió un error al verificar el número.';
            messageDiv.style.color = 'red';
        });
    });

    // Mostrar información de la orden en un modal
    function showOrderInfo(order) {
        const { OrderDate, Status, PersonName, Estado } = order;
        const orderInfo = `
            <p><strong>Fecha de Orden:</strong> ${OrderDate}</p>
            <p><strong>Estado:</strong> ${Status}</p>
            <p><strong>Nombre:</strong> ${PersonName}</p>
            <p><strong>Estado:</strong> ${Estado}</p>
        `;
        orderInfoDiv.innerHTML = orderInfo;
        orderInfoModal.style.display = 'block';
    }

    closeModalButton.addEventListener('click', () => {
        orderInfoModal.style.display = 'none';
    });

    window.addEventListener('click', event => {
        if (event.target === orderInfoModal) {
            orderInfoModal.style.display = 'none';
        }
    });
});
