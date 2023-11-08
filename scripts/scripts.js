// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 500);

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
/* used to use this before hoverintent above */
/* keeping for prosperity                    */
/* begin comment ---
$(document).ready(function() {

  // Show then hide ddown menu on hover
  $('.menuitem').hover(function() {
    // need field that had focus before hovering over nav
    // so we can put it back when nav hover is removed
    // this doesn't work... -> var focused = document.activeElement.id;
    
      $(this).children('.dropdown').stop().slideDown(250);
      // $('.nav-ac').focus();
      // alert(focused);

  }, function() {
      $(this).children('.dropdown').slideUp(50);
      // alert(focused);
      // $(focused).focus();

  });
});
--- end comment */

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
$("#contactForm").keyup(function(event) {
  if (event.keyCode === 13) {
    $("#emailBob").click();
  }
});
$('#contactForm').submit(function(e){
    e.preventDefault();
});
$(document).ready(function() {
  $(document).on('click','#emailBob', function() {
    $.ajax({
      dataType: "JSON",
      url: "contact-process.php",
      type: "POST",
      data: $('#contactForm').serialize(),
      beforeSend: function(xhr) {
        $('#msg').removeClass('show');
        $('#emailBob-btn').html('<div class="sending-holup">Sending - one moment...</div>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#msg').removeClass('show');
            $('#contactForm').html('<div class="success">Your message was sent successfully.</div>');
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


$(document).ready(function() { // 122120856 start
// Dictionary or Thesaurus on edit_searches.php
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

// checkbox edit/share selections
	$('input:checkbox.edit').change(function(){
	    if($(this).is(":checked")) {
	        $('label.edit').addClass("checked");
	        $('.echeckon').addClass("showcheck");
	    } else {
	        $('label.edit').removeClass("checked");
	        $('.echeckon').removeClass("showcheck");
	    }
	});
	$('input:checkbox.share').change(function(){
	    if($(this).is(":checked")) {
	        $('label.share').addClass("checked");
	        $('.scheckon').addClass("showcheck");
	    } else {
	        $('label.share').removeClass("checked");
	        $('.scheckon').removeClass("showcheck");
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

	$('.project-details').hide();
  	$('.review-project').on('click', function(e) {
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
}); // // 122120856 end

// allow formatting in project notes
$(document).on('click','#textbox',function() {
  document.getElementById('textbox').addEventListener('keydown', function(e) {
    if (e.key == 'Tab') {
      e.preventDefault();
      var start = this.selectionStart;
      var end = this.selectionEnd;
      // set textarea value to: text before caret + tab + text after caret
      this.value = this.value.substring(0, start) +
        "\t" + this.value.substring(end);

      // put caret at right position again
      this.selectionStart =
      this.selectionEnd = start + 1;
    }
  });
})

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

// general ajax submit -> put "ajax" in class to call
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

// edit_toggle | edit toggle
$(document).ready(function() {
	$('#edit-content').click(function() {

	var shimOnOff = document.getElementById("static-sort");
	var editOnOff	=	document.getElementById("edit-content");
	// set variables and toggle css
	shimOnOff.classList.toggle("edit-shim");
	editOnOff.classList.toggle("active");

	// get state of checkbox and set it to variable
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
  }
	closefp.onclick = function() {
	  theModal.style.display = "none";
	}

	$('#update').click(function() {
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
			url 	: 'update_hyperlink.php',
			method 	: 'post',
			data 	: {name:name, urlz:urlz, rowid:rowid, cp:cp},
			success : function(response) {
			$('#'+id).children('a[data-target=urlz]').attr('href',urlz);
  		$('#'+id).children('a[data-target=urlz]').text(name); 

      $('#'+id).closest('li').removeClass('ea');
  		$('#'+id).children('a[data-target=urlz]').removeClass('project-links-empty');
  		$('#'+id).children('a[data-target=urlz]').removeClass('shim');
  		$('#'+id).children('a[data-target=urlz]').addClass('project-links');
			}
		});

		theModal.style.display = "none";
	});

	$('#delete').click(function() {
		var id 		= $('#idcount').val();
		var rowid 	= $('#rowid').val();
		var cp 		= $('#cp').val();

		$.ajax({
			url 	: 'delete_hyperlink.php',
			method 	: 'post',
			data 	: {rowid:rowid, cp:cp},
			success : function(response) {
			$('#'+id).children('a[data-target=urlz]').attr('href','');
  		$('#'+id).children('a[data-target=urlz]').text(''); 

      $('#'+id).closest('li').addClass('ea');
  		$('#'+id).children('a[data-target=urlz]').removeClass('project-links');
  		$('#'+id).children('a[data-target=urlz]').addClass('shim');
  		$('#'+id).children('a[data-target=urlz]').addClass('project-links-empty');
			}
		});
		theModal.style.display = "none";
	});
});

// Add a note | add, update, delete
$(document).ready(function() {
    var originalHeader = document.getElementById('header-msg');
    var originalBody = document.getElementById('thatll-do');
    var originalFooter = document.getElementById('im-watchin');

  $(document).on('click','a[data-role=notes]',function() {
    var noteModal = document.getElementById('aan-modal');
    var updatenote = document.getElementById('update-note');
    var modifynote  = document.getElementById('modify-note');
    var limitModal  = document.getElementById('thats-all');

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
      $('#im-watchin').html("&nbsp;");
    } else if (notecount == 2) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html("&nbsp;");
    } else if (notecount == 3) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html("&nbsp;");
    } else if (notecount == 4) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html("&nbsp;");
    } else if (notecount == 5) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer num5');
      $('#im-watchin').html("You have 5 notes remaining.");
    } else if (notecount == 6) {
      $('.aan-modal-footer').attr('class', 'aan-modal-footer');
      $('#im-watchin').html("&nbsp;");
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

    // reset checkboxes in case they were checked on last modal open
    $('input#aanClipboard').prop('checked',false);
    $('input#aanTruncate').prop('checked',false);

    modifynote.style.display = "none";
    updatenote.style.display = "block";
    noteModal.style.display = "block";
  });

  $(document).on('click','[data-role=notesClose]',function() {
    var noteModal = document.getElementById('aan-modal');
    var limitModal  = document.getElementById('thats-all');

    $('#aanName').val('');
    $('#aanUrl').val('');
    $('#aanNote').val('');
    $('input#aanClipboard').prop('checked',false);
    $('input#aanTruncate').prop('checked',false);

    noteModal.style.display = "none";
    limitModal.style.display = "none";

  });

  $('#update-note').click(function() { // add new note button (this is NOT the modal)
    var noteModal = document.getElementById('aan-modal');
    var updatenote = document.getElementById('update-note');
    var modifynote  = document.getElementById('modify-note');

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
    var uid = $('#uid').val();
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
      url     : 'note_manager.php',
      method  : 'post',
      data    : {sort:sort, cp:cp, uid:uid, name:name, urly:urly, note:note, clipboard:clipboard, truncate:truncate},
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


  $(document).on('click','a[data-role=deletenote]',function() { 
    var deletethis = $(this).closest('form').find('[data-role=deletethis]').val();
    var notename = $(this).closest('form').find('[data-role=notename]').val();
    
    if(confirm("Delete: \"" + notename + "\" ?")) {
      $.ajax({
        url     : 'note_manager.php',
        method  : 'post',
        data    : {deletethis:deletethis},
        success : function(response) {
          $('#usersnotes').load('usersnotes.php');
        }
      });
    }
  });

 $(document).on('click','a[data-role=modify-note]',function() { // this is the Modify Note Modal
  var ida       = $(this).data('id');
  // added a "z_" to this data-id element so the clipboard data-id would be unique
  var id        = ida.substring(2);
  var urln      = $('#z_'+id).find('a[data-target="urln"]').attr('href');
  var noten     = $('#z_'+id).find('[data-target="urln"]').text();
  var notes     = $('#z_'+id).find('[data-target="cb"]').text();
  var clipb     = $('#z_'+id).find('a[data-id="'+id+'"]');
  var trunc     = $('#z_'+id).find('a[data-id="trunc_'+id+'"]');


  if(clipb.length) { // if clipboard exists
    $('input#aanClipboard').prop('checked',true);
    // clipb = "1";
  } else {
    $('input#aanClipboard').prop('checked',false);
    // clipb = "0";
  }

  if(trunc.length) { // if clipboard exists
    $('input#aanTruncate').prop('checked',true);
    // clipb = "1";
  } else {
    $('input#aanTruncate').prop('checked',false);
    // clipb = "0";
  }

  $('#aanUrl').val(urln);
  $('#aanName').val(noten);
  $('#aanNote').val(notes);
  $('#nid').val(id);

  $('#im-watchin').html("&nbsp;");

  var noteModal   = document.getElementById('aan-modal');
  var updatenote = document.getElementById('update-note');
  var modifynote  = document.getElementById('modify-note');

  // alert(id);
  noteModal.style.display = "block";
  updatenote.style.display = "none";
  modifynote.style.display = "block";
 });

 $('#modify-note').click(function() { // modify note button - NOT the modal
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
      url     : 'note_manager.php',
      method  : 'post',
      data    : {name:name, urly:urly, note:note, clipboard:clipboard, truncate:truncate, nid:nid},
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
});

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