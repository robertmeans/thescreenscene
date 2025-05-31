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

function remember_me() {
	global $conn;
	if (!empty($_COOKIE['token'])) {
		$token = $_COOKIE['token']; 

		// $sql = "SELECT * FROM users WHERE email_code=? LIMIT 1";

    $sql  = "SELECT u.user_id, u.username, u.first_name, u.last_name, u.email, u.active, u.admin, u.current_project, u.last_project, u.last_proj_name, u.history, p.project_name ";
    $sql .= "FROM users as u ";
    $sql .= "LEFT JOIN projects as p ON u.current_project=p.id ";
    $sql .= "WHERE u.email_code=? ";
    $sql .= "LIMIT 1";

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
			$_SESSION['current_project'] = $user['current_project']; /* value = id */
      $_SESSION['current_project_name'] = $user['project_name']; /* value = project name */
      $_SESSION['last_project'] = $user['last_project']; /* value = id */
      $_SESSION['last_project_name'] = $user['last_proj_name']; /* value = name */

      $_SESSION['recent_projects'] = json_decode($user['history'] ?? '[]', true);

		}
	} 
}

remember_me(); 


// verify user by token
function verifyUser($token) {
 
	global $conn;

	// $sql = "SELECT * FROM users WHERE email_code='$token' LIMIT 1";

  $sql  = "SELECT u.user_id, u.username, u.first_name, u.last_name, u.email, u.active, u.admin, u.current_project, u.last_project, u.last_proj_name, u.history, p.project_name ";
  $sql .= "FROM users as u ";
  $sql .= "LEFT JOIN projects as p ON u.current_project=p.id ";
  $sql .= "WHERE u.email_code='$token' ";
  $sql .= "LIMIT 1";

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
			$_SESSION['current_project'] = $user['current_project']; /* value = id */
      $_SESSION['current_project_name'] = $user['project_name']; /* value = project name */
      $_SESSION['last_project'] = $user['last_project']; /* value = id */
      $_SESSION['last_project_name'] = $user['last_proj_name']; /* value = name */

      $_SESSION['recent_projects'] = json_decode($user['history'] ?? '[]', true);

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

