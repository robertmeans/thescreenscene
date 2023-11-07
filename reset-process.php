<?php
require_once 'config/initialize.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
$msg_txt = '';

// if user clicked on the reset password 
if (isset($_POST['reset'])) {
  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];

  if (empty($password) || empty($passwordConf)) {
    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Enter new password in both fields.</li>';
    $class = 'red';
  }

  if ((!empty($password) && !empty($passwordConf)) && $password !== $passwordConf) {
    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Passwords do not match.</li>';
    $class = 'red';
  }


   if ($li === '') {

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    $sql = "UPDATE users SET password='$password' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {

      unset($_SESSION['pr']);

      $_SESSION['newpswd'] = 'newpswd';

      $signal = 'ok';
      // header('location:' . WWW_ROOT);
      // exit(0);
    } else {

      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li class="no-count">Something did not go right.</li>';
      $class = 'red';

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
