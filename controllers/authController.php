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
			// $_SESSION['color'] == "1";
			$_SESSION['verified'] = 1;
			// set flash message
			$_SESSION['message'] = "Your email address was successfully verified! You can now login.";
			$_SESSION['alert-class'] = "alert-success";
			$_SESSION['delete-success'] = '0';
			header('location:'. WWW_ROOT);
			exit();
		}
	} else {
		echo 'User not found';
	}
}















// // if user clicks on forgot password 
// if (isset($_POST['forgot-password-zy'])) {
// 	$email = $_POST['email'];

// 	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 		$errors['email'] = "Email is invalid";
// 	}

// 	if (empty($email)) {
// 		$errors['email'] = "Email required";
// 	}

// 	if (count($errors) == 0) {

// 		$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
// 		$result = mysqli_query($conn, $sql);
// 		$user = mysqli_fetch_assoc($result);
// 		$token = $user['email_code'];
// 		sendPasswordResetLink($email, $token);
// 		header('location: password_message.php');
// 		exit(0);
// 	}
// }
















// if user clicked on the reset password 
if (isset($_POST['reset-password-btn'])) {
	$password = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];

	if (empty($password) || empty($passwordConf)) {
		$errors['password'] = "Password required";
	}

	if ($password !== $passwordConf) {
		$errors['password'] = "Passwords don't match";
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	$email = $_SESSION['email'];

	if(count($errors) == 0) {
		$sql = "UPDATE users SET password='$password' WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			$_SESSION['message'] = "Your password was changed successfully. You can now login with your new credentials.";
			$_SESSION['alert-class'] = "pass-reset";
			header('location: login.php');
			exit(0);
		}
	}
}

function resetPassword($token) 
{
	global $conn;
	$sql = "SELECT * FROM users WHERE email_code='$token' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $user['email'];
	header('location: reset_password.php');
	exit(0);

}

