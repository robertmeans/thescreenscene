<?php

session_start();

require_once 'controllers/emailController.php';

$errors = [];
$firstname = "";
$lastname = "";
$email = "";
$verified = "";
$admin = "";
$visible = "";

function remember_me()
{
	global $conn;
	if (!empty($_COOKIE['token'])) {
		$token = $_COOKIE['token']; 
		
		$sql = "SELECT * FROM users WHERE email_code=? LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $token);

		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();

			// put user in session (log them in)
			$_SESSION['id'] = $user['user_id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['firstname'] = $user['first_name'];
			$_SESSION['lastname'] = $user['last_name'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = $user['active'];
			$_SESSION['admin'] = $user['admin'];
			$_SESSION['current_project'] = $user['current_project'];
			$_SESSION['message'] = '';
			$_SESSION['delete-success'] = '0';

			// ^^ admin defaults to 2. 1 = top dog and must be manually changed in db
		}
	} 
}

remember_me(); 


// verify user by token
function verifyUser($token) {
 
	global $conn;
	$sql = "SELECT * FROM users WHERE email_code='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$user = mysqli_fetch_assoc($result);
		$update_query = "UPDATE users SET active=1 WHERE email_code='$token'";

		if (mysqli_query($conn, $update_query)) {
			// login success
			$_SESSION['id'] = $user['user_id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['firstname'] = $user['first_name'];
			$_SESSION['lastname'] = $user['last_name'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['current_project'] = $user['current_project'];
			// $_SESSION['verified'] = 1;

			$_SESSION['new'] = "woot";
			header('location:'. WWW_ROOT);
			exit();
		}
	} else {
		$_SESSION['new'] = "toot";
    header('location:'. WWW_ROOT);
    exit();
	}
}


// user has a password-reset token in query string they've presented
function resetPassword($token) 
{
	global $conn;
	$sql = "SELECT * FROM users WHERE email_code='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

  if (count($user) > 0) {
    $_SESSION['firstname'] = $user['first_name'];
  	$_SESSION['email'] = $user['email'];
    $_SESSION['pr'] = 'showmepr';
  } else {
    $_SESSION['pr'] = 'wrongtoken';
  }

	header('location:' . WWW_ROOT);
	exit();
}

