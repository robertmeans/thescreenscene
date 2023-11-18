<?php
require_once 'config/initialize.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
$password_txt = '';
$msg_txt = '';
$count = '';

// if user clicks on login
if (is_post_request() && isset($_POST['project_name'])) {
  $project_name = $_POST['project_name'];
  $project_notes = $_POST['project_notes'];

  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

  // validation
  if (empty($project_name)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Cannot leave Project Name empty.</li>';
    $class = 'red'; 
  }

  if (has_length_greater_than($project_notes, 1500)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Contain the beast! Project notes cannot exceed 1,500 characters.</li>';
    $class = 'red';
  }


  if ($li === '') {

    create_new_project($row, $user_id);

  } 
}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'class' => $class,
  'password_txt' => $password_txt,
  'msg_txt' => $msg_txt,
  'count' => $count
);
echo json_encode($data);
