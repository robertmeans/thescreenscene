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

  if (isset($_POST['proj-notes'])) {
    $project_notes      = $_POST['proj-notes'] ?? '';
    $current_project    = $_SESSION['current_project'] ?? '';

    global $db;
 
    // only an owner can do this
    $sql = "UPDATE projects SET ";
    $sql .= "project_notes='"   . db_escape($db, $project_notes)   . "' ";
    $sql .= "WHERE id='"  . db_escape($db, $current_project) . "' ";
    $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

    if ($result === true) { 
      $signal = 'ok';
      $msg =  'Transfer successful!'; 
    }  
  }  else {
    $signal = 'bad';
    $msg = 'Please give them some kind of reason for getting suspended.';
  }
}

$data = array(
  'signal' => $signal,
  'msg' => $msg
);
echo json_encode($data);

?>