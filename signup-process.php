<?php 
require_once 'config/initialize.php';

// sign-up
$signal = '';
$msg = '';
$li = '';
$class = '';
$msg_txt = '';

// if user clicks on login
if (is_post_request() && isset($_POST['signup'])) {
  $username = $_POST['firstname'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = strtolower($_POST['email']);
  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];

  // validation
  if (empty($firstname)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">First name required</li>';
    $class = 'red';
  }

  if ((!empty($firstname)) && (strlen($firstname) > 16)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Keep first name 16 characters or less</li>';
    $class = 'red';
  } 

  if (empty($lastname)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Last name required</li>';
    $class = 'red';
  }

  if ((!empty($lastname)) && (strlen($lastname) > 16)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Keep last name 16 characters or less</li>';
    $class = 'red';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Email is invalid</li>';
    $class = 'red';
  }

  if (empty($email)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Email required</li>';
    $class = 'red';
  }

  if (empty($password)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Password required</li>';
    $class = 'red';
  }

  if ((!empty($password)) && (strlen($password) <= 3)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Password needs at least 4 characters</li>';
    $class = 'red';
  }

  if ((!empty($password)) && (strlen($password) > 50)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Keep your password under 50 characters</li>';
    $class = 'red';
  }

  if ((!empty($password)) && (empty($passwordConf))) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Confirm password</li>';
    $class = 'red';
  }

  if ((empty($password)) && (empty(!$passwordConf))) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Type same password in both fields</li>';
    $class = 'red';
  } 

  if ( ((!empty($password)) && (empty(!$passwordConf)))  &&   ($password !== $passwordConf)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Passwords don\'t match</li>';
    $class = 'red';
  }


  if ($li === '') {

    if (WWW_ROOT == 'http://localhost/browsergadget') {
      sleep(2); 
    }

    $emailQuery = "SELECT * FROM users WHERE LOWER(email) LIKE LOWER(?) LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    /* updated to PHP v7.2 on GoDaddy and unchecked mysqli and checked nd_mysqli */
    /* in order to get this command to work */
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if ($userCount > 0) {
      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li class="no-count">Email already exists</li>';
      $class = 'orange';
    } else if (count($errors) === 0) {

      $password = password_hash($password, PASSWORD_DEFAULT);
      $token = bin2hex(random_bytes(50));
      $verified = false;

      $sql = "INSERT INTO users (username, first_name, last_name, email, active, email_code, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ssssdss', $firstname, $firstname, $lastname, $email, $verified, $token, $password);

      if ($stmt-> execute()) {
        // login user
        $user_id = $conn->insert_id;
        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['email'] = $email;

        if (WWW_ROOT != 'http://localhost/browsergadget') {
          sendVerificationEmail($firstname, $email, $token);
        }

        /*  local testing */   
        if (WWW_ROOT == 'http://localhost/browsergadget') {
          sleep(2); 
        }

        // everything checks out -> you're good to go!
        $signal = 'ok';

      } else {
        $signal = 'bad';
        $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
        $li .= '<li class="no-count">Database error: failed to register. Server could be undergoing a reboot. Please give it a minute and try again.</li>';
        $class = 'red';
        // make sure you have mySQL error turned on - 1st line
        // of database.php - to troubleshoot if you're seeing this message.
      }
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