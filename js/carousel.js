let slideIndex = 0;

function moveSlide(n) {
    const slides = document.getElementsByClassName("slide");
    slideIndex += n;
    if (slideIndex >= slides.length) {
        slideIndex = 0;
    }
    if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }
    const carousel = document.querySelector(".carousel");
    carousel.style.transform = `translateX(${-slideIndex * 100}%)`;
}

function autoSlide() {
    moveSlide(1);
}

// Cambia la imagen cada 5 segundos
setInterval(autoSlide, 2800);
