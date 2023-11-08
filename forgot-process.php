<?php
require_once 'config/initialize.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
$msg_txt = '';

// if user clicks on forgot password (Password recovery)
if (is_post_request() && isset($_POST['forgotpass'])) {
  $email = $_POST['forgotemail'];

  // validation
  if (empty($email)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Email required. It\'s the only thing here for Pete\'s sake.</li>';
    $class = 'red';
  } 

  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Email is invalid</li>';
    $class = 'red';
  }

  if ($li === '') {

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(2); }

    $sql = "SELECT * FROM users WHERE LOWER(email) LIKE LOWER(?) LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $user = $result->fetch_assoc();
    
    if ($userCount === 1) {

      // if (WWW_ROOT == 'http://localhost/browsergadget') {
      //   sleep(5);
      // }

      
      // $user = $result->fetch_assoc();
      $token = $user['email_code'];

      if (WWW_ROOT != 'http://localhost/browsergadget') {
        sendPasswordResetLink($email, $token);
      }

      $signal = 'ok';

      } else {


      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li class="no-count">There is no one here with that email address.</li>';
      $class = 'orange';


    }

  } 
}
$data = array(
  'signal' => $signal,
  'msg' => $msg,
  'li' => $li,
  'class' => $class,
  'msg_txt' => $msg_txt
);
echo json_encode($data);
