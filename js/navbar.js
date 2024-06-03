$(document).ready(function () {
    'use strict';

    var navbar = document.getElementById('navbar');
    window.onscroll = function () {
        if (window.scrollY > 100) {
            navbar.classList.add('navbar-shrink');
        } else {
            navbar.classList.remove('navbar-shrink');
        }
    };

    $('.navbar-toggler').on('click', function () {
        $('.offcanvas-collapse').toggleClass('open');
    });
});
