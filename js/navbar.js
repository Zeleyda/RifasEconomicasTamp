function toggleMenu() {
    var navbarLinks = document.getElementById('navbarLinks');
    if (navbarLinks.style.display === 'block') {
        navbarLinks.style.display = 'none';
    } else {
        navbarLinks.style.display = 'block';
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
