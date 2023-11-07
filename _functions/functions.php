<?php

function preload_config($layout_context) {
  /* including argument in case I ever want to work with it in the future   */
  /* this way I'm forced to make sure $layout_context exists on every page  */
  /* this function is included.                                             */
  if (!isset($_SESSION['color'])) {
    echo '<div class="preload dark"><img src="_images/preloadflow.gif"></div>';
  } else {
    if ($_SESSION['color'] == '1') {
      echo '<div class="preload dark"><img src="_images/preloadflow.gif"></div>';
    } else if ($_SESSION['color'] == '2') {
      echo '<div class="preload spring"><img src="_images/preloadspring.gif"></div>';
    } else if ($_SESSION['color'] == '3') {
      echo '<div class="preload light"><div class="loader"><span></span><span></span><span></span><span></span></div></div>';
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
