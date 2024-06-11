document.addEventListener('DOMContentLoaded', () => {
    const buttonContainer = document.getElementById('button-container');
    const selectedNumbersBottomsheet = document.getElementById('selected-numbers-bottomsheet');
    const selectedNumbersDiv = document.getElementById('selected-numbers');
    const closeBtn = document.createElement('button');
    closeBtn.classList.add('close-btn');
    closeBtn.innerHTML = '&times;';
    closeBtn.addEventListener('click', () => {
        selectedNumbersBottomsheet.classList.remove('show');
    });

    const toggleSizeBtn = document.createElement('button');
    toggleSizeBtn.classList.add('toggle-size-btn');
    toggleSizeBtn.innerHTML = '&#8645;'; // Icono para cambiar el tamaño
    toggleSizeBtn.addEventListener('click', () => {
        if (selectedNumbersBottomsheet.style.maxHeight === '50vh') {
            selectedNumbersBottomsheet.style.maxHeight = '90vh';
            selectedNumbersDiv.style.maxHeight = 'calc(90vh - 140px)';
        } else {
            selectedNumbersBottomsheet.style.maxHeight = '50vh';
            selectedNumbersDiv.style.maxHeight = 'calc(50vh - 140px)';
        }
    });

    selectedNumbersBottomsheet.insertBefore(closeBtn, selectedNumbersBottomsheet.firstChild);
    selectedNumbersBottomsheet.insertBefore(toggleSizeBtn, selectedNumbersBottomsheet.firstChild);

    for (let i = 1; i <= 5000; i++) {
        const button = document.createElement('button');
        button.textContent = `00${i}`;
        button.classList.add('available');
        button.addEventListener('click', () => {
            button.classList.toggle('ticket-container');
            updateSelectedNumbers();
        });
        buttonContainer.appendChild(button);
    }

    function updateSelectedNumbers() {
        const selectedButtons = document.querySelectorAll('.ticket-container');
        selectedNumbersDiv.innerHTML = '';
        selectedButtons.forEach(button => {
            const clone = button.cloneNode(true);
            clone.classList.remove('ticket-container');
            clone.classList.add('available');
            selectedNumbersDiv.appendChild(clone);
        });
        if (selectedButtons.length > 0) {
            selectedNumbersBottomsheet.classList.add('show');
        } else {
            selectedNumbersBottomsheet.classList.remove('show');
        }
    }

    // Lógica para el formulario
    const apartButton = document.getElementById('apart-button');
    const formularioBottomsheet = document.getElementById('formulario-bottomsheet');
    const formCloseBtn = formularioBottomsheet.querySelector('.close-btn');

    apartButton.addEventListener('click', () => {
        formularioBottomsheet.classList.add('show');
    });

    formCloseBtn.addEventListener('click', () => {
        formularioBottomsheet.classList.remove('show');
    });
});
