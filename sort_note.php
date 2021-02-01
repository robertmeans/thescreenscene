<?php

require_once 'config/initialize.php';

if (is_post_request()) {
	if (isset($_POST['update'])) {
		global $db;
		foreach($_POST['positions'] as $position) {
			
		$index = $position[0];
		$new_position = $position[1];


		$sql = "UPDATE notes SET ";
		$sql .= "sort='"  . $new_position . "' ";
		$sql .= "WHERE note_id='"  . $index . "'";

		mysqli_query($db, $sql);

		}

	    exit('success');

	}
}
