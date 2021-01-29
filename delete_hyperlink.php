<?php

require_once 'config/initialize.php';


if (is_post_request()) {
  if (isset($_POST['cp'])) {
    global $db;

    $count      = $_POST['rowid'] ?? '';
    $cp         = $_POST['cp'] ?? '';
    // delete only happens in projects table so no need for shared_with version
    
    $sql = "UPDATE projects SET ";
    $sql .= $count . "_text='', ";
    $sql .= $count . "_url='' ";

    $sql .= "WHERE id='"  . db_escape($db, $cp) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
      echo 'data deleted';
    }
  }

}