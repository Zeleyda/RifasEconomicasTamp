document.addEventListener('DOMContentLoaded', () => {
    const buttonContainer = document.getElementById('button-container');
    const selectedNumbersBottomsheet = document.getElementById('selected-numbers-bottomsheet');
    const selectedNumbersDiv = document.getElementById('selected-numbers');
    const searchInput = document.querySelector('.search-bar input[type="text"]');
    const searchButton = document.querySelector('.search-bar button');
    const apartarButton = document.getElementById('apartar-button');
    const modal = document.getElementById('apartar-modal');
    const closeModal = document.querySelector('.modal .close');
    const form = document.getElementById('apartar-form');
    const generateNumbersButton = document.getElementById('generarNumerosButton');
    const agregarListaButton = document.getElementById('agregarLista');

    var generatedRandomNumbers = [];
    let occupiedNumbers = [];
    let maxNumbers = 50000; // Valor por defecto
    let rifaId = -1; // Asume que tienes un rifaId fijo o puedes obtenerlo dinámicamente

    // Fetching the last rifa ID from the API
    fetch(`../backend/getLastRifaId.php`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                rifaId = data.rifaId;
                fetchMaxNumbers();
            } else {
                console.error('Error al obtener el ID de la última rifa:', data.message);
            }
        })
        .catch(error => console.error('Error al obtener el ID de la última rifa:', error));

    // Fetching max numbers from the API
    function fetchMaxNumbers() {
        fetch(`../backend/getMaxNumbers.php?rifaId=${rifaId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    maxNumbers = data.maxNumbers;
                    fetchOccupiedNumbers();
                } else {
                    console.error('Error al obtener el máximo de números:', data.message);
                }
            })
            .catch(error => console.error('Error al obtener el máximo de números:', error));
    }

    // Fetching occupied numbers from the API
    function fetchOccupiedNumbers() {
        fetch(`../backend/getOccupiedNumbers.php?rifaId=${rifaId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    occupiedNumbers = data.numbers.map(number => number.Number);
                    renderNumbers(1, maxNumbers); // Render initial set of numbers
                }
            })
            .catch(error => console.error('Error al cargar los números ocupados:', error));
    }

    // Function to render numbers
    function renderNumbers(startIndex, endIndex) {
        const fragment = document.createDocumentFragment();
        for (let i = startIndex; i <= endIndex && i <= maxNumbers; i++) {
            const button = document.createElement('button');
            const buttonText = `0000${i}`.slice(-4);
            button.textContent = buttonText;

            if (occupiedNumbers.includes(i)) {
                button.classList.add('occupied');
                button.disabled = true;
            } else {
                button.classList.add('available');
                button.addEventListener('click', () => {
                    button.classList.toggle('ticket-container');
                    updateSelectedNumbers();
                });
            }

            fragment.appendChild(button);
        }
        buttonContainer.appendChild(fragment);
    }

    // Function to update selected numbers
    function updateSelectedNumbers() {
        const selectedButtons = document.querySelectorAll('.ticket-container');
        selectedNumbersDiv.innerHTML = '';
        selectedButtons.forEach(button => {
            const newButton = document.createElement('button');
            newButton.textContent = button.textContent;
            newButton.classList.add('selected-ticket');
            newButton.addEventListener('click', () => {
                const originalButton = Array.from(buttonContainer.children).find(b => b.textContent === button.textContent);
                if (originalButton) {
                    originalButton.classList.remove('ticket-container');
                }
                updateSelectedNumbers();
            });
            selectedNumbersDiv.appendChild(newButton);
        });

        if (selectedButtons.length > 0) {
            selectedNumbersBottomsheet.classList.add('show');
        } else {
            selectedNumbersBottomsheet.classList.remove('show');
        }
    }

    function addRandomToList(){
        for(let i=0; i<generatedRandomNumbers.length; i++){
            const buttonText = `0000${generatedRandomNumbers[i]}`.slice(-4);
            const button = Array.from(buttonContainer.children).find(b => b.textContent === buttonText);
            button.classList.add('ticket-container');
        }
        updateSelectedNumbers();
        document.getElementById('numerosGenerados').style.display = 'none';
        document.getElementById('agregarLista').style.display = 'none';
        document.getElementById('boletosModal').style.display = 'none';
    }

    function randomNumbers(){
        generatedRandomNumbers = [];
        var gif = document.getElementById('generarNumerosGif');
        gif.src = '/RifasEconomicasTamp/images/rul_1.gif'; // Cambiar al GIF animado
        var cantidad = document.getElementById('cantidadBoletos').value;
        

        // Duración de la animación del GIF en milisegundos
        var gifDuration = 3000; // Ajustar según la duración real del GIF

        if (cantidad == 100) {
            document.getElementById('boletosModalContent').classList.add('scrollable');
        } else {
            document.getElementById('boletosModalContent').classList.remove('scrollable');
        }

        setTimeout(function() {
            gif.src = '/RifasEconomicasTamp/images/rul_2.png'; // Volver a la imagen estática
        var cantidad = document.getElementById('cantidadBoletos').value;
        for(let i=0; i<cantidad; i++){
            var searchValue = Math.floor(Math.random() * maxNumbers) + 1;
            
            const buttonText = `0000${searchValue}`.slice(-4);
            const button = Array.from(buttonContainer.children).find(b => b.textContent === buttonText);

            if (!button) {
                alert("Número no encontrado.");
                return;
            }

            if (occupiedNumbers.includes(searchValue)) {
                cantidad++;
                
            } else {
                //button.classList.add('ticket-container');
                generatedRandomNumbers.push(searchValue);
                //updateSelectedNumbers();
            }
        }
        document.getElementById('numerosGenerados').style.display = 'block';
        document.getElementById('numerosGenerados').innerHTML = '<p>Números Generados: ' + generatedRandomNumbers + '</p>';
        document.getElementById('agregarLista').style.display = 'block';


    }, gifDuration);

    }

    // Function to handle search
    function handleSearch() {
        const searchValue = parseInt(searchInput.value, 10);
        if (isNaN(searchValue) || searchValue < 1 || searchValue > maxNumbers) {
            alert(`Por favor, ingrese un número válido entre 1 y ${maxNumbers}.`);
            return;
        }

        const buttonText = `0000${searchValue}`.slice(-4);
        const button = Array.from(buttonContainer.children).find(b => b.textContent === buttonText);

        if (!button) {
            alert("Número no encontrado.");
            return;
        }

        if (occupiedNumbers.includes(searchValue)) {
            alert("Este número está ocupado.");
        } else {
            button.classList.add('ticket-container');
            updateSelectedNumbers();
        }
    }

    // Function to handle form submission
    function handleFormSubmit(event) {
        event.preventDefault();
        const personName = document.getElementById('personName').value;
        const personPhone = document.getElementById('personPhone').value;
        const estado = document.getElementById('estado').value; // Obtener el valor del estado seleccionado
        const selectedButtons = Array.from(document.querySelectorAll('.ticket-container'));
        const numeros = selectedButtons.map(button => parseInt(button.textContent, 10));

        
        fetch('../backend/saveOrder.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                personName,
                personPhone,
                estado,
                numeros,
                rifaId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Boletos apartados con éxito.');
                selectedButtons.forEach(button => {
                    button.classList.remove('ticket-container');
                    button.classList.add('occupied');
                    button.disabled = true;
                });
                updateSelectedNumbers();
                modal.style.display = 'none';
            } else {
                alert('Error al apartar boletos: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    generateNumbersButton.addEventListener('click', randomNumbers);
    agregarListaButton.addEventListener('click', addRandomToList)

    searchButton.addEventListener('click', handleSearch);
    apartarButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    form.addEventListener('submit', handleFormSubmit);

    window.addEventListener('click', event => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
