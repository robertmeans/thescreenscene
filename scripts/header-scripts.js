// reset all form onload
function clearForms() {
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
}
// decide where to send for dictionary or thesaurus search  
// when Thesaurus is primary search and Dictionary holds the radio button
// OnSubmitForm() - if Thesaurus is primary but Dictionary is checked
function OnSubmitForm() {
  if(document.reference.dictionary.checked == true) 
  {
    document.reference.action ="https://dictionary.com/browse/" + document.getElementById('refsearch').value;
    // used to be (below). not sure why the empty quotes at end...?
    // document.reference.action ="https://dictionary.com/browse/" + document.getElementById('q').value + "";
  } else {
    document.reference.action ="https://www.thesaurus.com/browse/" + document.getElementById('refsearch').value;
    // document.reference.action ="http://www.thesaurus.com/browse/" + document.getElementById('q').value + "";
  }
  return true;
}

// decide where to send for dictionary or thesaurus search  
// when Dictionary is primary search and Thesaurus holds the radio button
// OnSubmitFormSwap() - if Dictionary is primary but Thesaurus is checked
function OnSubmitFormSwap() {
  if(document.reference.thesaurus.checked == true) 
  {
    document.reference.action ="https://www.thesaurus.com/browse/" + document.getElementById('refsearch').value;
    // document.reference.action ="http://www.thesaurus.com/browse/" + document.getElementById('q').value + "";
  } else {
    document.reference.action ="https://dictionary.com/browse/" + document.getElementById('refsearch').value;
    // document.reference.action ="https://dictionary.com/browse/" + document.getElementById('q').value + "";
  }
  return true;
}

// begin bing search
function submitBing() {
  if(document.getElementById("bingImages").checked == true) 
  {
    document.bing.action ="https://www.bing.com/images/search";
  } else if (document.getElementById("bingMaps").checked == true) { 
    document.bing.action ="https://www.bing.com/maps/default.aspx";
  } else {
    document.bing.action ="https://www.bing.com/search";
  }
  return true;
}
// bing on/off images/maps
$(document).ready(function() {
  $(".bchk").change(function() {
      $(".bchk").not(this).prop('checked', false);
  });
});
// end bing search

// begin google search
function submitGoogle() {
  if(document.getElementById("googleImages").checked == true) 
  {
    document.google.action ="https://images.google.com/images";
  } else if (document.getElementById("googleMaps").checked == true) { 
    document.google.action ="https://maps.google.com/maps";
  } else {
    document.google.action ="https://www.google.com/search";
  }
  return true;
}
// google on/off images/maps
$(document).ready(function() {
  $(".gchk").change(function() {
      $(".gchk").not(this).prop('checked', false);
  });
});
// end google search

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