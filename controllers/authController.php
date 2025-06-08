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
  global $pdo_db;

  if (!empty($_COOKIE['token'])) {
    $token = $_COOKIE['token'];

    try {
      $sql  = "SELECT u.user_id, u.username, u.first_name, u.last_name, u.email, u.active, u.admin, ";
      $sql .= "u.current_project, u.last_project, u.last_proj_name, u.history, p.project_name ";
      $sql .= "FROM users u ";
      $sql .= "LEFT JOIN projects p ON u.current_project = p.id ";
      $sql .= "WHERE u.email_code = :token ";
      $sql .= "LIMIT 1";

      $stmt = $pdo_db->prepare($sql);
      $stmt->execute(['token' => $token]);

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        $_SESSION['id']                  = $user['user_id'];
        $_SESSION['username']           = $user['username'];
        $_SESSION['firstname']          = $user['first_name'];
        $_SESSION['lastname']           = $user['last_name'];
        $_SESSION['email']              = $user['email'];
        $_SESSION['verified']           = $user['active'];
        $_SESSION['admin']              = $user['admin'];
        $_SESSION['current_project']    = $user['current_project'];
        $_SESSION['current_project_name'] = $user['project_name'];
        $_SESSION['last_project']       = $user['last_project'];
        $_SESSION['last_project_name']  = $user['last_proj_name'];
        $_SESSION['recent_projects']    = json_decode($user['history'] ?? '[]', true);
      }

    } catch (PDOException $e) {
      error_log('Remember Me Error: ' . $e->getMessage());
      // Optional: clear the cookie to prevent repeated failure
      setcookie('token', '', time() - 3600, '/');
    }
  }
}


remember_me(); 


// verify user by token
function verifyUser($token)
{
  global $pdo_db;

  try {
    // Step 1: Find user with matching token and join current project name
    $stmt = $pdo_db->prepare("
      SELECT 
        u.user_id, u.username, u.first_name, u.last_name, u.email, u.active, u.admin, 
        u.current_project, u.last_project, u.last_proj_name, u.history, 
        p.project_name
      FROM users u
      LEFT JOIN projects p ON u.current_project = p.id
      WHERE u.email_code = :token
      LIMIT 1
    ");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Step 2: If user exists, activate and log them in
    if ($user) {
      $update_stmt = $pdo_db->prepare("
        UPDATE users
        SET active = 1
        WHERE email_code = :token
        LIMIT 1
      ");
      $update_stmt->execute(['token' => $token]);

      $_SESSION['id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['firstname'] = $user['first_name'];
      $_SESSION['lastname'] = $user['last_name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['current_project'] = $user['current_project'];
      $_SESSION['current_project_name'] = $user['project_name'];
      $_SESSION['last_project'] = $user['last_project'];
      $_SESSION['last_project_name'] = $user['last_proj_name'];
      $_SESSION['recent_projects'] = json_decode($user['history'] ?? '[]', true);

      $_SESSION['new'] = "woot";
    } else {
      $_SESSION['new'] = "toot";
    }

    header('Location: ' . WWW_ROOT);
    exit();

  } catch (PDOException $e) {
    // Optional: log error to error log
    $_SESSION['new'] = "dberror";
    header('Location: ' . WWW_ROOT);
    exit();
  }
}



// user has a password-reset token in query string they've presented
function resetPassword($token)
{
  global $pdo_db;

  try {
    $stmt = $pdo_db->prepare("
      SELECT first_name, email
      FROM users
      WHERE email_code = :token
      LIMIT 1
    ");

    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $_SESSION['firstname'] = $user['first_name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['pr'] = 'showmepr'; // show password reset UI
    } else {
      $_SESSION['pr'] = 'wrongtoken'; // signal invalid token
    }

    header('Location: ' . WWW_ROOT);
    exit();

  } catch (PDOException $e) {
    // Optional: log error here for audit/debugging
    $_SESSION['pr'] = 'dberror';
    header('Location: ' . WWW_ROOT);
    exit();
  }
}


