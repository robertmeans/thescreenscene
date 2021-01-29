<?php

require_once 'config/initialize.php';

if (is_post_request()) {
  if ((isset($_POST['ownShare']) && ($_POST['ownShare'] == "1"))) {
    global $db;
    // owner version
    $editValue             = $_POST['editValue'] ?? '';
    $userid                = $_POST['userId'] ?? '';
    $currentProject        = $_POST['currentProject']  ?? ''  ;

    $sql = "UPDATE project_user SET ";
    $sql .= "edit_toggle='"     . db_escape($db, $editValue)  . "' ";
    $sql .= "WHERE owner_id='"  . db_escape($db, $userid) . "' ";
    $sql .= "AND project_id='"  . db_escape($db, $currentProject) . "' ";
    // as a double precaution: shared_with is null to ensure correct update
    $sql .= "AND shared_with IS NULL ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
    	echo 'data updated';
    }
  }

  if ((isset($_POST['ownShare']) && ($_POST['ownShare'] == "0"))) {
    global $db;
    // shared_with version
    $editValue             = $_POST['editValue'] ?? '';
    $userid                = $_POST['userId'] ?? '';
    $currentProject        = $_POST['currentProject']  ?? ''  ;

    $sql = "UPDATE project_user SET ";
    $sql .= "edit_toggle='"     . db_escape($db, $editValue)  . "' ";
    $sql .= "WHERE shared_with='"  . db_escape($db, $userid) . "' ";
    $sql .= "AND project_id='"  . db_escape($db, $currentProject) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
        echo 'data updated';
    }
  }

}