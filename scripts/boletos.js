$(document).ready(function() {
    let totalButtons = 1000; // Ajustar a 1000 botones
    let occupiedNumbers = new Set();

    // Función para obtener los números ocupados y pendientes desde el servidor
    function fetchOccupiedNumbers() {
        return $.ajax({
            url: 'backend/getOccupiedNumbers.php?rifaId=1', // Asegúrate de ajustar el rifaId según sea necesario
            method: 'GET',
            dataType: 'json'
        }).then(response => {
            if (response.success) {
                response.numbers.forEach(numberInfo => {
                    occupiedNumbers.add(parseInt(numberInfo.Number)); // Asegúrate de que los números sean enteros
                });
            } else {
                console.error('Error fetching occupied numbers:', response.message);
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }

    // Función para generar todos los botones
    function generateButtons() {
        const container = $("#buttons-container");

        // Limpiar el contenedor para evitar duplicados
        container.empty();

        for (let i = 0; i < totalButtons; i++) {
            const number = String(i).padStart(5, '0'); // Asegurar que tenga 5 cifras
            const button = $("<button class='button'>" + number + "</button>");

            if (occupiedNumbers.has(i)) {
                button.addClass('occupied');
            } else {
                button.addClass('available');
                button.on('click', function() {
                    toggleSelection(number, button);
                });
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
            if (existingItem.length === 0) {
                button.addClass('selected');
                const listItem = $("<li>" + number + "</li>");
                listItem.on('click', function() {
                    $(this).remove();
                    button.removeClass('selected');
                    if (list.children().length === 0) {
                        $("#selected-numbers-footer").removeClass('show');
                    }
                });
                listItem.appendTo(list);
            }
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
        const numberToReserve = $("#search-input").val().padStart(5, '0');
        if (occupiedNumbers.has(parseInt(numberToReserve))) {
            alert("El número ya está ocupado.");
            return;
        }

        const list = $("#number-list");
        const existingItem = list.children().filter(function() {
            return $(this).text() === numberToReserve;
        });

        if (existingItem.length === 0) {
            const button = $("<button class='button available selected'>" + numberToReserve + "</button>");
            button.on('click', function() {
                toggleSelection(numberToReserve, button);
            });
            const listItem = $("<li>" + numberToReserve + "</li>");
            listItem.on('click', function() {
                $(this).remove();
                button.removeClass('selected');
                if (list.children().length === 0) {
                    $("#selected-numbers-footer").removeClass('show');
                }
            });
            listItem.appendTo(list);

            if (list.children().length > 0) {
                $("#selected-numbers-footer").addClass('show');
            } else {
                $("#selected-numbers-footer").removeClass('show');
            }
        } else {
            alert("El número ya está en la lista de apartados.");
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

    $("#reservation-form form").on("submit", function(event) {
        event.preventDefault();
        
        const name = $("#name").val();
        const phone = $("#phone").val();
        const selectedNumbers = $("#number-list").children().map(function() {
            return $(this).text();
        }).get();
        const rifaId = 1; // Ajusta el rifaId según sea necesario

        if (selectedNumbers.length === 0) {
            alert("Por favor, seleccione al menos un número.");
            return;
        }

        $.ajax({
            url: 'backend/saveOrder.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                personName: name,
                personPhone: phone,
                numeros: selectedNumbers,
                rifaId: rifaId
            }),
            success: function(response) {
                if (response.success) {
                    alert("¡Número(s) apartado(s) exitosamente!");
                    $("#reservation-form").hide();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(error) {
                alert("Error: No se pudo completar la solicitud.");
                console.error(error);
            }
        });
    });

    // Obtener los números ocupados y pendientes antes de generar los botones
    fetchOccupiedNumbers().then(() => {
        // Generar todos los botones
        generateButtons();
    });
});
