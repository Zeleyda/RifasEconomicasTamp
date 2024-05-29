document.addEventListener("DOMContentLoaded", function() {
    // Ensure only one accordion item is open at a time
    const accordionItems = document.querySelectorAll('.accordion-button');

    accordionItems.forEach(button => {
        button.addEventListener('click', function() {
            const parent = button.closest('.accordion-item');
            const collapse = parent.querySelector('.accordion-collapse');
            
            if (!button.classList.contains('collapsed')) {
                button.classList.add('collapsed');
                collapse.classList.remove('show');
            } else {
                accordionItems.forEach(btn => {
                    if (btn !== button) {
                        const parentItem = btn.closest('.accordion-item');
                        const collapseItem = parentItem.querySelector('.accordion-collapse');
                        btn.classList.add('collapsed');
                        collapseItem.classList.remove('show');
                    }
                });
                button.classList.remove('collapsed');
                collapse.classList.add('show');
            }
        });
    });
});
