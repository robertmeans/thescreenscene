// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 500);



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
$('a.static').click(function(e)
{
   e.preventDefault();
});

// reset all form onload
function clearForms() {
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
}

// reset icon at the end of each search field
function reset_google() {
	var str = '';
    document.getElementById("gsearch").value= str;
    document.getElementById("gsearch").select();
}

function reset_url() {
	var str = '';
    document.getElementById("addressfield").value= str;
    document.getElementById("addressfield").select();
}

function reset_bing() {
	var str = '';
    document.getElementById("bsearch").value= str;
    document.getElementById("bsearch").select();
}

function reset_ref() {
	var str = '';
    document.getElementById("refsearch").value= str;
    document.getElementById("refsearch").select();
}

function reset_yt() {
	var str = '';
    document.getElementById("ytsearch").value= str;
    document.getElementById("ytsearch").select();
}


/* sweet rememberme triangle inside circle all css */
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
$("#showLoginPass").click(function(){
  var x = document.getElementById("password");
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

$("#showSignupPass").click(function(){
  var x = document.getElementById("showPassword");
  var y = document.getElementById("showConf");
    $(this).toggleClass("showPassOn");

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




// footer_contact_ajax
$(document).ready(function() {
 $('#send-footer').click(function() {
 	var name = $('#name').val();
 	var message = $('#message').val();

 	if (name == '') {
 		$('#error_message').html("What's your name?");
 	} else if (message == '') {
 		$('#error_message').html("Don't send me a blank message!");
 	} else {
 		$('#error_message').html('');
 		$.ajax({
 			url:"footer_contact_ajax.php",
 			method:"POST",
 			data:{name:name, message:message},
 			success:function(data) {
 				$("form").trigger("reset");
 				$('#success_message').fadeIn().html(data);

				setTimeout(function() {
				  $("#success_message").fadeOut('slow');
				}, 2000);

 			}
 		});
 	}
 });
});

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

