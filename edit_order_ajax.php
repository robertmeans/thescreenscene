<?php

require_once 'config/initialize.php';

$current_project = $_SESSION['current_project'];

if (is_post_request()) {

	if (isset($_POST['update'])) {
		global $db;
		// only owner can rearrange hyperlink order so no need for shared_with version
		$links = implode(',', $_POST['reorder'])  ?? '' ;

		$sql = "UPDATE projects SET ";
		$sql .= "row_order='" . $links . "' ";
		$sql .= "WHERE id='" . db_escape($db, $current_project) . "' ";
		$sql .= "LIMIT 1";

		mysqli_query($db, $sql);

	    exit('success');

	}
}


 

		

