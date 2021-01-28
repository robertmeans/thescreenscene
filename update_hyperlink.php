<?php

require_once 'config/initialize.php';


if (is_post_request()) {
  if (isset($_POST['cp'])) {
    global $db;

    $name       = $_POST['name'] ?? '';
    $url        = $_POST['urlz']  ?? ''  ;
    $count      = $_POST['rowid'] ?? '';
    $cp         = $_POST['cp'] ?? '';

    $sql = "UPDATE projects SET ";
    $sql .= $count . "_text='"  . db_escape($db, $name)  . "', ";
    $sql .= $count . "_url='"   . db_escape($db, $url)   . "' ";
    $sql .= "WHERE id='"  . db_escape($db, $cp) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
    	echo 'data updated';
    }
  }

}