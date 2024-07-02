// navbar.js

// Función para cambiar el tamaño del navbar en función del scroll
function handleNavbarShrink() {
    const navbar = document.querySelector('.navbar');
    const navbarLinks = document.getElementById('navbarLinks');
    if (window.scrollY > 50) {
        navbar.classList.add('navbar-shrink');
        navbarLinks.style.top = '117px'; // Ajusta la posición de las opciones cuando el navbar está retraído
    } else {
        navbar.classList.remove('navbar-shrink');
        navbarLinks.style.top = '137px'; // Restablece la posición de las opciones cuando el navbar no está retraído
    }
}

// Escuchar el evento de scroll
window.addEventListener('scroll', handleNavbarShrink);

// Código para el menú responsive
function toggleMenu() {
    const navbarLinks = document.getElementById('navbarLinks');
    const menuIcon = document.querySelector('.menu-icon');
    navbarLinks.classList.toggle('show');
    menuIcon.classList.toggle('active');
}
