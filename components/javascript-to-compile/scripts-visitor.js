// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 500);

// reset icon at the end of each search field
$(document).ready(function() {
  $(document).on('click','a[data-role=srcr]',function() {
    // "srcr" = search row clear & restore
    var id = $(this).data('id');
    var str = '';
    var text = document.getElementById(id).value;

    if (!/^ *$/.test(text)) {
      document.getElementById('h_' + id).value = text;
      document.getElementById(id).value= str;
      document.getElementById(id).select();
    } else {
      var text2 = document.getElementById('h_' + id).value;
      document.getElementById(id).value = text2;
      document.getElementById(id).focus();
    }
  });
});

// clipboard for search fields
$(document).ready(function() {
  $(document).on('click','a[data-role=srcb]',function() {
    var id       = $(this).data('id');
    var text = document.getElementById(id).value;

    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);

    // var originalIcon = $(this).html();
    var originalIcon = "<i class=\"far fa-copy fa-fw\"></i>"
    var changeBack  = $(this);

    $(this).html("<i class=\"fas fa-check fa-fw\"></i>");
    setTimeout(function() {
      changeBack.html(originalIcon);
    }, 1000);
 
  });
});

// homepage YouTube introduction video
var ytvideo = document.getElementById("ytvideo");
var watchvideo = document.getElementById("watchvideo");
var shutterdown = document.getElementsByClassName("shutterdown")[0];
var vid = document.getElementById("foo").getAttribute("src");

window.addEventListener("load", function(){
	watchvideo.onclick = function() {

		if (document.getElementById("foo").hasAttribute("src")) {
			ytvideo.style.display = "flex";
		} else {
			document.getElementById("foo").setAttribute("src", vid);
			ytvideo.style.display = "flex";
		}

	}
	shutterdown.onclick = function() {
		document.getElementById("foo").removeAttribute("src");
	  ytvideo.style.display = "none";
	}
	window.onclick = function(event) {
	  if (event.target == ytvideo) {
	  	document.getElementById("foo").removeAttribute("src");
	    ytvideo.style.display = "none";
	  }
	}
});

// end homepage YouTube introduction video

// a static link - stop from jumping to top of page
$('a.static').click(function(e) {
  e.preventDefault();
});


$(document).ready(function() {

  $(document).on('click','.create-form', function() {
    $('#landing').load('_insert-signup.php');
  });
  $(document).on('click','.log-form', function() {
    $('#landing').load('_insert-login.php');
  });
  $(document).on('click','.forgot-form', function() {
    $('#landing').load('_insert-forgotpass.php');
  });

});


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



/* show passwords */
$("#showLoginPass-home").click(function(){
var x = document.getElementById("password-home");
  $(this).toggleClass("showPassOn");

  if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide password') {
      $(this).html('<i class="far fa-eye"></i> Show password');
      x.type = "password";
  } else {
      $(this).html('<i class="far fa-eye-slash"></i> Hide password');
      x.type = "text";
  }
  return false;
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

// footer contact
$(document).ready(function() {
  $("#email-bob").hide();
  $("#toggle-contact-form").click(function(){
    $(this).toggleClass("active").next().slideToggle(600);

    if ($.trim($(this).text()) === 'close') {
      $(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>');
    } else {
      $(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>');
    }
    return false;
  });
});
// $("#contactForm").keyup(function(event) {
//   if (event.keyCode === 13) {
//     $("#emailBob").click();
//   }
// });
// $('#contactForm').submit(function(e){
//     e.preventDefault();
// });
$(document).ready(function() {
  $(document).on('click','#emailBob', function() {
    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $('#contactForm').serialize(),
      beforeSend: function(xhr) {
        $('#msg').removeClass('show');
        $('#emailBob-btn').html('<div class="sending-holup"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#msg').removeClass('show');
            $('#contactForm').html('<div class="success">Your message was sent successfully.</div><div id="emailBob-btn-insert"><div class="reset-contact">Reset</div></div>');
          } else {
            $('#msg').addClass('show');
            $('#errorli').html(response['li']);
            $('#emailBob-btn').html('<div id="emailBob">Send</div>');
          }
        } 
      },
      error: function() {
        $('#errorli').html('<li>There was an error between your IP and the server. Please try again later.</li>');
      }, 
      complete: function() {
        // $('#contact').html('<span>Your message was sent successfully.</span>');
        // $('#send-success').html('<input name="clozer" id="clozer" class="clozer" value="Close">');
      }
    })
  });
});
$(document).ready(function() {
  $(document).on('click','.reset-contact', function() {
    $('#contactForm').load('contact-insert.php');
  });
});



// // footer_contact_ajax
// function _(id) { return document.getElementById(id); }
// function submitFooter() {
//   _("send").disabled = true;
//   _("status").innerHTML = 'working on it...';
//   var formdata = new FormData();
//   formdata.append("sendersname", _("sendersname").value);
//   formdata.append("email", _("email").value);
//   formdata.append("comments", _("comments").value);
//   var ajax = new XMLHttpRequest();
//   ajax.open("POST", "footer_contact_ajax.php");
//   ajax.onreadystatechange = function() {
//     if(ajax.readyState == 4 && ajax.status == 200) {
//       if(ajax.responseText == "success") {
//         _("contactForm").innerHTML = '<h2 class="successmsg">Thanks '+_("sendersname").value+', your message was sent successfully!</h2>';
//       } else {
//         _("status").innerHTML = ajax.responseText;
//         _("send").disabled = false;
//       }
//     }
//   }
//   ajax.send(formdata);
// }