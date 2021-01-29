<?php

require_once 'config/initialize.php';
$id = $_GET['id'];


if (is_post_request()) {


  if (isset($_POST['update-link'])) {
    $row = [];
    $row['count']     = $_POST['count'] ?? '';
    $row['name']      = $_POST['name'] ?? '';
    $row['url']       = $_POST['url'] ?? '';

    $result = update_link($id, $row);

  } 

  if (isset($_POST['delete-link'])) { // delete...
    $row = [];
    $row['count']     = $_POST['count'] ?? '';
    $result = delete_link($id, $row);
  }

if ($result === true) {

// echo '<div id="success-wrap"><span class="success-msg">Update Successful!</span></div>';

      // for testing - header('location: http://www.bing.com');
      header('location: edit_content.php?id=' . $id);

      } else {
            $errors = $result;
      } 
  } 