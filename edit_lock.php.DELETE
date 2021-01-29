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

$user_id = $_SESSION['id'];
$current_project = $_GET['id'];

if (is_post_request()) {
	
	if (isset($_POST['edit-lock'])) {
	$row = [];
	$row['user_id']       = $user_id;
	$row['edit-lock']     = $_POST['edit-lock']  ?? ''  ;
	$row['project-id']    = $_POST['project-id']  ?? ''  ;

	$result = lock_project_edit_page($row);

	  if ($result === true) {
	   
	    header('location: edit_content.php?id=' . $row['project-id'] );

	  } else {
	    $errors = $result;
	  }

	}
}
