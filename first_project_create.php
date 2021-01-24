<?php

require_once 'config/initialize.php';

if (!isset($_SESSION['id'])) {
	header('location: index.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: index.php');
	exit();
}

if (is_post_request()) {

$row = [];
$row['user_id']       = $_SESSION['id'];
$row['project_name']  = $_POST['project_name']  ?? '' ;
$row['project_notes'] = $_POST['project_notes']  ?? ''  ;

$result = create_new_project($row);

  if ($result === true) {
    $new_id = mysqli_insert_id($db);
    // grab new project id and set it in var $new_id

    update_users_current_project($new_id, $user_id);
    // update users table with new (current_project) id

    $_SESSION['current_project'] = $new_id;
    header('location:' . WWW_ROOT );


  } else {
    $errors = $result;
  }
}