$(document).ready(function () {
    loadNavbar();
    loadCarousel();

    var navbar = document.querySelector('.navbar');
    var lastScrollTop = 0;

    window.addEventListener('scroll', function () {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Scrolling down
            navbar.classList.add('navbar-shrink');
        } else {
            // Scrolling up
            navbar.classList.remove('navbar-shrink');
        }

        lastScrollTop = scrollTop;
    });

    $('.navbar-toggler').on('click', function () {
        $('#navbarNav').toggleClass('show');
    });

    // Función para cargar secciones
    function cargarSeccion(seccion) {
        const secciones = [
            'carousel-container',
            'about-container',
            'rifas-container',
            'faq-container',
            'payment-methods-container',
            'cuentas-container',
            'comprar-boletos-container'
        ];
        secciones.forEach(function (id) {
            document.getElementById(id).style.display = 'none';
        });
        document.getElementById(seccion).style.display = 'block';
    }

    // Mostrar todas las secciones en Inicio
    $(document).on('click', '#nav-inicio', function () {
        $('#carousel-container').show();
        $('#about-container').show();
        $('#rifas-container').show();
        $('#faq-container').show();
        $('#payment-methods-container').show();
        $('#cuentas-container').hide();
        $('#comprar-boletos-container').hide();
    });

    // Mostrar solo la sección de Cuentas
    $(document).on('click', '#nav-cuentas', function () {
        cargarSeccion('cuentas-container');

    });

    // Puedes agregar eventos similares para las otras secciones
    $(document).on('click', '#nav-verificador', function () {
        cargarSeccion('verificador-container');
    });

    $(document).on('click', '#nav-comprar-boletos', function () {
        cargarSeccion('comprar-boletos-container');
    });
});

function loadNavbar() {
    $('#navbar-container').load('navbar.html');
}

function loadCarousel() {
    // Aquí iría la lógica para cargar el carousel si tienes un archivo HTML separado o contenido específico.
}
