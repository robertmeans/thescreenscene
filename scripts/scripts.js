// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 500);


// add a note | add-a-note
var modal_aan = document.getElementById("aan-modal");
var btn_aan = document.getElementById("add-note");
var span_aan = document.getElementsByClassName("aan-close")[0];
var a_aan = document.getElementsByClassName("cancel-close")[0];

window.addEventListener("load", function(){
	btn_aan.onclick = function() {
	  modal_aan.style.display = "block";
	}
	span_aan.onclick = function() {
	  modal_aan.style.display = "none";
	}
	a_aan.onclick = function() {
	  modal_aan.style.display = "none";
	}
	window.onmousedown = function(event) {
	  if (event.target == modal_aan) {
	    modal_aan.style.display = "none";
	  }
	}
});
// end add a note

// modify a note | modify-a-note
// **** Whoever is at the bottom with the window.addEventListener function is the only one that is 
// letting a mouse click outside the modal close it. maybe put all the onmousedown events into last function?
if(null!==document.getElementById("01_modify-modal"))var note_01=document.getElementById("01_modify-modal");if(null!==document.getElementById("02_modify-modal"))var note_02=document.getElementById("02_modify-modal");if(null!==document.getElementById("03_modify-modal"))var note_03=document.getElementById("03_modify-modal");if(null!==document.getElementById("04_modify-modal"))var note_04=document.getElementById("04_modify-modal");if(null!==document.getElementById("05_modify-modal"))var note_05=document.getElementById("05_modify-modal");if(null!==document.getElementById("06_modify-modal"))var note_06=document.getElementById("06_modify-modal");if(null!==document.getElementById("07_modify-modal"))var note_07=document.getElementById("07_modify-modal");if(null!==document.getElementById("08_modify-modal"))var note_08=document.getElementById("08_modify-modal");if(null!==document.getElementById("09_modify-modal"))var note_09=document.getElementById("09_modify-modal");if(null!==document.getElementById("10_modify-modal"))var note_10=document.getElementById("10_modify-modal");if(null!==document.getElementById("11_modify-modal"))var note_11=document.getElementById("11_modify-modal");if(null!==document.getElementById("12_modify-modal"))var note_12=document.getElementById("12_modify-modal");if(null!==document.getElementById("13_modify-modal"))var note_13=document.getElementById("13_modify-modal");if(null!==document.getElementById("14_modify-modal"))var note_14=document.getElementById("14_modify-modal");if(null!==document.getElementById("15_modify-modal"))var note_15=document.getElementById("15_modify-modal");if(null!==document.getElementById("16_modify-modal"))var note_16=document.getElementById("16_modify-modal");if(null!==document.getElementById("17_modify-modal"))var note_17=document.getElementById("17_modify-modal");if(null!==document.getElementById("18_modify-modal"))var note_18=document.getElementById("18_modify-modal");if(null!==document.getElementById("19_modify-modal"))var note_19=document.getElementById("19_modify-modal");if(null!==document.getElementById("20_modify-modal"))var note_20=document.getElementById("20_modify-modal");if(null!==document.getElementById("01_modify-note"))var note_btn_01=document.getElementById("01_modify-note");if(null!==document.getElementById("02_modify-note"))var note_btn_02=document.getElementById("02_modify-note");if(null!==document.getElementById("03_modify-note"))var note_btn_03=document.getElementById("03_modify-note");if(null!==document.getElementById("04_modify-note"))var note_btn_04=document.getElementById("04_modify-note");if(null!==document.getElementById("05_modify-note"))var note_btn_05=document.getElementById("05_modify-note");if(null!==document.getElementById("06_modify-note"))var note_btn_06=document.getElementById("06_modify-note");if(null!==document.getElementById("07_modify-note"))var note_btn_07=document.getElementById("07_modify-note");if(null!==document.getElementById("08_modify-note"))var note_btn_08=document.getElementById("08_modify-note");if(null!==document.getElementById("09_modify-note"))var note_btn_09=document.getElementById("09_modify-note");if(null!==document.getElementById("10_modify-note"))var note_btn_10=document.getElementById("10_modify-note");if(null!==document.getElementById("11_modify-note"))var note_btn_11=document.getElementById("11_modify-note");if(null!==document.getElementById("12_modify-note"))var note_btn_12=document.getElementById("12_modify-note");if(null!==document.getElementById("13_modify-note"))var note_btn_13=document.getElementById("13_modify-note");if(null!==document.getElementById("14_modify-note"))var note_btn_14=document.getElementById("14_modify-note");if(null!==document.getElementById("15_modify-note"))var note_btn_15=document.getElementById("15_modify-note");if(null!==document.getElementById("16_modify-note"))var note_btn_16=document.getElementById("16_modify-note");if(null!==document.getElementById("17_modify-note"))var note_btn_17=document.getElementById("17_modify-note");if(null!==document.getElementById("18_modify-note"))var note_btn_18=document.getElementById("18_modify-note");if(null!==document.getElementById("19_modify-note"))var note_btn_19=document.getElementById("19_modify-note");if(null!==document.getElementById("20_modify-note"))var note_btn_20=document.getElementById("20_modify-note");var spanz=document.getElementsByClassName("closer");window.addEventListener("load",function(){null!=note_01&&(note_btn_01.onclick=function(){note_01.style.display="block"}),null!=note_02&&(note_btn_02.onclick=function(){note_02.style.display="block"}),null!=note_03&&(note_btn_03.onclick=function(){note_03.style.display="block"}),null!=note_04&&(note_btn_04.onclick=function(){note_04.style.display="block"}),null!=note_05&&(note_btn_05.onclick=function(){note_05.style.display="block"}),null!=note_06&&(note_btn_06.onclick=function(){note_06.style.display="block"}),null!=note_07&&(note_btn_07.onclick=function(){note_07.style.display="block"}),null!=note_08&&(note_btn_08.onclick=function(){note_08.style.display="block"}),null!=note_09&&(note_btn_09.onclick=function(){note_09.style.display="block"}),null!=note_10&&(note_btn_10.onclick=function(){note_10.style.display="block"}),null!=note_11&&(note_btn_11.onclick=function(){note_11.style.display="block"}),null!=note_12&&(note_btn_12.onclick=function(){note_12.style.display="block"}),null!=note_13&&(note_btn_13.onclick=function(){note_13.style.display="block"}),null!=note_14&&(note_btn_14.onclick=function(){note_14.style.display="block"}),null!=note_15&&(note_btn_15.onclick=function(){note_15.style.display="block"}),null!=note_16&&(note_btn_16.onclick=function(){note_16.style.display="block"}),null!=note_17&&(note_btn_17.onclick=function(){note_17.style.display="block"}),null!=note_18&&(note_btn_18.onclick=function(){note_18.style.display="block"}),null!=note_19&&(note_btn_19.onclick=function(){note_19.style.display="block"}),null!=note_20&&(note_btn_20.onclick=function(){note_20.style.display="block"});for(var e=0;e<spanz.length;e++)spanz[e].onclick=function(){null!=note_01&&(note_01.style.display="none"),null!=note_02&&(note_02.style.display="none"),null!=note_03&&(note_03.style.display="none"),null!=note_04&&(note_04.style.display="none"),null!=note_05&&(note_05.style.display="none"),null!=note_06&&(note_06.style.display="none"),null!=note_07&&(note_07.style.display="none"),null!=note_08&&(note_08.style.display="none"),null!=note_09&&(note_09.style.display="none"),null!=note_10&&(note_10.style.display="none"),null!=note_11&&(note_11.style.display="none"),null!=note_12&&(note_12.style.display="none"),null!=note_13&&(note_13.style.display="none"),null!=note_14&&(note_14.style.display="none"),null!=note_15&&(note_15.style.display="none"),null!=note_16&&(note_16.style.display="none"),null!=note_17&&(note_17.style.display="none"),null!=note_18&&(note_18.style.display="none"),null!=note_19&&(note_19.style.display="none"),null!=note_20&&(note_20.style.display="none")};window.onmousedown=function(e){e.target!=note_01&&e.target!=note_02&&e.target!=note_03&&e.target!=note_04&&e.target!=note_05&&e.target!=note_06&&e.target!=note_07&&e.target!=note_08&&e.target!=note_09&&e.target!=note_10&&e.target!=note_11&&e.target!=note_12&&e.target!=note_13&&e.target!=note_14&&e.target!=note_15&&e.target!=note_16&&e.target!=note_17&&e.target!=note_18&&e.target!=note_19&&e.target!=note_20||(note_01.style.display="none",note_02.style.display="none",note_03.style.display="none",note_04.style.display="none",note_05.style.display="none",note_06.style.display="none",note_07.style.display="none",note_08.style.display="none",note_09.style.display="none",note_10.style.display="none",note_11.style.display="none",note_12.style.display="none",note_13.style.display="none",note_14.style.display="none",note_15.style.display="none",note_16.style.display="none",note_17.style.display="none",note_18.style.display="none",note_19.style.display="none",note_20.style.display="none")}});
// end modify a note

// add a note | add-a-note LIMIT REACHED
var note_limit = document.getElementById("thats-all");
var yer_done = document.getElementById("note-limit");
var zipit = document.getElementsByClassName("shutit")[0];

window.addEventListener("load", function(){
	yer_done.onclick = function() {
	  note_limit.style.display = "block";
	}
	zipit.onclick = function() {
	  note_limit.style.display = "none";
	}
	window.onclick = function(event) {
	  if (event.target == note_limit) {
	    note_limit.style.display = "none";
	  }
	}
});
// end add a note LIMIT REACHED




// add a note - copy to clipboard
var but = document.getElementsByClassName('btn');
var txt = document.getElementsByClassName('input-copy');
for (var x = 0; x < but.length; x++) {
  (function(x) {
    but[x].addEventListener("click", function() {
      copyToClipboardMsg(txt[x], but[x]);
    }, false);
  })(x);
}

function copyToClipboardMsg(elem, msgElem) {
    var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "<i class=\"fas fa-exclamation-triangle fa-fw\"></i>";
    } else {
        msg = "<i class=\"fas fa-check fa-fw\"></i>";
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    // msgElem.style.background = "#40d046";
    // msgElem.style.color = "#fff";
    // msgElem.style.border = "1px solid #fff";

    setTimeout(function() {
        msgElem.innerHTML = "<i class=\"far fa-copy fa-fw\"></i>";
        // msgElem.style.background = "#fff";
        // msgElem.style.color = "rgba(255,255,255,0.8)";
        // msgElem.style.border = "1px solid #757575";

    }, 750);
}


function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");

    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;

}

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
		positions.push([$(this).attr('id'), $(this).attr('sort')]);
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
}); // // 122120856 end

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

	var userId 					= $('#userid').val();
	var currentProject 	= $('#curpro').val();
	var ownShare				= $('#ownShare').val();

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












$(document).ready(function() {
	$(document).on('click','a[data-role=update]',function() {
		var id = $(this).data('id');
		var urlz = $('#'+id).children('a[data-target=urlz]').attr('href');
	  var name = $('#'+id).children('a[data-target=urlz]').text();
	  var rowid = $('#'+id).children('span[data-target=rowid]').text();
	  var idcount = $('#'+id).children('span[data-target=idcount]').text();
		var theModal = document.getElementById("theModal");

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
		var id 			= $('#idcount').val();
		var name 		= $('#name').val();
		var urlz 		= $('#urlz').val();
		var rowid 	= $('#rowid').val();
		var cp 			= $('#cp').val();
		var pattern = /^((http|https|ftp):\/\/)/;

		if(!pattern.test(urlz)) {
		    urlz = "http://" + urlz;
		}
		if((name && urlz) == "") {
			theModal.style.display = "none";
			exit();
		}

		$.ajax({
			url 		: 'update_hyperlink.php',
			method 	: 'post',
			data 		: {name:name, urlz:urlz, rowid:rowid, cp:cp},
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
		var id 			= $('#idcount').val();
		var rowid 	= $('#rowid').val();
		var cp 			= $('#cp').val();

		$.ajax({
			url 		: 'delete_hyperlink.php',
			method 	: 'post',
			data 		: {rowid:rowid, cp:cp},
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