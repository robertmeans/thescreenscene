<?php
require_once 'config/initialize.php';

$signal = '';
$li = '';
$class = '';

// if user clicks on login
if (is_post_request() && isset($_POST['project_name'])) {
  $user_id = $_SESSION['id'];
  $row = [];
  $row['project_name']  = $_POST['project_name']  ?? '' ;
  $row['project_notes'] = $_POST['project_notes']  ?? ''  ;
  $row['share']         = '1' ?? '' ;
  $row['edit']          = '1' ?? '' ;

  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

  // validation
  if (empty($row['project_name'])) {
    $signal = 'bad';
    $li .= '<li class="no-count">Cannot leave Project Name empty.</li>';
    $class = 'red'; 
  }

  if (has_length_greater_than($row['project_notes'], 1500)) {
    $signal = 'bad';
    $li .= '<li class="no-count">Contain the beast! Project notes cannot exceed 1,500 characters.</li>';
    $class = 'red';
  }

  if ($li === '') {

    global $db;

    // start by creating a new project with user_id = the user's ID
    $one = "INSERT INTO projects ";
    $one .= "(project_name, project_notes) ";
    $one .= "VALUES ("; 
    $one .= "'" . db_escape($db, $row['project_name'])    . "', ";
    $one .= "'" . db_escape($db, $row['project_notes'])    . "'";
    $one .= ")";

    // we're going to grab the last id assigned for the project just
    // created and insert it as the project_id in the project_user table
    $two = "INSERT INTO project_user ";
    $two .= "(owner_id, share, edit, project_id) ";
    $two .= "VALUES (";
    $two .= "'" . db_escape($db, $user_id) . "', ";
    $two .= "'" . db_escape($db, $row['share']) . "', ";
    $two .= "'" . db_escape($db, $row['edit']) . "', ";
    $two .= "LAST_INSERT_ID()";
    $two .= ")"; 

    // running the 1st query to create a new project
    $result1 = mysqli_query($db, $one);

    if ($result1 === true) { // if the project was successfully created

      // grab that new project id, assign it to a variable $new_id
      // and put it in the users table as this users current_project
      $new_id = mysqli_insert_id($db);
      update_users_current_project($new_id, $user_id);

      // and run the next query which adds this project to the 
      // project_user table
      $result = mysqli_query($db, $two);

      if ($result) { // if the project is successfully added to the 
        // project_user table then change the current_project in the
        // session and send them to the homepage with their new project

        if (isset($_SESSION['first-project'])) { unset($_SESSION['first-project']); }
        if (isset($_SESSION['no-projects'])) { unset($_SESSION['no-projects']); }
        $_SESSION['current_project'] = $new_id;

        $signal = 'ok';
      } else {
        $signal = 'bad';
        $li .= '<li class="no-count">'. mysqli_error($db) . '</li>';
        $class = 'red';
        db_disconnect($db);
      } 
    } else {
      $signal = 'bad';
      $li .= '<li class="no-count">'. mysqli_error($db) . '</li>';
      $class = 'red';
      db_disconnect($db);
    }

  } // if ($li === '')
}
$data = array(
  'signal' => $signal,
  'li' => $li,
  'class' => $class
);
echo json_encode($data);
