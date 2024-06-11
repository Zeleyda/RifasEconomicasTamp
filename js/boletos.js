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
    selectedNumbersBottomsheet.insertBefore(closeBtn, selectedNumbersBottomsheet.firstChild);

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
            selectedNumbersDiv.appendChild(clone);
        });
        if (selectedButtons.length > 0) {
            selectedNumbersBottomsheet.classList.add('show');
        } else {
            selectedNumbersBottomsheet.classList.remove('show');
        }
    }
});
