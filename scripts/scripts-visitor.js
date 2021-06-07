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
$('a.static').click(function(e)
{
   e.preventDefault();
});

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


// footer ajax contact
$(document).ready(function() {
  $('#emailBob').click(function() {
    //event.preventDefault();
    $.ajax({
      dataType: "JSON",
      url: "contact-process.php",
      type: "POST",
      data: $('#contactForm').serialize(),
      beforeSend: function(xhr) {
        $('#msg').html('<span>Sending - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#contactForm').html('<span>Your message was sent successfully.</span>');
          } else {
            $('#msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {
        // $('#contact').html('<span>Your message was sent successfully.</span>');
        // $('#send-success').html('<input name="clozer" id="clozer" class="clozer" value="Close">');
      }
    })
  });
});







// footer_contact_ajax
function _(id) { return document.getElementById(id); }
function submitFooter() {
  _("send").disabled = true;
  _("status").innerHTML = 'working on it...';
  var formdata = new FormData();
  formdata.append("sendersname", _("sendersname").value);
  formdata.append("email", _("email").value);
  formdata.append("comments", _("comments").value);
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "footer_contact_ajax.php");
  ajax.onreadystatechange = function() {
    if(ajax.readyState == 4 && ajax.status == 200) {
      if(ajax.responseText == "success") {
        _("contactForm").innerHTML = '<h2 class="successmsg">Thanks '+_("sendersname").value+', your message was sent successfully!</h2>';
      } else {
        _("status").innerHTML = ajax.responseText;
        _("send").disabled = false;
      }
    }
  }
  ajax.send(formdata);
}