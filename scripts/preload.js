function recaptchaCallback() {
  $('#confirm').addClass('display');
  $('#send').removeAttr('disabled');
  $('#send').removeClass('display');
};

$(window).on('load', function() {
  var current_loc = window.location.href;
  if (current_loc.indexOf("localhost") > -1) {
    // $(".preload").delay(0).fadeOut(0);
    $(".preload").delay(0).fadeOut(250);
  } else {
    $(".preload").delay(0).fadeOut(250); 
  }
});

