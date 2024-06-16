function toggleMenu() {
    var navbarLinks = document.getElementById('navbarLinks');
    if (navbarLinks.classList.contains('show')) {
        navbarLinks.classList.remove('show');
        setTimeout(function () {
            navbarLinks.style.display = 'none';
        }, 300); // Esperar a que termine la animación antes de ocultar
    } else {
        navbarLinks.style.display = 'block';
        setTimeout(function () {
            navbarLinks.classList.add('show');
        }, 10); // Asegurar que se agrega la clase después de que el bloque sea visible
    }
}

let lastScrollTop = 0;

window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        // Scroll down
        navbar.classList.add("navbar-shrink");
    } else {
        // Scroll up
        navbar.classList.remove("navbar-shrink");
    }
    lastScrollTop = currentScroll;
});
