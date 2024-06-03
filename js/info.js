function showSection(sectionId) {
    // Show all sections if 'inicio' is selected
    if (sectionId === 'inicio') {
        const infoContainers = document.getElementsByClassName('info-container');
        const infoTitles = document.getElementsByClassName('info-title');
        for (let i = 0; i < infoContainers.length; i++) {
            infoContainers[i].style.display = 'flex';
            infoContainers[i].style.justifyContent = 'center';
            infoContainers[i].style.alignItems = 'center';
            infoTitles[i].style.display = 'block';
        }
        document.getElementById('carouselContainer').style.display = 'block';
        return;
    }

    // Hide the carousel for other sections
    document.getElementById('carouselContainer').style.display = 'none';

    // Hide all info containers and titles
    const infoContainers = document.getElementsByClassName('info-container');
    const infoTitles = document.getElementsByClassName('info-title');
    for (let i = 0; i < infoContainers.length; i++) {
        infoContainers[i].style.display = 'none';
        infoTitles[i].style.display = 'none';
    }

    // Show the selected info container and its title
    const selectedContainer = document.getElementById(`${sectionId}-container`);
    const selectedTitle = document.getElementById(`${sectionId}-title`);
    selectedContainer.style.display = 'flex';
    selectedContainer.style.justifyContent = 'center';
    selectedContainer.style.alignItems = 'center';
    selectedTitle.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function() {
    // Show all sections on load for the "Inicio" section
    showSection('inicio');
});
