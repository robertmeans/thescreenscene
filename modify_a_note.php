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
$this_note = $_GET['id'];

if (is_post_request()) {
	
	if (isset($_POST['modify-note'])) {
	$row = [];
	$row['name']          = $_POST['name']  ?? ''  ;
	$row['url']           = $_POST['url']  ?? ''  ;
	$row['note']          = $_POST['note']  ?? ''  ;
	$row['clipboard']     = $_POST['clipboard']  ?? ''  ;

	$url = $_POST['url']  ?? ''  ; 
	if (($_POST['url']) != '') {
		if (!preg_match('#^[a-zA-Z]+://#', $url)) {
			$url = 'http://' . $url;
		}
	}

	$result = modify_note($row, $this_note, $url);

	  if ($result === true) {
	   
	    header('location:' . WWW_ROOT );

	  } else {
	    $errors = $result;
	  }

	}
}
