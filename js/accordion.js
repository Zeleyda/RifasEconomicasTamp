document.addEventListener('DOMContentLoaded', function() {
    var accordionItems = document.querySelectorAll('.accordion-button');
    
    accordionItems.forEach(function(item) {
      item.addEventListener('click', function() {
        // Remueve la clase 'collapsed' de todos los botones
        accordionItems.forEach(function(btn) {
          if (btn !== item) {
            btn.classList.add('collapsed');
            btn.setAttribute('aria-expanded', 'false');
            var contentId = btn.getAttribute('data-bs-target');
            var content = document.querySelector(contentId);
            if (content) {
              content.classList.remove('show');
            }
          }
        });
      });
    });
  });