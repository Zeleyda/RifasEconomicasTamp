// navbar.js

// Función para cambiar el tamaño del navbar en función del scroll
function handleNavbarShrink() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('navbar-shrink');
    } else {
        navbar.classList.remove('navbar-shrink');
    }
}

// Escuchar el evento de scroll
window.addEventListener('scroll', handleNavbarShrink);

// Código para el menú responsive
function toggleMenu() {
    const navbarLinks = document.getElementById('navbarLinks');
    navbarLinks.classList.toggle('show');
}
