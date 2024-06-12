function toggleAccordion(index) {
    var contents = document.querySelectorAll('.accordion-content');
    var buttons = document.querySelectorAll('.accordion-button');

    contents.forEach((content, i) => {
        if (i === index) {
            content.classList.toggle('show');
            buttons[i].classList.toggle('collapsed');
        } else {
            content.classList.remove('show');
            buttons[i].classList.add('collapsed');
        }
    });
}
