<?php

require_once 'config/initialize.php';

if (is_post_request()) {

  global $db;

  $id = $_SESSION['id']; 
  $current_project = $_SESSION['current_project'];

  $count2  = $_POST['rowid'];
  $cp     = $_POST['cp'];
  // delete only happens in projects table so no need for shared_with version

  $result = delete_bookmark($id, $current_project, $count2, $cp); 

  if ($result === 'pass') {
    $signal = 'ok';
    echo json_encode($signal);
  } else {
    $_SESSION['got-kicked-out'] = 'nossir';
    $signal = 'no';
    echo json_encode($signal);
  }

}

