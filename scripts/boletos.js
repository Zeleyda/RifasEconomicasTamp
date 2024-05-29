$(document).ready(function() {
    // Función para generar N botones de manera horizontal
    function generateButtons(N) {
        const container = $("#buttons-container");

        for (let i = 0; i < N; i++) {
            // Crear número del botón
            const number = String(i).padStart(5, '0'); // Asegurar que tenga 5 cifras
            const button = $("<button class='button'>" + number + "</button>");

            // Simular lectura de base de datos y marcar aleatoriamente
            const isMarked = Math.random() > 0.5; // 50% de probabilidad de estar marcado
            if (isMarked) {
                button.addClass('occupied');
            } else {
                button.addClass('available');
                // Añadir evento de clic para botones no marcados
                button.on('click', () => toggleSelection(number, button));
            }

            container.append(button);
        }
    }

    // Función para alternar la selección del botón
    function toggleSelection(number, button) {
        const list = $("#number-list");
        const existingItem = list.children().filter(function() {
            return $(this).text() === number;
        });

        if (button.hasClass('selected')) {
            // Deseleccionar
            button.removeClass('selected');
            existingItem.remove();
        } else {
            // Seleccionar
            button.addClass('selected');
            $("<li>" + number + "</li>").appendTo(list);
        }

        // Mostrar el bottom sheet si hay elementos seleccionados
        if (list.children().length > 0) {
            $("#selected-numbers-footer").addClass('show');
        } else {
            $("#selected-numbers-footer").removeClass('show');
        }
    }

    // Evento para el cuadro de texto (buscador de números)
    $("#search-input").on("input", function(event) {
        const searchTerm = $(this).val();
        // Aquí puedes agregar la lógica para buscar el término en los números disponibles
    });

    // Evento para el botón de apartar número
    $("#reserve-button").on("click", function(event) {
        const selectedNumbers = $("#number-list").children().map(function() {
            return $(this).text();
        }).get();

        // Ejemplo de lógica para apartar números
        const numberToReserve = $("#search-input").val();
        if (selectedNumbers.includes(numberToReserve)) {
            alert("El número ya está apartado.");
        } else {
            alert("Número apartado exitosamente.");
            // Aquí puedes agregar la lógica para marcar el número como apartado
        }
    });

    // Evento para mostrar el formulario al hacer clic en "Apartar Boletos"
    $("#show-form-button").on("click", function(event) {
        $("#reservation-form").show();
    });

    // Evento para cerrar el formulario
    $("#close-form").on("click", function(event) {
        $("#reservation-form").hide();
    });

    // Evento para cerrar el bottom sheet
    $("#close-footer").on("click", function(event) {
        $("#selected-numbers-footer").removeClass('show');
    });

    // Generar 5000 botones como ejemplo
    generateButtons(50001);

     // Cargar los países y estados al inicializar
     populateCountries("country", "state");
     populateStates("country", "state");
});
