// loader
$(window).on('load', function () {
    setTimeout(function () {
        $('.preloader').addClass('compleate');

    }, 200);

});
// owl carousel
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
// activating mobile
// Attach a submit handler to the form
$("#pay .activate").click(function (event) {
    //check mobile num compleation
    if ($("#mobile").inputmask("isComplete")) {
        //show modal
        $('#addcode').modal('show');
        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page
        var $form = $('#pay'),
            term = $form.find("input[name='mobile']").val(),
            url = $form.attr("action") + "/../getmobilecode";

        $.post(url, { name: term, time: url })
            .done(function (data) {
                $('.msg').html(data);
            });
    } else {
        $('#addcode').modal('hide');
        $('.msg').html('<div class="alert alert-danger text-danger"> من فضلك ادخل رقم الجوال بطريقة صحيحة </div>');
    }
});

// check activation code
$("#active-code").submit(function (event) {
    // Stop form from submitting normally
    event.preventDefault();
    // Get some values from elements on the page:
    var $form = $(this),
        term = $form.find("input[name='code']").val(),
        url = $form.attr("action") + "/validatemobile";
    //prosess with the request
    $.post(url, { code: term, url: url })
        .done(function (data) {
            var data = JSON.parse(data);
            if (data.status == 'success') {
                $('.msg').html(data.msg);
                $('#addcode').modal('hide');
                $('#mobile').prop("readonly", true);
                $('.activate').hide();
                if ($("#mobile").inputmask("isComplete") && $("#full-name").inputmask("isComplete")) {
                    $('form').unbind('submit');
                }
            } else {
                $('.msg').html(data.msg);
            }
        });
});
// input masking and form validation
$("#pay").submit(function (event) {
    //validate full name
    if (!$("#full-name").inputmask("isComplete")) {
        $('.msg').html('<div class="alert alert-danger text-danger"> من فضلك تأكد من ادخال الاسم بطريقة صحيحة </div>');
    }
});
