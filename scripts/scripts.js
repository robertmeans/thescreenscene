// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 500);


// add a note | add-a-note
// var modal_aan = document.getElementById("aan-modal");
// var btn_aan = document.getElementById("add-note");
// var span_aan = document.getElementsByClassName("aan-close")[0];
// var a_aan = document.getElementsByClassName("cancel-close")[0];


// end add a note


// add a note | add-a-note LIMIT REACHED
// var note_limit = document.getElementById("thats-all");
// var yer_done = document.getElementById("note-limit");
// var zipit = document.getElementsByClassName("shutit")[0];

// window.addEventListener("load", function(){
// 	yer_done.onclick = function() {
// 	  note_limit.style.display = "block";
// 	}
// 	zipit.onclick = function() {
// 	  note_limit.style.display = "none";
// 	}
// 	window.onclick = function(event) {
// 	  if (event.target == note_limit) {
// 	    note_limit.style.display = "none";
// 	  }
// 	}
// });
// end add a note LIMIT REACHED


// clipboard
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
$('a.static').click(function(e)
{
   e.preventDefault();
});


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


/* 	edit_order.php -> only owner can move hyperlinks so
	there's no shared_with version of this 	*/
// sort hyperlinks - start
$(document).ready(function() {
  $( "#sortable" ).sortable({
	update: function (event, ui) {

		save_order();
		//console.log('hello there');
	 }	
  });
});

function save_order() {
var reorder = new Array();
  $('ul#sortable li').each(function() {
    reorder.push($(this).attr("id"));
    // console.log(reorder);
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
//https://www.youtube.com/watch?v=V1nYMDoSCXY&ab_channel=CodingPassiveIncome
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

	// keep things same height and stop bouncing
	// $('.tab-content').each(function() {
	// $height = $(this).height();
	// $(this).css('height', $height);
	// // $(this).hide();
	// });

	$('.tabs .tab-links input').on('click', function(e)  {
    var currentAttrValue = $(this).attr('name');
    var addthis = "#";
    var thesetwo = addthis.concat(currentAttrValue);
    // ^^ had to add these two together in JS instead of on the html page
    // because the # was interfering with the Ajax form submission.
    // holy cow this took a long time to figure out!

    // $('.tabs ' + thesetwo).show().siblings().hide();
    $('.tabs ' + thesetwo).slideDown(250).siblings().slideUp(250);

    $(this).closest('li').addClass('active').siblings().removeClass('active');

    // e.preventDefault();
	}); // end tab switch

	$('.project-details').hide();
  	// $('.review-project').click(function() {
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





$(document).on('click','#textbox',function() {
  // allow formatting in project notes
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


$(document).ready(function() {
// edit_toggle | edit toggle
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

// hyperlink | bookmarks add, update, delete
$(document).ready(function() {

	$(document).on('click','a[data-role=update]',function() {
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

	var closefp = document.getElementsByClassName("closefp")[0];
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

    if (notecount == 5) {
      $('#im-watchin').html("You have 5 notes remaining.");
    } else if (notecount == 6) {
      $('#im-watchin').html("&nbsp;");
    } else if (notecount == 7) {
      $('#im-watchin').html("This is note #8. There is a 10 note limit.");
    } else if (notecount == 8) {
      $('#im-watchin').html("This is note #9. You're a note maniac.");
    } else if (notecount == 9) {
      $('#im-watchin').html("Don't say I didn\'t warn you.");
    } else if (notecount == 10) {
        limitModal.style.display = "block";
        exit();
    } else {

    }

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
    $('input[type=checkbox]').prop('checked',false);

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

    $.ajax({
      url     : 'note_manager.php',
      method  : 'post',
      data    : {sort:sort, cp:cp, uid:uid, name:name, urly:urly, note:note, clipboard:clipboard},
      success : function(response) {
        $('#usersnotes').load('usersnotes.php');
      }

    });

    $('#aanName').val('');
    $('#aanUrl').val('');
    $('#aanNote').val('');
    $('input[type=checkbox]').prop('checked',false);

    // modifynote.style.display = "none";
    // updatenote.style.display = "none";
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


 $(document).on('click','a[data-role=modify-note]',function() { // this is the Modify Modal
  var ida       = $(this).data('id');
  // added a "z_" to this data-id element so the clipboard data-id would be unique
  var id        = ida.substring(2);
  var urln      = $('#z_'+id).find('a[data-target="urln"]').attr('href');
  var noten     = $('#z_'+id).find('[data-target="urln"]').text();
  var notes     = $('#z_'+id).find('[data-target="cb"]').text();
  var clipb     = $('#z_'+id).find('a[data-id="'+id+'"]');

  if(clipb.length) { // if clipboard exists
    $('input[type=checkbox]').prop('checked',true);
    // clipb = "1";
  } else {
    $('input[type=checkbox]').prop('checked',false);
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

    $.ajax({
      url     : 'note_manager.php',
      method  : 'post',
      data    : {name:name, urly:urly, note:note, clipboard:clipboard, nid:nid},
      success : function(response) {
        $('#usersnotes').load('usersnotes.php');
      }

    });

    $('#aanName').val('');
    $('#aanUrl').val('');
    $('#aanNote').val('');
    $('input[type=checkbox]').prop('checked',false);
    
    noteModal.style.display = "none";
 });

});

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