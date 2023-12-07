// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 1250);

// add class to all li's with empty anchors in order to collapse
// those rows and keep things tight.
$(document).ready(function() {
  $("a.project-links-empty").each(function () {
    $(this).closest("li").addClass("ea");
  }); 
});

// icon at the end of each search field that removes or resets input content
// click once remove; click again reset
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

// clipboard for notes
$(document).ready(function() {
  $(document).on('click','a[data-role=cb]',function() {
    var id       = $(this).data('id');
    var text = document.getElementById("cb_"+id).innerText;

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

// a static link - stop from jumping to top of page
$('a.static').click(function(e) {
   e.preventDefault();
});


// login - see scripts-visitor.js


// *NEW: show then hide ddown menu on hover.
// uses hoverintent: https://briancherne.github.io/jquery-hoverIntent/
$(document).ready(function() {
  hiConfig = {
      sensitivity: 3, // number = sensitivity threshold (must be 1 or higher)
      interval: 200, // number = milliseconds for onMouseOver polling interval
      timeout: 100, // number = milliseconds delay before onMouseOut
      over: function() {
          $(this).children('.dropdown').stop().slideDown(250);
           
      }, // function = onMouseOver callback (REQUIRED)
      out: function() { $(this).children('.dropdown').slideUp(50);  } // function = onMouseOut callback (REQUIRED)
  }
  $('.menuitem').hoverIntent(hiConfig)
});


/* 	edit_order.php -> only owner can move hyperlinks so
	there's no shared_with version of this 	*/
// sort hyperlinks - start
$(document).ready(function() {
  $( "#sortable" ).sortable({
	update: function (event, ui) {
		save_order();
	 }	
  });
});

function save_order() {
var reorder = new Array();
  $('ul#sortable li').each(function() {
    reorder.push($(this).attr("id"));
  });

	$.ajax({
		url: 'edit_order_ajax.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			reorder: reorder
		}, success: function (response) {
			console.log(response);
		}
	});
}
// sort hyperlinks - end

// add a note sort
$(document).ready(function () {
	$('#sortanote').sortable({
		update: function (event, ui) {
			$(this).children().each(function (index) {
				if ($(this).attr('sort') != (index+1)) {
					$(this).attr('sort', (index+1)).addClass('updated');
				}
			});
			save_new_positions();
		}
	});
});

// ajax background save for sorting add a note
function save_new_positions() {
	var positions = [];
	$('.updated').each(function () {
        var thisida = $(this).attr('id');
        var thisid = thisida.substring(2);
		positions.push([thisid, $(this).attr('sort')]);
		$(this).removeClass('updated');
	});

	$.ajax({
		url: 'sort_note.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			positions: positions
		}, success: function (response) {
			console.log(response);
		}
	});
}

// edit_searches.php -> sortable search fields, opens:
// edit_search_order_owner.php and
// edit_search_order_shared_with.php
// invokes sortable and prevents instructions from moving
$("#sortablesearch").sortable({
    "cancel":"li.static",
    "update":function(event, ui) {
        $("#sortablesearch li.static").each(function() {
           var desiredLocation = $(this).attr("stay").replace("static-","");
           var currentLocation = $(this).index();
           while(currentLocation < desiredLocation) {
             $(this).next().insertBefore(this);
              currentLocation++;  
            }
            while(currentLocation > desiredLocation) {
             $(this).prev().insertAfter(this);
              currentLocation--;  
            }
        });
        if ($(this).hasClass('owner')) {
        	save_search_order();
        } else {
        	save_search_shared_with();
        }
    }
});
/*  only allow 1 row to be placed beneath instructions. */
$(document).ready(function() {
    $("#sortablesearch li.static").each(function () {
         $(this).attr("stay", "static-" + $(this).index());
    }); 
});
/* 	grab new order of search fields and put value into input with
	id = search_order */
function save_search_order() {
var reorder = [];
  $('ul#sortablesearch li.ct').each(function() {
    reorder.push($(this).attr("id"));

  });

	$.ajax({
		url: 'search_order_owner_ajax.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			reorder: reorder
		}, success: function (response) {
			console.log(response);
		}
	});
}

function save_search_shared_with() {
var reorder = [];
  $('ul#sortablesearch li.ct').each(function() {
    reorder.push($(this).attr("id"));
  });

	$.ajax({
		url: 'search_order_shared_with_ajax.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			reorder: reorder
		}, success: function (response) {
			console.log(response);
		}
	});
}

// footer contact
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

      }
    })
  });
});
$(document).ready(function() {
  $(document).on('click','.reset-contact', function() {
    $('#contactForm').load('_insert-contact.php');
  });
});


$(document).ready(function() { // 122120856 start
  /* Dictionary or Thesaurus on edit_searches.php */
	$('#d').click(function(){
	  $(this).addClass('selected');
	  $('#dict').addClass('selected');
	  $('#dic-row').addClass('selected');
	  if ($('#t').hasClass('selected')) {
	  	$('#t').removeClass('selected');
	  	$('#thes').removeClass('selected');
	  	$('#the-row').removeClass('selected');
	  }
	});
	$('#t').click(function(){
	  $(this).addClass('selected');
	  $('#thes').addClass('selected');
	  $('#the-row').addClass('selected');
	  if ($('#d').hasClass('selected')) {
	  	$('#d').removeClass('selected');
	  	$('#dict').removeClass('selected');
	  	$('#dic-row').removeClass('selected');
	  }
	});


  /* checkbox edit/share selections - share project checkboxs 1201231459 */
  $('input:checkbox.es').change(function(){
    if($(this).is(":checked")) {
      $('.edit').addClass("checked");
      $('.editcheck').addClass('show');
      $('.choice.edit').addClass('on');
    } else {
      $('.edit').removeClass("checked");
      $('.editcheck').removeClass('show');
      $('.choice.edit').removeClass('on');
    }
  });
	$('input:checkbox.ts').change(function(){
    if($(this).is(":checked")) {
      $('.share').addClass("checked");
      $('.sharecheck').addClass('show');
      $('.choice.share').addClass('on');
    } else {
      $('.share').removeClass("checked");
      $('.sharecheck').removeClass('show');
      $('.choice.share').removeClass('on');
    }
	});

  /* checkbox edit/share selections - share project checkboxs - modal edit version */
  $(document).on('click','label.edit2',function() {
    if($(this).hasClass("checked")) {
      $('label.edit2').removeClass("checked");
      $('#edit2').val('0');
      $('.editcheck2').removeClass('show');
      $('.choice.edit2').removeClass('on');
    } else {
      $('label.edit2').addClass("checked");
      $('#edit2').val('1');
      $('.editcheck2').addClass('show');
      $('.choice.edit2').addClass('on');
    }
  });


  $(document).on('click','label.share2',function() {
    if($(this).hasClass("checked")) {
      $('label.share2').removeClass("checked");
      $('#share2').val('0');
      $('.sharecheck2').removeClass('show');
      $('.choice.share2').removeClass('on');
    } else {
      $('label.share2').addClass("checked");
      $('#share2').val('1');
      $('.sharecheck2').addClass('show');
      $('.choice.share2').addClass('on');
    }
  });


/* toggle pages */
  $('.tab').hide();
  $('.tab.active').show();

	$('.tabs .tab-links input').on('click', function(e)  {
    var currentAttrValue = $(this).attr('name');
    var addthis = "#";
    var thesetwo = addthis.concat(currentAttrValue);
    // ^^ had to add these two together in JS instead of on the html page
    // because the # was interfering with the Ajax form submission.
		if ($(this).attr('name') !== 'tab4') { $('#rememberOpenTab').val(thesetwo); }
    var yothere = $('#rememberOpenTab').val();

    if (($(this).attr('name') === 'tab4') && ($(this).hasClass('noteson'))) {
    	$(this).removeClass('noteson');
    	$('#tab4').slideUp(100);
    	if ($('#rememberOpenTab').val()) {
    		$(yothere).slideDown();
    	} else {
    		$('.tab.active').slideDown(100);
    	}

    } else if ($('#yotab4').hasClass('noteson')) {
    	$('#yotab4').removeClass('noteson');
    	$('.tabs ' + thesetwo).slideDown(100).siblings().slideUp(100);
	    $(this).closest('li').addClass('active').siblings().removeClass('active');
    } else {
    	$(this).addClass('noteson');
	    $('.tabs ' + thesetwo).slideDown(100).siblings().slideUp(100);
	    $(this).closest('li').addClass('active').siblings().removeClass('active');
  	}

	}); // end tab switch

  /* initiate hidden details */
	$('.project-details').hide();
  $('.review-project').on('click', function() {
    var active = $(this);
    var toggle = $(this).next('.project-details');

    $('.project-details').not(toggle).slideUp();
    $('.review-project').not(active).removeClass('active');

    $(toggle).slideToggle();

    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
    } else {
      $(active).addClass('active');
    }

  });

  $('.review-project a.gth-link').on('click', function(e) {
    /* this is a differnet version of '.gth-link' because I 'bout broke my brain trying to figure out how to get this to appear on the title bar of the my_projects.php page without interfering with the dropdown toggle. */
    var current_loc = window.location.href;
    e.stopPropagation();

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        }
      },
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {

      }
    })
  });

}); /* 122120856 end */



/* navigation links and forms begin */
$(document).ready(function() {
  /* prepare an original edit shared modal for later use */
  var esbuttons  = '<a id="cancelouttahere" class="cancel cancelouttahere">Cancel</a>';
      esbuttons += '<a id="updateshareduser" class="submit updateshareduser">Update</a>';
      esbuttons += '<a id="removeshared" class="delete removeshareduser">Remove</a>';
      esbuttons += '<a id="leaveproject" class="delete leaveproject">Leave project</a>';

  /* Homepage link from: inner_nav.php + my_projects.php + nav.php */
  $(document).on('click', '.gth-link', function(e) {
  /* note: there's nother version of this that handles the link on the my_projects.php page in the title bar of each project. search: $('.review-project a.gth-link').on('click', function(e) */
    var current_loc = window.location.href;
    e.stopPropagation();

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        }
      },
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {

      }
    })
  });

  /* my_projects.php: 'View Projects Page' - from Dropdown navigation + inner_nav.php - DONE */
  $(document).on('click','.vpp-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        }
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {

      }
    })
  });


  // edit_searches.php (Organize search fields: link) - DONE
  $(document).on('click','.osf-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        }
      },
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {

      }
    })
  });


// edit_order.php (Rearrange book marks: link) - DONE
  $(document).on('click','.eo-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        // console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget/new_project.php");
          } else {
            window.location.replace("https://browsergadget.com/new_project.php");
          }
        }
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });

// delete_project.php (Delete project: nav link; not delete project form (see below)) - DONE
  $(document).on('click','.dp-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(), 
      success: function(response) {
        // console.log(response);
        if (response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });


  // share_project.php (Share project: nav link; not actual share project form (see below)) - DONE
  $(document).on('click','.sp-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        // console.log(response);
        if (response == 'ok') {
          // console.log(response);
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          alert('Something went awry. Will you please report this at the bottom of this page through the contact form so I can fix it? Reference ID: 1120230947');
        }
      },
      error: function() {
        alert('Something went awry. Will you please report this at the bottom of this page through the contact form so I can fix it? Reference ID: 1120230948');
      }, 
      complete: function() {

      }
    })
  });


  // edit_project_details.php (from my_projects.php: 'Project name & notes')
  $(document).on('click','.epd-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });

  /* edit_project_details.php 'Cancel' button */
  $(document).on('click','.cancel-deets', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: ({ 'cancel-deets' : 'cancel' }),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          
        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });

  // from edit_project_details.php
  $(document).on('click','.submit-deets', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),

      beforeSend: function(xhr) {
        $('#message').removeClass('red'); // reset class every click
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },
      success: function(response) {
        console.log(response);
        if(response['signal'] == 'ok') {
          // alert('success');
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          $('#message').addClass('red');
          $('#msg-ul').html(response['li']);

          $('#buttons').html('<a class="cancel cancel-deets">Cancel</a><a class="submit submit-deets">Try again</a>');

        }
      },
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {
      }
    })
  });

  // delete_project.php | delete project - form processing
  $("#delete-form").keyup(function(event) {
    if (event.keyCode === 13) {
      $(".delete-my-project").click();
    }
  });
  $('#delete-form').submit(function(e){
      e.preventDefault();
  });

  $(document).on('click','.delete-my-project', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST", 
      data: $(this).closest('form').serialize(),

      beforeSend: function(xhr) {
        $('#message').removeClass('red'); // reset class every click

        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },

      success: function(response) {
        console.log(response);
        if(response['signal'] == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          $('#message').addClass('delete-page');
          $('#message').addClass(response['class']);
          $('#msg-ul').html(response['li']);
          $('#buttons').html('<a class="cancel cancel-deets">Never mind</a><a class="delete delete-my-project">Try again?</a>');
          
        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });


  // 'Cancel' new project
  $(document).on('click','.cancel-new-project', function() { 
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $('#new-project-cancel-btn').serialize(),

      success: function(response) {
        console.log(response);
        if (response == 'ok') {
          // alert('success');
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } else {
          $('#message').addClass('red');
          $('#msg-ul').html('Something went wrong. May be a server thing. You can try again but if it still doesn\'t work you will need to try later');

          $('#buttons').html('<a class="cancel cancel-new-project">Cancel</a><a class="submit submit-deets">Try again</a>');

        }
      },
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {
      }
    })
  });


  /* share_project | share project - form processing - checkboxes see: 1201231459 */
  $("#sharep").keyup(function(event) {
    if (event.keyCode === 13) {
      $(".shareproject").click();
    }
  });
  $('#sharep').submit(function(e){
      e.preventDefault();
  });
  $(document).on('click','.shareproject', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),

      beforeSend: function(xhr) {
        $('#message').removeAttr('class'); // reset class every click
        $('#user-email').removeClass('red');
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },

      success: function(response) {
        console.log(response);
        if(response['signal'] == 'ok') {

          $('#user-email').removeClass('red');
          $('#message').addClass(response['class']);
          $('#msg-ul').html(response['li']);

          if (current_loc.indexOf("localhost") > -1) {
            setTimeout(function() { $('#message').addClass('out'); }, 100);
            setTimeout(function() { 
              $('#msg-ul').html(''); 
              $('#message').removeAttr('class');
            }, 150);
          } else {
            setTimeout(function() { $('#message').addClass('out'); }, 2000);
            setTimeout(function() { 
              $('#msg-ul').html(''); 
              $('#message').removeAttr('class');
            }, 2500);
          }

          $('#user-email').val('');

          $('.edit').removeClass("checked");
          $('.editcheck').removeClass('show');
          $('.share').removeClass("checked");
          $('.sharecheck').removeClass('show');

          $('#buttons').html('<a class="shareproject submit full-width">Add another</a>');
          $('#shared-list').html(response['shared_names']);

        } else {
          $('html, body').animate({ scrollTop: 0 }, 250);
          $('#message').addClass(response['class']);
          $('#msg-ul').html(response['li']);
          $('#user-email').addClass(response['eclass']);
          $('#buttons').html('<a class="shareproject submit full-width">Try again</a>');
          
        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });



  /* 'Edit' link next to each shared user. opens modal with, 'Cancel' & 'Update' buttons from share_project.php */
  /* open and prepare the modal for EDIT user functions */
  $(document).on('click','.editshareduser',function() {

    var content       = document.getElementById("esu-content");    
    var theModal      = document.getElementById("theModal");
    var id            = $(this).data('id');
    var project_id    = $('#'+id+'_project_id').val();
    var esuser        = $('#'+id+'_dsuser').val(); /* deleteshareduser : user id */
    var project_name  = $('#'+id+'_project_name').val();
    var username      = $('#'+id+'_username').val(); /* user's first + last name, not username */
    var edit          = $('#'+id+'_edit').val();
    var share         = $('#'+id+'_share').val();
    var sharersEpriv  = $('#editpriv').val();
    var sharersSpriv  = $('#sharepriv').val();

    $('#smht').html(username);
    $('#delete-shared-user').val(esuser);
    $('#pro-id').val(project_id);

    if ($('#my_username').length !== 0) { 
      $('#username').val(username); 
    } else {
      $('#username').val(username);
    }

    if ($('#my_project_name').length !== 0) { 
      $('#project_name').val(project_name); 
    } else {
      $('#project_name').val(project_name);
    }

    /* these 2 are dependent upon the user's priviliges on this specific project so they do not need to be reset with each modal load. */
    if (sharersEpriv == '0') { $('.choice.edit2').addClass('gone'); }
    if (sharersSpriv == '0') { $('.choice.share2').addClass('gone'); }

    if (edit == '1') { 
      $('#edit2').val('1');
      $('label.edit2').addClass('checked');
      $('.editcheck2').addClass('show');
      $('.choice.edit2').addClass('on');

    } else { 
      $('#edit2').val('0'); 
      $('label.edit2').removeClass('checked');
      $('.editcheck2').removeClass('show');
      $('.choice.edit2').removeClass('on');
    }

    if (share == '1') { 
      $('#share2').val('1'); 
      $('label.share2').addClass('checked');
      $('.sharecheck2').addClass('show');
      $('.choice.share2').addClass('on');

    } else { 
      $('#share2').val('0'); 
      $('label.share2').removeClass('checked');
      $('.sharecheck2').removeClass('show');
      $('.choice.share2').removeClass('on');
    }

    /* prepare modal */
    $('.modal-header').removeClass('red');
    $('#smht').html('Edit Permissions');
    $('.modal-footer').removeClass('red');    
    $('.modal-body').removeClass('green');
    $('#es-msg-ul').html(''); /* reset any messages */
    $('#esForm').removeClass('gone'); /* form id="esModal" */
    $('#remove-box').addClass('gone'); /* hide remove confirmation */
    $('#priv-box').removeClass('gone'); /* show checkboxes */
    $('#esbuttons').html(esbuttons); /* put buttons back */
    $('#removeshared').addClass('gone'); /* hide 'Remove' button */
    $('#leaveproject').addClass('gone'); /* hide 'Leave project' button */
    $('#updateshareduser').removeClass('gone'); /* show 'Update' button */
    $('#shared_key').attr('name', 'edit-shared-user');
    $('#shared_key').val(esuser);

    content.style.display = "block";
    theModal.style.display = "block";

    /* 'Cancel' button inside delete note modal */
    $('.cancelouttahere').click(function() {
      theModal.style.display = "none";
    });

  });

  /* 'Update' button on share_project.php inside Edit modal */
  $(document).on('click','.updateshareduser',function() {
    var current_loc = window.location.href;

    var esuser = $('#shared_key').val();
    var project_id = $('#pro-id').val();
    var edit = $('#edit2').val();
    var share = $('#share2').val();
    var project_name = $('#project_name').val();
    var username = $('#username').val();

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data  : {updateshareduser:'yo', project_id:project_id, project_name:project_name, username:username, esuser:esuser, edit:edit, share:share},
      beforeSend: function(xhr) {
        $('#message').removeAttr('class');
        $('#msg-ul').html('');
        $('#esbuttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },
      success: function(response) {
        // console.log(response);
        if(response['signal'] == 'ok') {

          $('#esForm').addClass('gone');
          $('.modal-body').addClass(response['class']);
          $('#es-msg-ul').html(response['li']);  
          $('#shared-list').html(response['shared_names']);

          if (current_loc.indexOf("localhost") > -1) {
            $('#esu-content').delay(250).slideUp(200);
            $('#theModal').delay(250).fadeOut(200);
          } else {
            $('#esu-content').delay(3000).slideUp(200);
            $('#theModal').delay(3100).fadeOut(200);
          }

        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })

  });

  /* 'Remove' button on share_project.php to the far right of each shared user - under 'Edit' */
  /* open and prepare modal for REMOVE user functions */
  $(document).on('click','.removeshared', function() {
    var current_loc = window.location.href;
    var content       = document.getElementById("esu-content");    
    var theModal      = document.getElementById("theModal");

    var id            = $(this).data('id');
    var project_id    = $('#'+id+'_project_id').val();
    var esuser        = $('#'+id+'_dsuser').val(); /* deleteshareduser : user id */
    var project_name  = $('#'+id+'_project_name').val();
    var username      = $('#'+id+'_username').val(); /* user's first + last name, not really username */

    $('#pro-id').val(project_id);
    $('#username').val(username);
    $('#project_name').val(project_name);
    $('#shared_key').attr('name', 'delete-shared-user');
    $('#shared_key').val(esuser);

    /* prepare modal */
    $('.modal-header').addClass('red');
    $('#smht').html('Remove from Project');
    $('.modal-body').removeClass('green'); /* reset */
    $('.modal-footer').addClass('red');
    $('#es-msg-ul').html(''); /* reset any messages */
    $('#esForm').removeClass('gone');
    $('#esbuttons').html(esbuttons); /* put buttons back */
    $('#updateshareduser').addClass('gone'); /* hide 'Update' button */
    $('#leaveproject').addClass('gone'); /* hide 'Leave project' button */
    $('#removeshared').removeClass('gone'); /* show 'Remove' button */
    $('#priv-box').addClass('gone'); /* hide checkboxes */
    $('#remove-box').removeClass('gone'); /* show remove confirmation */
    $('#remove-box').html('<p>Confirm:<br>Remove: '+username+'<br>From: ' +project_name+'</p>' );

    content.style.display = "block";
    theModal.style.display = "block";

    /* 'Remove' button inside modal on shared_project.php */
    $('.removeshareduser').click(function() {
    /* sends to _form-processing.php on unique $_POST['delete-shared-user'] */
      $.ajax({
        dataType: "JSON",
        url: "_form-processing.php",
        type: "POST",
        data: $(this).closest('form').serialize(),

        beforeSend: function(xhr) {
          $('#esbuttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
        },    
        success: function(response) {
          console.log(response);
          if(response['signal'] == 'ok') {

            $('#esForm').addClass('gone');
            $('#remove-box').addClass('gone');
            $('.modal-body').addClass(response['class']);
            $('#es-msg-ul').html(response['li']);
            $('#shared-list').html(response['shared_names']);

            if (current_loc.indexOf("localhost") > -1) {
              $('#esu-content').delay(250).slideUp(200);
              $('#theModal').delay(250).fadeOut(200);
            } else {
              $('#esu-content').delay(3000).slideUp(200);
              $('#theModal').delay(3100).fadeOut(200);
            }

          } 
        },
        error: function(response) {
          // console.log(response);
        }, 
        complete: function() {
        }
      });
    });

    /* 'Cancel' button inside delete note modal */
    $('.cancelouttahere').click(function() {
      theModal.style.display = "none";
    });
    $('.closefp').click(function() {
      theModal.style.display = "none";
    });

  });


  /* open leave project modal. this is used on shared_project.php and my_projects.php */
  $(document).on('click','.removeme', function() { 
    var current_loc = window.location.href;
    var content       = document.getElementById("esu-content");    
    var theModal      = document.getElementById("theModal");

    var id = $(this).data('id');
    var project_id = $('#'+id+'_project_id').val();
    var project_name = $('#'+id+'_project_name').val();
    /* these are only used on share_project.php page. they're not available on my_projects.php */
    if ($('#'+id+'_editpriv').length !== 0) { var editpriv = $('#'+id+'_editpriv').val(); }
    if ($('#'+id+'_sharepriv').length !== 0) { var sharepriv = $('#'+id+'_sharepriv').val(); }
    if ($('#'+id+'_remove_me').length !== 0) { var esuser = $('#'+id+'_remove_me').val(); }

    $('#pro-id').val(project_id);
    $('#project_name').val(project_name);
    $('#editpriv').val(editpriv);
    $('#sharepriv').val(sharepriv);
    $('#shared_key').attr('name', 'remove_me');
    $('#shared_key').val(esuser);

    /* prepare modal */
    $('.modal-header').addClass('red');
    $('#smht').html('Leave Project');
    $('.modal-body').removeClass('green'); /* reset */
    $('.modal-footer').addClass('red');
    $('#es-msg-ul').html(''); /* reset any messages */
    $('#esForm').removeClass('gone');
    $('#esbuttons').html(esbuttons); /* put buttons back */
    $('#updateshareduser').addClass('gone'); /* hide 'Update' button */
    $('#removeshared').addClass('gone'); /* hide 'Remove' button */
    $('#priv-box').addClass('gone'); /* hide checkboxes */
    $('#remove-box').removeClass('gone'); /* show remove confirmation */
    $('#remove-box').html('<p>Confirm:<br>Quit: ' +project_name+'</p>' );

    content.style.display = "block";
    theModal.style.display = "block";

    $('.leaveproject').click(function() {

      $.ajax({
        dataType: "JSON",
        url: "_form-processing.php",
        type: "POST",
        data: $(this).closest('form').serialize(),

        beforeSend: function(xhr) {
          $('#esbuttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');

        },    
        success: function(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            /* maybe put a session variable in the _form-processing.php to show a 'see ya' msg on the redirect */
            if (current_loc.indexOf("localhost") > -1) {
              window.location.replace("http://localhost/browsergadget");
            } else {
              window.location.replace("https://browsergadget.com");
            }

          }
        },
        error: function(response) {
          // console.log(response);
        }, 
        complete: function() {
        }
      });
    });

    /* 'Cancel' button inside delete note modal */
    $('.cancelouttahere').click(function() {
      theModal.style.display = "none";
    });
    $('.closefp').click(function() {
      theModal.style.display = "none";
    });

  });



  // new_project.php (inner_nav.php & new_project.php: 'Start a new project': link) - DONE
  $(document).on('click','.np-link', function() {
    var current_loc = window.location.href;

    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),
      success: function(response) {
        console.log(response);
        if(response == 'ok') {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        } 
      },
      error: function(response) {
        // console.log(response);
      }, 
      complete: function() {
      }
    })
  });


  /* from new_project.php */
  $("#new-project-form").keyup(function(event) {
    if (event.keyCode === 13) {
      $(".createnewproject").click();
    }
  });
  $('#new-project-form').submit(function(e){
      e.preventDefault();
  });

  $(document).on('click','.createnewproject', function() {
    var current_loc = window.location.href;

    if (document.getElementById('can-opt')) {
      var cancel = 'off';
    } else {
      var cancel = 'on';
    } 


    $.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data: $(this).closest('form').serialize(),

      beforeSend: function(xhr) {
        $('#message').removeClass('red'); // reset class every click
        $('#buttons').html('<div class="verifying"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
      },
      success: function(response) {
        console.log(response);
        if(response['signal'] == 'ok') {
          // alert('success');
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }


        } else {
          $('#message').addClass('red');
          $('#msg-ul').html(response['li']);

          if (cancel =='off') {
            $('#buttons').html('<a class="submit full-width createnewproject">Try again</a>');
          } else {
            $('#buttons').html('<a class="cancel cancel-new-project">Cancel</a><a class="submit createnewproject">Try again</a>');
          }

        }
      },
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {
      }
    })
  });



}); /* navigation links and forms end */



/* allow formatting in project notes */
$(document).on('click','#textbox',function() {
  document.getElementById('textbox').addEventListener('keydown', function(e) {
    if (e.key == 'Tab') {
      e.preventDefault();
      var start = this.selectionStart;
      var end = this.selectionEnd;
      /* set textarea value to: text before caret + tab + text after caret */
      this.value = this.value.substring(0, start) +
        "\t" + this.value.substring(end);

      /* put caret at right position again */
      this.selectionStart =
      this.selectionEnd = start + 1;
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

/* general ajax submit -> put "ajax" in class to call */
$('form.ajax').on('submit', function() {
	var that = $(this),
	url = that.attr('action'),
	type = that.attr('method'),
	data = {};

	that.find('[name]').each(function(index, value) {
		// console.log(value);
		var that = $(this),
			name = that.attr('name'),
			value = that.val();
		data[name] = value;
	});
	$.ajax({
		url: url,
		type: type,
		data: data,
		success: function(response) {
			// console.log(response);
		}
	});
	// console.log(data);
	return false;
});

/* edit_toggle | edit toggle */
$(document).ready(function() {
	$('#edit-content').click(function() {

	var shimOnOff = document.getElementById("static-sort");
	var editOnOff	=	document.getElementById("edit-content");
	/* set variables and toggle css */
	shimOnOff.classList.toggle("edit-shim");
	editOnOff.classList.toggle("active");

	/* get state of checkbox and set it to variable */
	var editValue 	= document.getElementById("et1");

	if (!editValue.checked) {
		editValue = "1";
	} else {
		editValue = "0";
	}

	var userId             = $('#userid').val();
	var currentProject     = $('#curpro').val();
	var ownShare           = $('#ownShare').val();

		$.ajax({
			url 		: 'ajax_edit_toggle.php',
			method 	: 'post',
			data 		: {ownShare:ownShare, editValue:editValue, userId:userId, currentProject:currentProject},
			success : function(response) {
				console.log('update successful');
			}
		});

	var ettoggle 	= $('#et-form input[type="checkbox"]');
	ettoggle.attr('checked', !ettoggle.attr('checked'));
	});
});

// hyperlinks | bookmarks add, update, delete
$(document).ready(function() {

	$(document).on('click','a[data-role=update]',function() {
    // e.preventDefault(); // prevent query from showing up in address bar
    // also prevents any errors from propagating. things just end w/o explanation.
    var id         = $(this).data('id');
    var urlz       = $('#'+id).children('a[data-target=urlz]').attr('href');
    var name       = $('#'+id).children('a[data-target=urlz]').text();
    var rowid      = $('#'+id).children('span[data-target=rowid]').text();
    var idcount    = $('#'+id).children('span[data-target=idcount]').text();
    var theModal   = document.getElementById("theModal");

  	$('#urlz').val(urlz);
  	$('#name').val(name);
  	$('#rowid').val(rowid);
  	$('#idcount').val(idcount);

    theModal.style.display = "block";
	});

  if (document.getElementsByClassName("closefp").length) {
    var closefp = document.getElementsByClassName("closefp")[0];
    closefp.onclick = function() {
      theModal.style.display = "none";
    }
  }
	
	$('.update-bookmark').click(function() {
    var current_loc = window.location.href;
		var id 		= $('#idcount').val();
		var name 	= $('#name').val();
		var urlz 	= $('#urlz').val();
		var rowid 	= $('#rowid').val();
		var cp 		= $('#cp').val();
		var pattern = /^((http|https|ftp):\/\/)/;

		if(!pattern.test(urlz)) {
		    urlz = "http://" + urlz;
		}
		if((name && urlz) == "") {
			theModal.style.display = "none";
			exit();
		}

		$.ajax({
      dataType: "JSON",
      url: "_form-processing.php",
      type: "POST",
      data  : {updatebookmark:'yo', name:name, urlz:urlz, rowid:rowid, cp:cp},
			success : function(response) {
        if (response == 'ok') {
    			$('#'+id).children('a[data-target=urlz]').attr('href',urlz);
      		$('#'+id).children('a[data-target=urlz]').text(name); 

          $('#'+id).closest('li').removeClass('ea');
      		$('#'+id).children('a[data-target=urlz]').removeClass('project-links-empty');
      		$('#'+id).children('a[data-target=urlz]').removeClass('shim');
      		$('#'+id).children('a[data-target=urlz]').addClass('project-links');
        } else {
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }
        }

			},
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {

      }

		});

		theModal.style.display = "none";
	});


	$('.delete-bookmark').click(function() {
    var current_loc = window.location.href;
		var id 		= $('#idcount').val();
		var rowid = $('#rowid').val();
		var cp 		= $('#cp').val();

		$.ajax({
      dataType: "JSON",
			url 	: "_form-processing.php",
			method 	: "POST",
      data  : {deletebookmark:'yo', rowid:rowid, cp:cp},  
			success : function(response) {
        if (response == 'ok') {
    			$('#'+id).children('a[data-target=urlz]').attr('href','');
      		$('#'+id).children('a[data-target=urlz]').text(''); 

          $('#'+id).closest('li').addClass('ea');
      		$('#'+id).children('a[data-target=urlz]').removeClass('project-links');
      		$('#'+id).children('a[data-target=urlz]').addClass('shim');
      		$('#'+id).children('a[data-target=urlz]').addClass('project-links-empty');
        } else {
          // console.log(response);
          if (current_loc.indexOf("localhost") > -1) {
            window.location.replace("http://localhost/browsergadget");
          } else {
            window.location.replace("https://browsergadget.com");
          }    
        }
			},
      error: function(response) {
        console.log(response);
      }, 
      complete: function() {

      }

		});
		theModal.style.display = "none";
	});
});


/* begin Add a note + modify and delete */
$(document).ready(function() {
/* $(document).ready open - 1203121138 */  
  var delMB = $('#delete-modal-body').clone();

  /* open 'Add a note' modal */
  $(document).on('click','a[data-role=notes]',function() {
    var noteModal = document.getElementById('aan-modal');;
    var updatenote = document.getElementById('update-note');
    var modifynote  = document.getElementById('modify-note');
    var limitModal  = document.getElementById('thats-all');
    var cpid = $('#cpid').val();

    var notecount1 = $('[data-role=notecount]').val();
    var notecount2 = $('[data-role=notecountz]').val();
    if (typeof notecount2 != "undefined") {
      notecount2 = notecount2;
    } else {
      notecount2 = notecount1;
    }
    var notecount = notecount2;

    if (notecount == 0) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html("Your first little note. Aww. :-)");
    } else if (notecount == 1) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html('&nbsp;');
    } else if (notecount == 2) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html('&nbsp;');
    } else if (notecount == 3) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html('&nbsp;');
    } else if (notecount == 4) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html('&nbsp;');
    } else if (notecount == 5) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer num5');
      $('#im-watchin').html("You have 5 notes remaining.");
    } else if (notecount == 6) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html('&nbsp;');
    } else if (notecount == 7) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer num8');
      $('#im-watchin').html("This is note #8. There is a 10 note limit.");
    } else if (notecount == 8) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer num9');
      $('#im-watchin').html("This is note #9. You're a note maniac.");
    } else if (notecount == 9) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer num10');
      $('#im-watchin').html("Don't say I didn\'t warn you.");
    } else if (notecount == 10) {
        limitModal.style.display = "block";
        exit();
    }

    $('#aancp').val(cpid);
    $('#thatll-do').removeClass('delete');
    $('.aan-modal-header').removeClass('delete');
    // reset checkboxes in case they were checked on last modal open
    $('input#aanClipboard').prop('checked',false);
    $('input#aanTruncate').prop('checked',false);

    modifynote.style.display = "none";
    updatenote.style.display = "block";
    noteModal.style.display = "block";
  });

  /* 'Close' button from Add a note modal */
  $(document).on('click','[data-role=notesClose]',function() {
    var noteModal = document.getElementById('aan-modal');
    var limitModal  = document.getElementById('thats-all');
    var deleteModal  = document.getElementById('adios');

    $('#thatll-do').removeClass('delete');
    $('#aanName').val('');
    $('#aanUrl').val('');
    $('#aanNote').val('');
    $('input#aanClipboard').prop('checked',false);
    $('input#aanTruncate').prop('checked',false);

    noteModal.style.display = "none";
    limitModal.style.display = "none";
    deleteModal.style.display = "none";

  });

  // 'Add note' button from inside Add a note modal
  $('#update-note').click(function() {
    var noteModal = document.getElementById('aan-modal');

    var sort1 = $('[data-role=maxsort]').val();
    var sort2 = $('[data-role=maxsortz]').val();
    if (typeof sort2 != "undefined") {
      sort2 = sort2;
    } else {
      sort2 = "0";
    }
    var sort = Math.max(sort1, sort2);

    var notecount1 = $('[data-role=notecount]').val();
    var notecount2 = $('[data-role=notecountz]').val();
    if (typeof notecount2 != "undefined") {
      notecount2 = notecount2;
    } else {
      notecount2 = "0";
    }
    var notecount = Math.max(notecount1, notecount2);

    var cp = $('#cp').val();
    var name = $('#aanName').val();
    var urly = $('#aanUrl').val();
    var note = $('#aanNote').val();
    var clipboard = document.getElementById('aanClipboard');
    var truncate = document.getElementById('aanTruncate');
    var pattern = /^((http|https|ftp):\/\/)/;

    if(urly != '') {
      if(!pattern.test(urly)) {
          urly = "http://" + urly;
      }
    } else {
      urly = '';
    }

    if(!clipboard.checked) {
      clipboard = "0";
    } else {
      clipboard = "1";
    }

    if(!truncate.checked) {
      truncate = "0";
    } else {
      truncate = "1";
    }

    $.ajax({
      url     : '_form-processing.php',
      method  : 'post',
      data    : {new_or_update_a_note:'yo', sort:sort, cp:cp, name:name, urly:urly, note:note, clipboard:clipboard, truncate:truncate},
      success : function(response) {
        $('#usersnotes').load('usersnotes.php');
      }
    });

    $('#aanName').val('');
    $('#aanUrl').val('');
    $('#aanNote').val('');
    $('input #aanClipboard').prop('checked',false);
    $('input #aanTruncate').prop('checked',false);

    noteModal.style.display = "none";
  });


  /* open Modify Note Modal - when far-right icon is clicked under 'Add a note' */
  $(document).on('click','a[data-role=modify-note]',function() { 
    var noteModal   = document.getElementById('aan-modal');
    var updatenote = document.getElementById('update-note');
    var modifynote  = document.getElementById('modify-note');

    var ida       = $(this).data('id');
    // added a "z_" to this data-id element so the clipboard data-id would be unique
    var id        = ida.substring(2);
    var cpid      = $('#cpid').val();
    var urln      = $('#z_'+id).find('a[data-target="urln"]').attr('href');
    var noten     = $('#z_'+id).find('[data-target="urln"]').text();
    var notes     = $('#z_'+id).find('[data-target="cb"]').text();
    var clipb     = $('#z_'+id).find('a[data-id="'+id+'"]');
    var namet     = $('#z_'+id).find('[data-target="namet"]').text();
    var trunc     = $('#z_'+id).find('a[data-id="trunc_'+id+'"]');

    if(clipb.length) { // if clipboard exists
      $('input#aanClipboard').prop('checked',true);
      /* clipb = "1"; */
    } else {
      $('input#aanClipboard').prop('checked',false);
      /* clipb = "0"; */
    }

    if(trunc.length) { // if clipboard exists
      $('input#aanTruncate').prop('checked',true);
      /* clipb = "1"; */
    } else {
      $('input#aanTruncate').prop('checked',false);
      /* clipb = "0"; */
    }

    $('.aan-modal-header').removeClass('delete');
    $('#aancp').val(cpid); 
    $('#aanUrl').val(urln);
    $('#aanName').val(namet);
    $('#aanNote').val(notes);
    $('#nid').val(id);
    $('#im-watchin').html('&nbsp;');

    noteModal.style.display = "block";
    updatenote.style.display = "none";
    modifynote.style.display = "block";
  });


  /* 'Modify note' button from inside modify modal */
  $(document).on('click','#modify-note',function() {
 
    var noteModal   = document.getElementById('aan-modal');
    var nid = $('#nid').val();
    var name = $('#aanName').val();
    var urly = $('#aanUrl').val();
    var note = $('#aanNote').val();
    var clipboard = document.getElementById('aanClipboard');
    var truncate = document.getElementById('aanTruncate');
    var pattern = /^((http|https|ftp):\/\/)/;

    if(urly != '') {
      if(!pattern.test(urly)) { 
          urly = "http://" + urly;
      }
    } else {
      urly = '';
    }

    if(!clipboard.checked) {
      clipboard = "0";
    } else {
      clipboard = "1";
    }

    if(!truncate.checked) {
      truncate = "0";
    } else {
      truncate = "1";
    }

    $.ajax({
      url     : '_form-processing.php',
      method  : 'post',
      data    : {modify_a_note:'yo', name:name, urly:urly, note:note, clipboard:clipboard, truncate:truncate, nid:nid},
      success : function(response) {
        $('#usersnotes').load('usersnotes.php');
      }
    });

    $('#aanName').val('');
    $('#aanUrl').val('');
    $('#aanNote').val('');
    $('input #aanClipboard').prop('checked',false);
    
    noteModal.style.display = "none";
  });

  /* open delete note modal - icon to far-right of notes */
  $(document).on('click','a[data-role=deletenote]',function() { 
    var deleteModal   = document.getElementById('adios'); 
    var deleteContent = document.getElementById('adios-content');  
    var noteid = $(this).closest('form').find('[data-role=deletethis]').val();
    var notename = $(this).closest('form').find('[data-role=notename]').val();

    $('#delete-header-msg').html('Delete note');
    $('#delete-modal-body').html(delMB);
    $('#deletenoteid').val(noteid);
    $('#deletenotename').html(notename);

    deleteModal.style.display = "block";
    deleteContent.style.display = "block";

    /* 'Delete' button inside the modal */
    // $(document).on('click','.deleteanote',function() {
    $('.deleteanote').click(function() {
      var deletethis = $('#deletenoteid').val(); 

      $.ajax({
        url     : '_form-processing.php',
        method  : 'post',
        data    : {delete_a_note:'yo', deletethis:deletethis},
        success : function(response) {
          if (response == 'ok') {
            $('#delete-header-msg').html('Gone like the wind');
            $('#delete-modal-body').html('<p>That note is history.</p>');
            $('#adios-content').delay(750).slideUp(200);
            $('#adios').delay(750).fadeOut(200);
            setTimeout(function() { deleteModal.style.display = "none"; }, 950);
            $('#usersnotes').load('usersnotes.php');
          }
        }
      });
    });

    /* 'Cancel' button inside delete note modal */
    $('.canceldeletenote').click(function() {
      var deleteModal   = document.getElementById('adios');
      deleteModal.style.display = "none";

    });

  });
  
});
/* $(document).ready close - 1203121138 */ 


// begin Project note editing from homepage (not Add a note but the actual Project notes)
$(document).ready(function() { // edit icon
  $(document).on('click','i[data-role=edit-portal]',function() {

    if ($('#multi-pass').html().length) {
      /* if this one has already been edited on this screen, the edited version will have been captured and stored in #multi-pass (which treats the breaks differently since js uses \n for a return whereas php uses <br>) so let's use that version. (note: the trim() is redundant here since it's applied before submitting to db in the processing script but wth...) - display on the front end is handled via css -> .sus-notes, .note-reason, #sus-note {white-space: pre-wrap;} in order to preserve spaces *after* the 1st line. */
      var p_notes = $('#note-portal').html().replaceAll('<br>', '\n').replaceAll('<br><br>', '\n\n').trim();
    } else {
      /* otherwise, this is their first pass at editing this so we're dealing with just the php version of line breaks. */
      var p_notes = $('#note-portal').html().replaceAll('<br>\n', '\n').replaceAll('<br>\n<br>', '\n').trim();
    }

    $('#note-portal').addClass('portal-display');
    $('#nei').html('<a data-id="temp-value" data-role="unote" class="sicon"><div class="tooltip"><span class="tooltiptext type">Save Edit</span><i class="far fa-save"></i></div></a> <a data-role="cnote" data-id="tempz-value" class="reason-note rt cicon"><div class="tooltip right"><span class="tooltiptext type">Cancel Edit</span><i class="fas fa-ban"></i></div></a>'); // edit icon replaced with save & cancel

    if ($('.empty-note-portal')[0]) {
      // here we have coming in an empty note field
      $('#note-portal').html('<form id="revise-proj-notes"><textarea id="proj-notes" name="proj-notes" maxlength="1250"></textarea></form>');
    } else {
      $('#note-portal').html('<form id="revise-proj-notes"><textarea id="proj-notes" name="proj-notes" maxlength="1250">'+p_notes+'</textarea></form>');
    }
  
  })

  $(document).on('click','a[data-role=cnote]',function() { // cancel update

    if ($('#multi-pass').html().length) {
      var original_note = $('#multi-pass').html();
    } else if ($('#first-pass').html().length) {
      var original_note = $('#first-pass').html();
    } else {
      var original_note = 'This project has nary a note.';
    }

    $('#note-portal').html(original_note);
    $('#nei').html('<a class="eicon"><div class="tooltip"><span class="tooltiptext">Edit notes</span><i data-role="edit-portal" class="far fa-edit fa-fw"></i></div></a>');
    $('#note-portal').removeClass('portal-display');
  })

  $(document).on('click','a[data-role=unote]',function() { // save (or update note)

    var new_note = $('#proj-notes').val().replaceAll('\n', '<br>').trim();
    // var new_note = $(new_notez).text();
    
    $.ajax({
      dataType: "JSON",
      url: "edit_project_notes.php",
      type: "POST",
      data: $('#revise-proj-notes').serialize(),
      beforeSend: function(xhr) {
        // unnecessarily clutters up the (very quick) update process by putting stuff here
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {
            var str = $('#proj-notes').val();
            if (!$('#proj-notes').val() || !str.replace(/\s/g, '').length) {
              // they submitted an empty textarea
              $('#nei').html('<a class="eicon"><div class="tooltip"><span class="tooltiptext">Edit notes</span><i data-role="edit-portal" class="far fa-edit fa-fw"></i></div></a>');
              $('#note-portal').removeClass('portal-display');
              $('#note-portal').addClass('empty-note-portal');
              $('#note-portal').html('This project has nary a note.');
              $('#first-pass').html('');
              $('#multi-pass').html('');

            } else {
              $('#nei').html('<a class="eicon"><div class="tooltip"><span class="tooltiptext">Edit notes</span><i data-role="edit-portal" class="far fa-edit fa-fw"></i></div></a>');
              $('#note-portal').removeClass('portal-display');
              $('#note-portal').removeClass('empty-note-portal');
              $('#note-portal').html(new_note);
              $('#multi-pass').html(new_note);
            }

          } else {
            $('#note-portal').html('<div class="alert alert-warning ump">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#note-portal').html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {
      }
    }) // end ajax
  }) // end click unote

}); // close document ready for project note editing on homepage

// close all modals on click outside modal
// window.addEventListener("load", function(){
// var modal_aan = document.getElementById("aan-modal");
// var theModal   = document.getElementById("theModal");

//   window.onmousedown = function(event) {
//     if (event.target == modal_aan) {
//       modal_aan.style.display = "none";
//     }
//     if (event.target == theModal) {
//       theModal.style.display = "none";
//     }


//   }
// });