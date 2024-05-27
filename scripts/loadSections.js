function loadHTML(selector, file, callback) {
    fetch(file)
        .then(response => response.text())
        .then(data => {
            document.querySelector(selector).innerHTML = data;
            if (callback) callback();
        });
}

function hideSpecificSections() {
    const sectionsToHide = ['#carousel', '#about', '#faq', '#metodos_pago'];
    sectionsToHide.forEach(selector => {
        const section = document.querySelector(selector);
        if (section) {
            section.style.display = 'none';
        }
    });
}

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

document.addEventListener("DOMContentLoaded", () => {
    loadHTML("#navbar", "sections/navbar.html", () => {
        document.querySelector("#navbar").addEventListener("click", event => {
            if (event.target.matches("#nav-comprar-boletos")) {
                hideSpecificSections();
                const comprarBoletosSection = document.querySelector("#comprar_boletos");
                if (comprarBoletosSection) {
                    comprarBoletosSection.style.display = 'block';
                }
              
                loadCSS('styles/comprar_boletos.css');
                loadScript('scripts/boletos.js');
            } else if (event.target.matches("#nav-cuentas")) {
                hideSpecificSections();
                const cuentasSection = document.querySelector("#metodos_pago");
                if (cuentasSection) {
                    cuentasSection.style.display = 'block';
                }
                loadCSS('styles/metodos_pago.css');
                loadScript('scripts/metodos_pago.js');
            } else if (event.target.matches("#nav-inicio")) {
                hideSpecificSections();
                loadHTML("#carousel", "sections/carousel.html");
                loadHTML("#about", "sections/about.html");
                loadHTML("#faq", "sections/faq.html");
                loadHTML("#footer", "sections/footer.html");
            }
        });
    });

    loadHTML("#carousel", "sections/carousel.html");
    loadHTML("#about", "sections/about.html");
    loadHTML("#faq", "sections/faq.html");
    loadHTML("#comprar_boletos", "sections/comprar_boletos.html", () => {
        document.querySelector("#comprar_boletos").style.display = 'none';
    });
    loadHTML("#metodos_pago", "sections/metodos_pago.html");
    loadHTML("#footer", "sections/footer.html");
});
