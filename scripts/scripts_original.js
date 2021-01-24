// JavaScript Document

// reset all form onload
function clearForms() {
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
}

// decide where to send for dictionary or thesaurus search  
function OnSubmitForm() {
  if(document.reference.dictionary.checked == true) 
  {
    document.reference.action ="http://dictionary.reference.com/search";
  } else {
    document.reference.action ="http://www.thesaurus.com/browse/" + document.getElementById('q').value;
  }
  return true;
}

// decide where to send for dictionary or thesaurus - swap  
function OnSubmitFormSwap() {
  if(document.reference.thesaurus.checked == true) 
  {
    document.reference.action ="http://www.thesaurus.com/browse/" + document.getElementById('q').value;
  } else {
    document.reference.action ="http://dictionary.reference.com/search";
  }
  return true;
}

// bing search
function submitBing() {
  if(document.getElementById("bingImages").checked == true) 
  {
    document.bing.action ="http://www.bing.com/images/search";
  } else if (document.getElementById("bingMaps").checked == true) { 
  	document.bing.action ="http://www.bing.com/maps/default.aspx";
  } else {
    document.bing.action ="http://www.bing.com/search";
  }
  return true;
}

// google search
function submitGoogle() {
  if(document.getElementById("googleImages").checked == true) 
  {
    document.google.action ="http://images.google.com/images";
  } else if (document.getElementById("googleMaps").checked == true) { 
  	document.google.action ="http://maps.google.com/maps";
  } else {
    document.google.action ="http://www.google.com/search";
  }
  return true;
}
// make sure http:// is on the front of anything submitted by the URL field
// open in new tab and then make sure everything is reset back in 
// original tab. Opera requires the additional complications.
function submitURLFieldForm() {
    var url = document.getElementById('addressfield').value;
    if (!url.match(/^[a-zA-Z]+:\/\//)) {
        url = 'http://' + url;
    }
    window.open(url);
    document.getElementsByName('urlField')[0].reset();
    resetForm();
    return false;
}
window.onload = function() {
    resetForm();
}
function resetForm() {
    var address = document.getElementsByName('address')[0];
    address.focus();
    address.value = "http://";
}

// validate general contact
function validateEmail(emailStr) {
	// first check for empty name field	
if (document.forms[1].name.value == "")
      {
      alert("\nAll fields are required.")
      document.forms[1].name.focus();
	  return false;
}
	// next check for empty email field
if (document.forms[1].email.value == "")
      {
      alert("\nThe e-mail field is blank.\n\nPlease enter your e-mail address.")
      document.forms[1].email.focus()
      return false
}	
	// finally check for empty message field
if (document.forms[1].message.value == "")
      {
      alert("\nSpeak up, I can\'t hear you! You need to leave a message. :)")
      document.forms[1].message.focus();
	  return false;
}
	// if name, email & message exist, check email for correct format
var emailPat=/^(.+)@(.+)$/
var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
var validChars="\[^\\s" + specialChars + "\]"
var quotedUser="(\"[^\"]*\")"
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
var atom=validChars + '+'
var word="(" + atom + "|" + quotedUser + ")"
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
var matchArray=emailStr.match(emailPat)

if (matchArray==null) {
  /* Too many/few @'s or something; basically, this address doesn't
     even fit the general mould of a valid e-mail address. */
	alert("_____________________________\n\nYour e-mail address seems incorrect. Please check the following\n\n1. Did you include the \"@\" and the \" . \" (dot)?\n2. Did you include anything other than a \"@\" & \" . \"?\n\nPlease re-enter your e-mail address.\n_____________________________")
	document.forms[1].email.select();
    document.forms[1].email.focus();
	return false
}
var user=matchArray[1]
var domain=matchArray[2]
if (user.match(userPat)==null) {
    // user is not valid
    alert("_____________________________\n\nThe username does not seem to be valid.\n\nPlease check the following:\n\n1. That you entered your e-mail address correctly.\n\nThank you.\n_____________________________")
    document.forms[1].email.select();
    document.forms[1].email.focus();
    return false
}
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
	  for (var i=1;i<=4;i++) {
	    if (IPArray[i]>255) {
	        alert("_____________________________\n\nThe destination IP address you entered is invalid.\n\nPlease check your e-mail address and make the necessary corrections.\n\nThank you.\n_____________________________")
	        document.forms[1].email.select();
			document.forms[1].email.focus();
		return false
	    }
    }
    return true
}
var domainArray=domain.match(domainPat)
if (domainArray==null) {
	alert("_____________________________\n\nAre you making stuff up now?\n\nThe e-mail address portion of this form is not something to scoff at.\n\nI've been placed here in  your computer to make sure your information is valid. You\nneed to enter your real e-mail address or successfully fake me out to proceed.\n\nThank you.\n_____________________________")
	document.forms[1].email.select();
	document.forms[1].email.focus();
    return false
}
var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 ||
    domArr[domArr.length-1].length>3) {
   // the address must end in a two letter or three letter word.
   alert("_____________________________\n\nYour e-mail address must end in a three-letter domain, or two letter country.\n\n_____________________________")
   document.forms[1].email.select();
   document.forms[1].email.focus();
   return false
}
if (len<2) {
   var errStr="_____________________________\n\nYour e-mail address is missing either a username, a hostname or a domain.\nAn e-mail address should include these three basic components:\n\n1. A username - (e.g., YOURNAME@yahoo.com, YOURNAME@mho.net)\n2. A host - (e.g., yourname@YAHOO.com, yourname@MHO.net)\n3. A domain - (e.g., yourname@yahoo.COM, yourname@mho.NET)\n\nPlease make the necessary corrections and press \"Send\".\n-- Thank you, The unforgiving script validating this e-mail field.\n\n_____________________________"
   alert(errStr)
   document.forms[1].email.select();
   document.forms[1].email.focus();
   return false
}
return true;
}


/* sweet rememberme triangle inside circle all css */
$('input[name="remember_me"]').change(function(){
    if($(this).is(":checked")) {
        $('.aa-rm-in').addClass("checkaroo");
        $('.rm-rm').addClass("hot");
    } else {
        $('.aa-rm-in').removeClass("checkaroo");
        $('.rm-rm').removeClass("hot");
    }
});
