<?php

function local_testing_delay($x) {
  /* $x = ''; in initialize.php. override delay in each indiviual instance or set globally here */ 
  if ($x === '') { $x = 1; } 
  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep($x); }
}

function show_session_variables() {
  $show   =   '<div style="display: flex; flex-direction: column; width: 100%; padding: 20px;">';
  $show   .=  '<span style="display: flex; text-decoration: underline">Session variables:</span>';
  $show   .=  '<pre>' . var_export($_SESSION, true) . '</pre>';
  $show   .=  '</div>';
  // echo $show;
}

function flash_message() {
  /* timeout function in scripts.js and scripts-visitor.js. CSS in edit_page.scss */
  if (isset($_SESSION['ds'])) {
    echo '<div id="success-wrap"><span class="success-msg">Delete successful!</span></div>';
    unset($_SESSION['ds']); 
  }
  if (isset($_SESSION['leaveproject'])) {
    echo '<div id="success-wrap"><span class="success-msg">Adios amigos!</span></div>';
    unset($_SESSION['leaveproject']); 
  }
}

function preload_config($layout_context) { 
  $no_preload = array('new-project','edit_searches','edit_order','cp-not-found','share_project','my_projects','edit_project_details');

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
	return htmlspecialchars($string ?? '');
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

