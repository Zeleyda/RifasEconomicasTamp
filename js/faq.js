$(document).ready(function() {
    $('.accordion-button').click(function() {
        var isActive = $(this).hasClass('active');
        $('.accordion-button').removeClass('active');
        $('.accordion-content').slideUp();
        if (!isActive) {
            $(this).addClass('active');
            $(this).next('.accordion-content').slideDown();
        }
    });
});
