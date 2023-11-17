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
if (is_post_request() && isset($_POST['login'])) {
  $username = $_POST['firstname'];
  $password = $_POST['password'];

  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(2); }

  // validation
  if (empty($username)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">First name or email required</li>';
    $class = 'red';
  }

  if (empty($password)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Please enter your password</li>';
    $class = 'red';
  }


  if ($li === '') {

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(0.5); }

    // $userQuery = "SELECT * FROM users WHERE username=? LIMIT 2";
    $userQuery = "SELECT * FROM users WHERE LOWER(username) LIKE LOWER(?) LIMIT 2";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

      if ($userCount > 1) {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="no-count">There are multiple users with the first name "' . $username . '". Please use your email address to login.</li>';
        $class = 'orange';
      } else {

      // having to accept email or username because of how Apple/ios binds these two
      // in their login management
      // $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
      $sql = "SELECT * FROM users WHERE LOWER(email) LIKE LOWER(?) OR LOWER(username) LIKE LOWER(?) LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ss', $username, $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $userCount = $result->num_rows;
      $user = $result->fetch_assoc();

      if ($userCount < 1) {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="no-count">That user does not exist</li>';
        $class = 'red';
      } else if ($userCount == 1 && password_verify($password, $user['password'])) {
        // login success
      $_SESSION['id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['firstname'] = $user['first_name'];
      $_SESSION['lastname'] = $user['last_name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['verified'] = $user['active'];
      $_SESSION['admin'] = $user['admin'];
      $_SESSION['current_project'] = $user['current_project'];
      $_SESSION['token'] = $user['email_code'];
      $_SESSION['message'] = '';
      $_SESSION['delete-success'] = '0';

        // you're not verified yet -> go see a msg telling you we're waiting for
        // email verification
        if (($user['active']) === 0) {
          $signal = 'bad';
          $msg = '<span class="login-txt"><img src="_images/login.png"></span>';
          $li .= '<li class="no-count">Email has not been verified</li>';
          $class = 'blue';
        } else {

          // user is logged in and verified. did they check the rememberme?
          if (isset($_POST['remember_me']) || isset($_POST['remember_me-insert'])) {
            $token = $_SESSION['token'];
            setCookie('token', $token, time() + (1825 * 24 * 60 * 60));
          }

          /*  local testing */   
          if (WWW_ROOT == 'http://localhost/browsergadget') {
            sleep(0.5); 
          }

          // everything checks out -> you're good to go!
          $signal = 'ok';
        }

      } else {
        // the combination of stuff you typed doesn't match anything in the db
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="count">Wrong credential combination. (note: password is case sensitive.)</li>';
        $class = 'red';
        $count = 'on';
      }
    } 
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
