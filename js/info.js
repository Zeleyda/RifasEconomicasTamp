document.addEventListener('DOMContentLoaded', function() {
    let originalContent; // Variable para almacenar el contenido original del contenedor principal

    function showSection(sectionId) {
        // Restaurar el contenido original si está en modo "VERIFICADOR" o "COMPRAR BOLETOS"
        if (originalContent && document.getElementById('mainContainer').innerHTML !== originalContent) {
            document.getElementById('mainContainer').innerHTML = originalContent;
        }

        // Mostrar todas las secciones si 'inicio' está seleccionado
        if (sectionId === 'inicio') {
            const infoContainers = document.getElementsByClassName('info-container');
            const infoTitles = document.getElementsByClassName('info-title');
            for (let i = 0; i < infoContainers.length; i++) {
                infoContainers[i].style.display = 'flex';
                infoTitles[i].style.display = 'block';
            }
            document.getElementById('carouselContainer').style.display = 'block';
            return;
        }

        // Ocultar el carrusel para otras secciones
        const carouselContainer = document.getElementById('carouselContainer');
        if (carouselContainer) {
            carouselContainer.style.display = 'none';
        }

        // Ocultar todos los contenedores de información y títulos
        const infoContainers = document.getElementsByClassName('info-container');
        const infoTitles = document.getElementsByClassName('info-title');
        for (let i = 0; i < infoContainers.length; i++) {
            infoContainers[i].style.display = 'none';
            infoTitles[i].style.display = 'none';
        }

        // Mostrar el contenedor y título de información seleccionados
        const selectedContainer = document.getElementById(`${sectionId}-container`);
        const selectedTitle = document.getElementById(`${sectionId}-title`);
        if (selectedContainer && selectedTitle) {
            selectedContainer.style.display = 'flex';
            selectedTitle.style.display = 'block';
        }
    }

    function showVerifier() {
        // Almacenar el contenido original para poder restaurarlo más tarde
        if (!originalContent) {
            originalContent = document.getElementById('mainContainer').innerHTML;
        }

        // Ocultar todos los contenedores de información y títulos
        const infoContainers = document.getElementsByClassName('info-container');
        const infoTitles = document.getElementsByClassName('info-title');
        for (let i = 0; i < infoContainers.length; i++) {
            infoContainers[i].style.display = 'none';
            infoTitles[i].style.display = 'none';
        }

        // Ocultar el carrusel
        const carouselContainer = document.getElementById('carouselContainer');
        if (carouselContainer) {
            carouselContainer.style.display = 'none';
        }

        // Cargar el contenido de verificador.html
        fetch('sections/verificador.html')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('mainContainer').innerHTML = data;
                applyStylesForDynamicContent();
            })
            .catch(error => console.error('Error loading verificador.html:', error));
    }

    function showComprarBoletos() {
        // Almacenar el contenido original para poder restaurarlo más tarde
        if (!originalContent) {
            originalContent = document.getElementById('mainContainer').innerHTML;
        }

        // Ocultar todos los contenedores de información y títulos
        const infoContainers = document.getElementsByClassName('info-container');
        const infoTitles = document.getElementsByClassName('info-title');
        for (let i = 0; i < infoContainers.length; i++) {
            infoContainers[i].style.display = 'none';
            infoTitles[i].style.display = 'none';
        }

        // Ocultar el carrusel
        const carouselContainer = document.getElementById('carouselContainer');
        if (carouselContainer) {
            carouselContainer.style.display = 'none';
        }

        // Cargar el contenido de comprar_boletos.html
        fetch('sections/comprar_boletos.html')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('mainContainer').innerHTML = data;
                applyStylesForDynamicContent();
            })
            .catch(error => console.error('Error loading comprar_boletos.html:', error));
    }

    function applyStylesForDynamicContent() {
        const mainContainer = document.getElementById('mainContainer');
        mainContainer.style.display = 'flex';
        mainContainer.style.flexDirection = 'column';
        mainContainer.style.alignItems = 'center';
        mainContainer.style.justifyContent = 'center';
        mainContainer.style.height = 'calc(100vh - 150px)'; // Ajusta el contenedor para evitar solapamiento con el footer
    }

    // Hacer las funciones accesibles globalmente
    window.showSection = showSection;
    window.showVerifier = showVerifier;
    window.showComprarBoletos = showComprarBoletos;

    // Mostrar todas las secciones al cargar para la sección "Inicio"
    showSection('inicio');
});

