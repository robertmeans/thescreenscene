<?php

require_once 'config/initialize.php';

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];

if (is_post_request()) {

	if (isset($_POST['update'])) {
		global $db;

		$links = implode(',', $_POST['reorder'])  ?? '' ;

		$sql = "UPDATE project_user SET ";
		$sql .= "search_order='"    . $links     . "' ";
		$sql .= "WHERE owner_id='"  . db_escape($db, $user_id) . "' ";
		$sql .= "AND project_id='"  . db_escape($db, $current_project) . "' ";
		$sql .= "LIMIT 1";

		mysqli_query($db, $sql);

	    exit('success');
		// header('location:' . WWW_ROOT );

	}
}


 

		

