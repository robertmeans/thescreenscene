<?php

require_once 'config/initialize.php';

$signal = '';
$msg = '';
$li = '';
$class = '';
$msg_txt = '';

if (is_post_request() && isset($_POST['contactbob'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(10); }

  // validation
  if (empty($name)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">What\'s your name?</li>';
    $class = 'red';
  }

  if (empty($email)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">What\'s your email?</li>';
    $class = 'red';
  } 

  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Email is no bueno. Check it for errors.</li>';
    $class = 'red';
  }

  if (empty($message)) {
    $signal = 'bad';
    $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
    $li .= '<li class="no-count">Don\'t send me an empty message! :/</li>';
    $class = 'red';
  }

  if ($li === '') {

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(2); }

    if (WWW_ROOT != 'http://localhost/browsergadget') {
      emailBob($name, $email, $message);
    }

    $signal = 'ok';

  }

}
	$data = array(
		'signal' => $signal,
		'msg' => $msg, 
    'li' => $li,
    'class' => $class
	);
	echo json_encode($data);

// stop

?>