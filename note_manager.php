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
$current_project = $_SESSION['current_project'];

if (is_post_request()) {
	
	if (isset($_POST['uid'])) {

	$sort     	   	= $_POST['sort']  ?? ''  ;
	$cp    					= $_POST['cp']  ?? ''	;
	$uid          	= $_POST['uid']  ?? ''  ;
	$name           = $_POST['name']  ?? ''  ;
	$urly         	= $_POST['urly']  ?? ''  ;
	$note          	= $_POST['note']  ?? ''  ;
	$clipboard     	= $_POST['clipboard']  ?? ''  ;
	

  global $db;

  $sql = "INSERT INTO notes ";
  $sql .= "(user_id, project_id, name, url, note, sort, clipboard) ";
  $sql .= "VALUES ("; 
  $sql .= "'" . $uid . "', ";
  $sql .= "'" . $cp    . "', ";
  $sql .= "'" . db_escape($db, $name)    . "', ";
  $sql .= "'" . db_escape($db, $urly)    . "', ";
  $sql .= "'" . db_escape($db, $note)    . "', ";
  $sql .= "'" . db_escape($db, $sort)    . "', ";
  $sql .= "'" . $clipboard    . "'";
  $sql .= ")";

  $result = mysqli_query($db, $sql);

	  if ($result) { 
	    echo 'data updated';
	  } 
	}


	if (isset($_POST['deletethis'])) {

	$deletethis 		= $_POST['deletethis'];

  global $db;
 
  $sql = "DELETE FROM notes ";
  $sql .= "WHERE note_id='" . $deletethis . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

	  if ($result) { 
	    echo 'data updated';
	  } 
	}


	if (isset($_POST['nid'])) {

	$name           = $_POST['name']  ?? ''  ;
	$urly         	= $_POST['urly']  ?? ''  ;
	$note          	= $_POST['note']  ?? ''  ;
	$clipboard     	= $_POST['clipboard']  ?? ''  ;
	$nid 						= $_POST['nid'] 	?? ''	 ;
	

  global $db;

  $sql = "UPDATE notes SET ";
  $sql .= "name='" . db_escape($db, h($name))    . "', ";
  $sql .= "url='" . db_escape($db, $urly)    . "', ";
  $sql .= "note='" . db_escape($db, h($note))    . "', ";
  $sql .= "clipboard='" . $clipboard    . "' ";
  $sql .= "WHERE note_id='"  . $nid . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

	  if ($result) { 
	    echo 'data updated';
	  } 
	}

}
