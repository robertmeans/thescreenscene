<?php
require_once 'config/initialize.php';

if (is_post_request()) {

  // go to homepage
  if(isset($_POST['go_to_homepage'])) {
    $id = $_POST['user_id'];
    $current_project = $_POST['current_project'];

    $result = update_current_project($id, $current_project);

    if ($result === true) {
      $_SESSION['current_project'] = $current_project;
      $signal = 'ok';
      echo json_encode($signal);
    } 
  }


  // Organize search fields - for nav/inner_nav.php
  if(isset($_POST['organizesearchfields'])) {

    if (isset($_POST['current_project'])) {
      $id = $_SESSION['id']               ;
      $current_project = $_POST['current_project'];
      $result = update_current_project($id, $current_project);

      if ($result === true) {
        $_SESSION['current_project'] = $current_project;
        $_SESSION['organize'] = 'anothern';

        $signal = 'ok';
        echo json_encode($signal); 
      }

    } else {
      $_SESSION['organize'] = 'anothern';
      $signal = 'ok';
      echo json_encode($signal);
    } 
  } 












} // end if (is_post_request())