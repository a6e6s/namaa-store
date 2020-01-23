
$(window).on('load', function () {
    setTimeout(function () {
        $('.preloader').addClass('compleate');

    }, 200);

});

$(document).ready(function () {

    $('.owl-carousel').owlCarousel({
        margin: 10,
        loop: true,
        responsiveClass: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            500: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true,
            }
        }
    });

    new WOW().init();

});
