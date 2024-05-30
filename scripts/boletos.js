$(document).ready(function() {
    let totalButtons = 50000;
    let buttonsPerLoad = 100;
    let loadedButtons = 0;

    // Función para generar N botones de manera horizontal
    function generateButtons(start, end) {
        const container = $("#buttons-container");

        for (let i = start; i < end; i++) {
            if (i >= totalButtons) break;

            const number = String(i).padStart(5, '0'); // Asegurar que tenga 5 cifras
            const button = $("<button class='button'>" + number + "</button>");

            const isMarked = Math.random() > 0.5; // 50% de probabilidad de estar marcado
            if (isMarked) {
                button.addClass('occupied');
            } else {
                button.addClass('available');
                button.on('click', () => toggleSelection(number, button));
            }

            container.append(button);
        }
    }

    function toggleSelection(number, button) {
        const list = $("#number-list");
        const existingItem = list.children().filter(function() {
            return $(this).text() === number;
        });

        if (button.hasClass('selected')) {
            button.removeClass('selected');
            existingItem.remove();
        } else {
            button.addClass('selected');
            $("<li>" + number + "</li>").appendTo(list);
        }

        if (list.children().length > 0) {
            $("#selected-numbers-footer").addClass('show');
        } else {
            $("#selected-numbers-footer").removeClass('show');
        }
    }

    $("#search-input").on("input", function(event) {
        const searchTerm = $(this).val();
        // Aquí puedes agregar la lógica para buscar el término en los números disponibles
    });

    $("#reserve-button").on("click", function(event) {
        const selectedNumbers = $("#number-list").children().map(function() {
            return $(this).text();
        }).get();

        const numberToReserve = $("#search-input").val();
        if (selectedNumbers.includes(numberToReserve)) {
            alert("El número ya está apartado.");
        } else {
            alert("Número apartado exitosamente.");
        }
    });

    $("#show-form-button").on("click", function(event) {
        $("#reservation-form").show();
    });

    $("#close-form").on("click", function(event) {
        $("#reservation-form").hide();
    });

    $("#close-footer").on("click", function(event) {
        $("#selected-numbers-footer").removeClass('show');
    });

    $(window).on('scroll', function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 10) {
            loadMoreButtons();
        }
    });

    function loadMoreButtons() {
        const start = loadedButtons;
        const end = start + buttonsPerLoad;
        generateButtons(start, end);
        loadedButtons += buttonsPerLoad;
    }

    // Generar los primeros botones
    loadMoreButtons();

    populateCountries("country", "state");
    populateStates("country", "state");
});
