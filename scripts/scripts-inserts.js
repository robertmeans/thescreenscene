
$('input[name="remember_me-insert"]').change(function(){
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
    $('#signup-btn').click();
  }
});
$('#signup-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  $(document).on('click','#signup-btn', function() {    

    $.ajax({
      dataType: "JSON",
      url: "signup-process.php",
      type: "POST",
      data: $('#signup-form').serialize(),
      beforeSend: function(xhr) {
        $('#toggle-signup-btn').html('<div class="verifying-msg"><span class="login-txt"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></span></div>');
      },
      success: function(response) {
        console.log('a ' + response);
        if(response) {
          console.log('b ' + response);
          if(response['signal'] == 'ok') {
            $('#landing').load('signup-success-insert.php');

          } else {
            $('#signup-alert').addClass(response['class']);
            $('#signup-errors').html(response['li']);
            $('#toggle-signup-btn').html('<div id="signup-btn"><span class="login-txt"><img src="_images/try-again.png"></span></div>');
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








// login begin (insert version)
$('#login-form-insert').keyup(function(event) {
  if (event.keyCode === 13) {
    $('#login-btn-insert').click();
  }
});
$('#login-form-insert').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  var login_attempts = 0;
  $(document).on('click','#login-btn-insert', function() {
    var current_loc = window.location.href;

    if (!$('li').hasClass('no-count')) {
      login_attempts += 1;
    } else {
      login_attempts += 0;
    }      

    $.ajax({
      dataType: "JSON",
      url: "login-process.php",
      type: "POST",
      data: $('#login-form-insert').serialize(),
      beforeSend: function(xhr) {
        $('#login-alert').removeClass('red blue orange green'); // reset class every click
        $('#error-area').removeClass('gone');
        $('#toggle-btn-insert').html('<div class="verifying-msg"><span class="login-txt"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></span></div>');

      },
      success: function(response) {
        // console.log(response);
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
            $('#login-alert').addClass(response['class']);

            if ((response['count'] == 'on') && login_attempts >= 3 && current_loc.indexOf("localhost") > -1) {
              $('#errors').html(response['li'] + '<li>You\'ve entered the wrong password ' + login_attempts + ' times now. Don\'t forget, you can always <a class="fp-link" href="http://localhost/browsergadget/forgot_password.php">reset</a> it.</li>');
            } else if ((response['count'] == 'on') && login_attempts >= 3 && current_loc.indexOf("browsergadget.com") > -1)  {
              $('#errors').html(response['li'] + '<li>You\'ve entered the wrong password ' + login_attempts + ' times now. Don\'t forget, you can always <a class="fp-link" href="https://browsergadget.com/forgot_password.php">reset</a> it.</li>');
            } else {
              $('#errors').html(response['li']);
            }

            $('#toggle-btn-insert').html('<div id="login-btn-insert"><span class="login-txt"><img src="_images/try-again.png"></span></div>');
          }
        } 
      },
      error: function(response) {
        // console.log(response);
        $('#login-btn').html(response['msg']);
      }, 
      complete: function() {

      }
    })

  });
});




// forgot password recovery begin
$('#forgot-form').keyup(function(event) {
  if (event.keyCode === 13) {
    $('#forgot-btn').click();
    // alert('click works');
  }
});
$('#forgot-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  $(document).on('click','#forgot-btn', function(e) {     

    $.ajax({
      dataType: "JSON",
      url: "forgot-process.php",
      type: "POST",
      data: $('#forgot-form').serialize(),
      beforeSend: function(xhr) {

        $('#pswd-recovery').removeClass('gone');
        $('#forgot-alert').removeClass('red blue orange green'); // reset class every click 
        $('#pswd-recovery').addClass('holup');
        $('#pswd-recovery').html('<p>Gimme a second...</p>')
        $('#toggle-forgot-btn').html('<div class="verifying-msg"><span class="login-txt"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></span></div>');

      },
      success: function(response) {
        // console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {
            $('#landing').load('forgotpass-success-insert.php');

          } else {
            $('#pswd-recovery').addClass('gone');
            $('#pswd-recovery').removeClass('holup');
            
            $('#forgot-alert').addClass(response['class']);
            $('#forgot-errors').html(response['li']);
            $('#toggle-forgot-btn').html('<div id="forgot-btn"><span class="login-txt"><img src="_images/try-again.png"></span></div>');
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
    $('#reset-btn').click();
    // alert('click works');
  }
});
$('#reset-form').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {

  $(document).on('click','#reset-btn', function(e) {     
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "reset-process.php",
      type: "POST",
      data: $('#reset-form').serialize(),
      beforeSend: function(xhr) {

        $('#reset-error-area').removeClass('gone');
        $('#reset-alert').removeClass('red blue orange green'); // reset class every click 
        $('#reset-error-area').addClass('holup');
        $('#reset-error-area').html('<p>Gimme a second...</p>')
        $('#toggle-reset-btn').html('<div class="verifying-msg"><span class="login-txt<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></span></div>');

      },
      success: function(response) {
        // console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {
            
            if (current_loc.indexOf("localhost") > -1) {
              window.location.replace("http://localhost/browsergadget");
            } else {
              window.location.replace("https://browsergadget.com");
            }

          } else {
            $('#reset-error-area').addClass('gone');
            $('#reset-error-area').removeClass('holup');
            
            $('#reset-alert').addClass(response['class']);
            $('#reset-errors').html(response['li']);
            $('#toggle-reset-btn').html('<div id="reset-btn"><span class="login-txt"><img src="_images/try-again.png"></span></div>');
          }
        } 
      },
      error: function(response) {
        // console.log(response);
        $('#reset-btn').html(response['msg']);
      }, 
      complete: function() {

      }
    })

  });

});



// footer contact - insert version
// $(document).ready(function() {
//   $(document).on('click','#emailBob', function() {
//     $.ajax({
//       dataType: "JSON",
//       url: "contact-process.php",
//       type: "POST",
//       data: $('#contactForm').serialize(),
//       beforeSend: function(xhr) {
//         $('#msg').removeClass('show');
//         $('#emailBob-btn').html('<div class="sending-holup"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
//       },
//       success: function(response) {
//         // console.log(response);
//         if(response) {
//           console.log(response);
//           if(response['signal'] == 'ok') {
//             $('#msg').removeClass('show');
//             $('#contactForm').html('<div class="success">Your message was sent successfully.</div>');
//           } else {
//             $('#msg').addClass('show');
//             $('#errorli').html(response['li']);
//             $('#emailBob-btn').html('<div id="emailBob">Send</div>');
//           }
//         } 
//       },
//       error: function() {
//         $('#errorli').html('<li>There was an error between your IP and the server. Please try again later.</li>');
//       }, 
//       complete: function() {

//       }
//     })
//   });
// });