<?php

require_once 'config/initialize.php';

if (!isset($_SESSION['id'])) {
  header('location:' . WWW_ROOT);
  exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
  header('location:' . WWW_ROOT);
  exit();
}

$note_id = $_GET['note'];

if (is_post_request()) {
 
    $result = delete_note($note_id);

    if ($result === true) {
      header('location:' . WWW_ROOT);
    } else {
      $errors = $result;
    }
}
