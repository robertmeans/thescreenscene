<?php
// Dictionary | Thesaurus: OWNER
require_once 'config/initialize.php';

$current_project = $_SESSION['current_project'];
$user_id = $_SESSION['id'];

if (is_post_request()) {

	if (isset($_POST['the_dic'])) {
		global $db;


		$sql = "UPDATE project_user SET ";
		$sql .= "reference='" . $_POST['the_dic'] . "' ";
		$sql .= "WHERE owner_id='"  . db_escape($db, $user_id) . "' ";
		$sql .= "AND project_id='"  . db_escape($db, $current_project) . "' ";		
		$sql .= "LIMIT 1";

		mysqli_query($db, $sql);

	    exit('success');

	}
}


 

		

