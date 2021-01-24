function recaptchaCallback() {
    $('#confirm').addClass('display');
    $('#send').removeAttr('disabled');
    $('#send').removeClass('display');
	};

$(window).on('load', function() {
    // $(".preload").hide();
    $(".preload").delay(0).fadeOut(0);
    });

$(window).on('load', function() {
    $(".preload-manage").delay(200).fadeOut(500);
    });

