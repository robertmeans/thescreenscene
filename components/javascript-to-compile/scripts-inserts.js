
$('input[name="remember_me"]').change(function(){ 
    if($(this).is(":checked")) {
        $('.aa-rm-out').addClass("checkablue");
        $('.aa-rm-in').addClass("checkaroo");
        $('.rm-rm').addClass("hot");
    } else {
        $('.aa-rm-out').removeClass("checkablue");
        $('.aa-rm-in').removeClass("checkaroo");
        $('.rm-rm').removeClass("hot");
    }
});

$('#showLoginPass').click(function(){
  var x = document.getElementById('password');
    $(this).toggleClass('showPassOn');

    if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide password') {
        $(this).html('<i class="far fa-eye"></i> Show password');
        x.type = "password";
    } else {
        $(this).html('<i class="far fa-eye-slash"></i> Hide password');
        x.type = "text";
    }
    return false;
  });

$('#showSignupPass').click(function(){
  var x = document.getElementById('showPassword');
  var y = document.getElementById('showConf');
  $(this).toggleClass('showPassOn');

  if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide passwords') {
      $(this).html('<i class="far fa-eye"></i> Show passwords');
      x.type = "password";
      y.type = "password";
  } else {
      $(this).html('<i class="far fa-eye-slash"></i> Hide passwords');
      x.type = "text";
      y.type = "text";
  }
  return false;
});

// signup begin
$('#signup-form').keyup(function(event) {
  if (event.keyCode === 13) {
    $('.signup-btn').click();
  }
});
$('#signup-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  $(document).on('click','.signup-btn', function() {    

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $('#signup-form').serialize(),
      beforeSend: function(xhr) {
        $('#message').removeClass('red blue orange green'); // reset class every click
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },
      success: function(response) {
        console.log('a ' + response);
        if(response) {
          console.log('b ' + response);
          if(response['signal'] == 'ok') {
            $('#landing').load('_insert-signup-success.php');

          } else {
            $('#message').addClass(response['class']);
            $('#msg-ul').html(response['li']);
            $('#buttons').html('<a class="submit login signup-btn full-width">Try again</a>');
          }
        } 
      },
      error: function(response) {
        console.log('c ' + response);
        $('#toggle-signup-btn').html(response['msg']);
      }, 
      complete: function(response) {
        console.log('d ' + response);
      }
    })

  });
});

// login begin
$("#login-form").keyup(function(event) {
  if (event.keyCode === 13) {
    $(".login-btn").click();
  }
});
$('#login-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  var login_attempts = 0;
  $(document).on('click','.login-btn', function() {
    var current_loc = window.location.href;

    if (!$('li').hasClass('no-count')) {
      login_attempts += 1;
    } else {
      login_attempts += 0;
    }      

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $('#login-form').serialize(),
      beforeSend: function(xhr) {
        $('#message').removeClass('red blue orange green'); // reset class every click
        $('#error-area').removeClass('gone');
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');

      },
      success: function(response) {
        console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {

            if (current_loc.indexOf("localhost") > -1) {
              window.location.replace("http://localhost/browsergadget");
            } else {
              window.location.replace("https://browsergadget.com");
            }

          } else {
            if ($('#reset-success').length != 0) { $('#reset-success').addClass('unset'); }
            $('#error-area').addClass('gone');
            $('#message').addClass(response['class']);

            if ((response['count'] == 'on') && login_attempts >= 3 && current_loc.indexOf("localhost") > -1) {
              $('#msg-ul').html(response['li'] + '<li>You\'ve entered the wrong password ' + login_attempts + ' times now. Don\'t forget, you can always <a class="fp-link forgot-form">reset</a> it.</li>');
            } else if ((response['count'] == 'on') && login_attempts >= 3 && current_loc.indexOf("browsergadget.com") > -1)  {
              $('#msg-ul').html(response['li'] + '<li>You\'ve entered the wrong password ' + login_attempts + ' times now. Don\'t forget, you can always <a class="fp-link forgot-form">reset</a> it.</li>');
            } else {
              $('#msg-ul').html(response['li']);
            }

            $('#buttons').html('<a class="submit login login-btn full-width">Try again</a>');
          }
        } 
      },
      error: function(response) {
        // console.log(response);
        $('.login-btn').html(response['msg']);
      }, 
      complete: function() {

      }
    })

  });
});

// forgot password recovery begin
$('#forgot-form').keyup(function(event) {
  if (event.keyCode === 13) {
    $('.forgot-btn').click();
    // alert('click works');
  }
});
$('#forgot-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  $(document).on('click','.forgot-btn', function(e) {     

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $('#forgot-form').serialize(),
      beforeSend: function(xhr) {
        $('#pswd-recovery').removeClass('gone');
        $('#message').removeClass('red blue orange green'); // reset class every click 
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');

      },
      success: function(response) {
        // console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {
            $('#landing').load('_insert-forgotpass-success.php');

          } else {
            $('#pswd-recovery').addClass('gone');
            
            $('#message').addClass(response['class']);
            $('#msg-ul').html(response['li']);
            $('#buttons').html('<a class="submit login forgot-btn full-width">Try again</a>');
          }
        } 
      },
      error: function(response) {
        // console.log(response);
        $('#forgot-btn').html(response['msg']);
      }, 
      complete: function() {

      }
    })

  });

});



// reset password begin
$('#reset-form').keyup(function(event) {
  if (event.keyCode === 13) {
    $('.reset-btn').click();
    // alert('click works');
  }
});
$('#reset-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  $(document).on('click','.reset-btn', function(e) {     
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $('#reset-form').serialize(),
      beforeSend: function(xhr) {
        $('#reset-error-area').removeClass('gone');
        $('#message').removeClass('red blue orange green'); // reset class every click 
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');

      },
      success: function(response) {
        // console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {
            $('#landing').load('_insert-reset-success.php');
          
          } else {
            $('#reset-error-area').addClass('gone');
            $('#reset-error-area').removeClass('holup');
            
            $('#message').addClass(response['class']);
            $('#msg-ul').html(response['li']);
            $('#buttons').html('<a class="submit login reset-btn full-width">Try again</a>');
          }
        } 
      },
      error: function(response) {
        // console.log(response);
        $('.reset-btn').html(response['msg']);
      }, 
      complete: function() {

      }
    })

  });

});
