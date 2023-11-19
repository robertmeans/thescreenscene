<?php

function preload_config($layout_context) { 
  $no_preload = array('new-project', 'edit_searches', 'edit_order');

  if (!isset($_SESSION['color'])) {
    if (in_array($layout_context, $no_preload)) {
      echo '<div class="preload dark"></div>';
    } else {
      echo '<div class="preload dark"><img src="_images/preloadflow.gif"></div>';
    }
  } else {
    if ($_SESSION['color'] == '1') {
      if (in_array($layout_context, $no_preload)) { 
        echo '<div class="preload dark"></div>';
      } else {
        echo '<div class="preload dark"><img src="_images/preloadflow.gif"></div>';
      }  
    } else if ($_SESSION['color'] == '2') {
      if (in_array($layout_context, $no_preload)) { 
        echo '<div class="preload spring"></div>';
      } else {
        echo '<div class="preload spring"><img src="_images/preloadspring.gif"></div>';
      }     
    } else if ($_SESSION['color'] == '3') {
      if (in_array($layout_context, $no_preload)) { 
        echo '<div class="preload light"></div>';
      } else {
        echo '<div class="preload light"><div class="loader"><span></span><span></span><span></span><span></span></div></div>';
      }      
    }
  } 
}

function u($string="") {
	return urlencode($string);
}

function h($string="") {
	return htmlspecialchars($string);
}

function is_post_request() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  	}
  	return $output;
	}
