<?php 

require_once 'config/initialize.php';

// off for local testing

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

// grab meeting id in order to edit this meeting
// if it's not there -> go back to index.php
if (!isset($_GET['id'])) {
      header('location: index.php');
}

// $id = $_GET['id'];
$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];


if (is_post_request()) {
  if (isset($_POST['tab1'])) {
    $page_number = $_POST['page_number'] ?? '';

    $result = update_page_number_shared_with($user_id, $current_project, $page_number);

      if($result === true) {
        header('location: edit_content.php?id=' . $current_project);
    
      } else { 
        $errors = $result;
      }
  }
  if (isset($_POST['tab2'])) {
    $page_number = $_POST['page_number'] ?? '';

    $result = update_page_number_shared_with($user_id, $current_project, $page_number);

      if($result === true) {
        header('location: edit_content.php?id=' . $current_project);

    
      } else { 
        $errors = $result;
      }
  }
   if (isset($_POST['tab3'])) {
    $page_number = $_POST['page_number'] ?? '';

    $result = update_page_number_shared_with(user_$id, $current_project, $page_number);

      if($result === true) {
        header('location: edit_content.php?id=' . $current_project);

    
      } else { 
        $errors = $result;
      }
  } 

}