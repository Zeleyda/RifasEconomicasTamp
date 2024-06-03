function loadNavbar() {
    $('#navbar-container').load('sections/navbar.html', function () {
        $.getScript('js/navbar.js');
        $('head').append('<link rel="stylesheet" href="styles/navbar.css" type="text/css" />');
    });
}

function loadCarousel() {
    $('#carousel-container').load('sections/carousel.html', function () {
        $.getScript('js/carousel.js');
        $('head').append('<link rel="stylesheet" href="styles/carousel.css" type="text/css" />');
    });
}

function loadAbout() {
    $('#about-container').load('sections/about.html', function () {
        $('head').append('<link rel="stylesheet" href="styles/about.css" type="text/css" />');
    });
}

function loadRifas() {
    $('#rifas-container').load('sections/rifa-description.html', function () {
        $('head').append('<link rel="stylesheet" href="styles/rifa-description.css" type="text/css" />');
    });
}

function loadFaq() {
    $('#faq-container').load('sections/faq.html', function () {
        $('head').append('<link rel="stylesheet" href="styles/faq.css" type="text/css" />');
    });
}

function loadPaymentMethods() {
    $('#payment-methods-container').load('sections/metodos_pago.html', function () {
        $('head').append('<link rel="stylesheet" href="styles/metodos_pago.css" type="text/css" />');
    });
}

function loadFooter() {
    $('#footer-container').load('sections/footer.html', function () {
        $('head').append('<link rel="stylesheet" href="styles/footer.css" type="text/css" />');
    });
}

// Llama a las funciones para cargar el contenido
$(document).ready(function () {
    loadNavbar();
    loadCarousel();
    loadAbout();
    loadRifas();
    loadFaq();
    loadPaymentMethods();
    loadFooter();
});


