document.addEventListener("DOMContentLoaded", () => {
    function loadHTML(selector, file, callback) {
        fetch(file)
            .then(response => response.text())
            .then(data => {
                document.querySelector(selector).innerHTML = data;
                if (callback) callback();
            });
    }

    function hideSpecificSections() {
        const sectionsToHide = ['#carousel', '#about', '#faq', '#metodos_pago', '#comprar_boletos'];
        sectionsToHide.forEach(selector => {
            const section = document.querySelector(selector);
            if (section) {
                section.style.display = 'none';
            }
        });
    }

    function showSection(selector) {
        const section = document.querySelector(selector);
        if (section) {
            section.style.display = 'block';
        }
    }

    loadHTML("#navbar", "sections/navbar.html", () => {
        document.querySelector("#navbar").addEventListener("click", event => {
            if (event.target.matches("#nav-comprar-boletos")) {
                hideSpecificSections();
                showSection("#comprar_boletos");
                loadCSS('styles/comprar_boletos.css');
                loadScript('scripts/boletos.js');
            } else if (event.target.matches("#nav-cuentas")) {
                document.querySelector("#metodos_pago").scrollIntoView({ behavior: 'smooth' });
            } else if (event.target.matches("#nav-inicio")) {
                hideSpecificSections();
                loadHTML("#carousel", "sections/carousel.html", () => showSection("#carousel"));
                loadHTML("#about", "sections/about.html", () => showSection("#about"));
                loadHTML("#faq", "sections/faq.html", () => showSection("#faq"));
                loadHTML("#footer", "sections/footer.html", () => showSection("#footer"));
                loadHTML("#metodos_pago", "sections/metodos_pago.html", () => showSection("#metodos_pago"));
            }
        });
    });

    // Cargar secciones iniciales
    loadHTML("#carousel", "sections/carousel.html", () => showSection("#carousel"));
    loadHTML("#about", "sections/about.html", () => showSection("#about"));
    loadHTML("#faq", "sections/faq.html", () => showSection("#faq"));
    loadHTML("#comprar_boletos", "sections/comprar_boletos.html", () => {
        const comprarBoletosSection = document.querySelector("#comprar_boletos");
        if (comprarBoletosSection) {
            comprarBoletosSection.style.display = 'none';
        }
    });
    loadHTML("#metodos_pago", "sections/metodos_pago.html", () => showSection("#metodos_pago"));
    loadHTML("#footer", "sections/footer.html", () => showSection("#footer"));
});

function loadScript(src) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
    });
}

function loadCSS(href) {
    return new Promise((resolve, reject) => {
        if (!document.querySelector(`link[href="${href}"]`)) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            link.onload = resolve;
            link.onerror = reject;
            document.head.appendChild(link);
        } else {
            resolve();
        }
    });
}
