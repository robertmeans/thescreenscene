<?php
require_once 'config/initialize.php';

if (is_post_request()) {

// sign-up
if (isset($_POST['signup'])) {
  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

  $signal = '';
  $msg = '';
  $li = '';
  $class = '';

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

  if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
    } else {

      $password = password_hash($password, PASSWORD_DEFAULT);
      $token = bin2hex(random_bytes(50));
      $verified = false;

      $sql = "INSERT INTO users (username, first_name, last_name, email, active, email_code, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ssssdss', $firstname, $firstname, $lastname, $email, $verified, $token, $password);

      if ($stmt->execute()) {
        
        $user_id = $conn->insert_id;

        // $_SESSION['id'] = $user_id;
        // $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['email'] = $email;

        if (WWW_ROOT != 'http://localhost/browsergadget') {
          sendVerificationEmail($firstname, $lastname, $email, $token);
        }

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
  $data = array(
    'signal' => $signal,
    'msg' => $msg,
    'li' => $li,
    'class' => $class
  );
  echo json_encode($data);

}

// if user clicks on login
if (isset($_POST['login'])) {
  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  $password_txt = '';
  $msg_txt = '';
  $count = '';

  $username = $_POST['firstname'];
  $password = $_POST['password'];

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

}

// forgot password
if (isset($_POST['forgotpass'])) {
  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  $msg_txt = '';
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

    $sql = "SELECT * FROM users WHERE LOWER(email) LIKE LOWER(?) LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $user = $result->fetch_assoc();
    
    if ($userCount === 1) {

      $token = $user['email_code'];

      if (WWW_ROOT != 'http://localhost/browsergadget') {
        sendPasswordResetLink($email, $token);
      }

      $signal = 'ok';

      } else {

      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li class="no-count">There is no one here with that email address.</li>';
      $class = 'red';
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

}

// reset password 
if (isset($_POST['reset'])) {
  if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  $msg_txt = '';
  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];

  // validation
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

      $signal = 'ok';
    } else {

      $signal = 'bad';
      $msg = '<span class="login-txt"><img src="_images/try-again.png"></span>';
      $li .= '<li class="no-count">Something did not go right.</li>';
      $class = 'red';

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

}

/*  link handler
    tooltip =   'Go to homepage'
    trigger =   .gth-link 
    refreshes index.php which calls homepage_logged_in.php to sort via session variable, otherwise defaults to either homepage_ower.php or homepage_shared_with.php accordingly */
  if (isset($_POST['go_to_homepage'])) {
    $id = $_SESSION['id'];
    $current_project = $_POST['current_project'];

    $result = update_current_project($id, $current_project);

    if ($result === 'pass') {
      $_SESSION['current_project'] = $current_project;
      if (isset($_SESSION['got-kicked-out'])) { unset($_SESSION['got-kicked-out']); } /* failsafe */
      $signal = 'ok';
      echo json_encode($signal);
    } else {
      $_SESSION['got-kicked-out'] = 'nossir';
      $signal = 'ok';
      echo json_encode($signal);   
    }

  }

/*  link handler
    tooltip =   'Organize search fields' | (Google, URL, Bing, Reference, YouTube)
    trigger =   .osf-link 
    goes to:    edit_searches.php
    by using:   $_SESSION['organize'] = 'anothern';
    found in both: nav/inner_nav.php & my_projects.php */ 
  if (isset($_POST['organizesearchfields'])) {

    if (isset($_POST['current_project'])) {
      /* they're coming from my_projects.php. maybe from another project. update everything before sending them on their way. */
      $id = $_SESSION['id'];               ;
      $current_project = $_POST['current_project'];
      $result = update_current_project($id, $current_project);

      if ($result === 'pass') {
        $row = update_color($id, $current_project);
        $_SESSION['color'] = $row['color'];
        $_SESSION['current_project'] = $current_project;
        $_SESSION['organize'] = 'anothern';
        if (isset($_SESSION['got-kicked-out'])) { unset($_SESSION['got-kicked-out']); } /* failsafe */

        $signal = 'ok';
        echo json_encode($signal); 
      } else {
        $_SESSION['got-kicked-out'] = 'nossir';
        $signal = 'ok';
        echo json_encode($signal);
      }

    } else {
      $_SESSION['organize'] = 'anothern';
      $signal = 'ok';
      echo json_encode($signal);
    } 
  } 

/*  link handler
    Rearrange Bookmarks [drag & drop hyperlinks around]
    tooltip = 'Rearrange bookmarks'
    trigger =   .eo-link
    goes to:  edit_order.php
    by using: $_SESSION['order'] = 'anothern';
    found in both: nav/inner_nav.php & my_projects.php */
  if (isset($_POST['rearrangebookmarks'])) {
    $_SESSION['order'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }

/*  link handler
    tooltip =   'Share project'
    trigger = .sp-link
    goes to:  share_project.php
    by using: $_SESSION['share-project'] = 'anothern';
    found in both: nav/inner_nav.php & my_projects.php */ 
  if (isset($_POST['shareproject'])) {

    if (isset($_POST['current_project'])) {
      $id = $_SESSION['id'];               ;
      $current_project = $_POST['current_project'];
      $result = update_current_project($id, $current_project);

      if ($result === 'pass') {
        $row = update_color($id, $current_project);
        $_SESSION['color'] = $row['color'];
        $_SESSION['current_project'] = $current_project;
        $_SESSION['share-project'] = 'anothern';
        if (isset($_SESSION['got-kicked-out'])) { unset($_SESSION['got-kicked-out']); } /* failsafe */

        $signal = 'ok';
        echo json_encode($signal); 
      } else {
        $_SESSION['got-kicked-out'] = 'nossir';
        $signal = 'ok';
        echo json_encode($signal);
      }

    } else {
      $_SESSION['share-project'] = 'anothern';
      $signal = 'ok';
      echo json_encode($signal);
    } 
  } 

/*  link handler
    tooltip = 'Start a new project'
    trigger = .np-link
    goes to:  new_project.php
    by using: $_SESSION['another-proj'] = 'anothern';
    found in both: nav/inner_nav.php & my_projects.php */
  if (isset($_POST['startanewproject'])) {
    /* can only leave this page to either home or my_projects.php so only 2 exit strategies are needed for 'Cancel' */
    if (isset($_POST['inner_nav'])) {
      /* they clicked on .np-link from inner_nav.php - Start a session with 'backtohomepage' in case they hit the 'Cancel' btn so that we can get them back to homepage */
      $_SESSION['another-proj'] = 'anothern';
      $_SESSION['backtohomepage'] = 'yo';
      $signal = 'ok';
      echo json_encode($signal);

    } else if (isset($_POST['my_projects'])) {
      /* they clicked on .np-link from my_projects.php - Start a session with 'backtomyprojects' in case they hit the 'Cancel' btn */
      $_SESSION['another-proj'] = 'anothern';
      $_SESSION['backtomyprojects'] = 'yo';
      $signal = 'ok';
      echo json_encode($signal);

    } 
    
  }
/* one more cancel for edit_project_details.php. see above for complete details on all this. */  
  if (isset($_POST['cancelprojectdetails'])) {
      $_SESSION['another-proj'] = 'anothern';
      $_SESSION['newprojectcancelbtn'] = 'yo';  

      $signal = 'ok';
      echo json_encode($signal);     
  }

/*  link handler
    tooltip = 'Projects page'
    trigger = .vpp-link
    goes to:  my_projects.php
    by using: $_SESSION['view-proj-pg'] = 'anothern';
    found in both: nav/inner_nav.php & my_projects.php */
  if (isset($_POST['viewprojectspage'])) {
    if (isset($_SESSION['got-kicked-out'])) { unset($_SESSION['got-kicked-out']); }
    $_SESSION['view-proj-pg'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }

/*  link handler
    tooltip = 'Project name & notes'
    trigger = .epd-link
    goes to:  edit_project_details.php
    by using: $_SESSION['editprojdeets'];
    found only in my_projects.php */
  if (isset($_POST['editthesedetails'])) {

    $id = $_SESSION['id'];
    $current_project = $_POST['current_project'];
    $result = update_current_project($id, $current_project);

    if ($result === 'pass') {
      $row = update_color($id, $current_project);
      $_SESSION['color'] = $row['color'];
      $_SESSION['current_project'] = $current_project;
      $_SESSION['backtomyprojects'] = 'yo';
      $_SESSION['editprojdeets'] = 'anothern';

      $signal = 'ok';
      echo json_encode($signal);
    }

  }

/*  link handler
    Delete Project
    tooltip = 'Delete project'
    trigger =   .dp-link
    goes to:  delete_project.php
    by using: $_SESSION['deleteproject'] = 'anothern';
    found only in my_projects.php */
  if (isset($_POST['deleteproject'])) {
    $id = $_SESSION['id'];               ;
    $current_project = $_POST['current_project'];
    $result = update_current_project($id, $current_project);

    if ($result === 'pass') {
      $row = update_color($id, $current_project);
      $_SESSION['color'] = $row['color'];
      $_SESSION['current_project'] = $current_project;
      $_SESSION['deleteproject'] = 'anothern';

      $signal = 'ok';
      echo json_encode($signal); 
    }
  }

/* edit / update / create bookmarks hyperlinks on homepage */
  if (isset($_POST['updatebookmark'])) {
    global $db;

    $id = $_SESSION['id'];
    $current_project = $_SESSION['current_project'];

    $name  = $_POST['name'];
    $url   = $_POST['urlz'];
    $count2 = $_POST['rowid'];
    $cp    = $_POST['cp'];
    /* update only happens in project table so no need for shared_with version */

    $result = update_bookmark($id, $current_project, $count2, $name, $url, $cp);

    if ($result === 'pass') {
      $signal = 'ok';
      echo json_encode($signal);
    } else {
      $_SESSION['got-kicked-out'] = 'nossir';
      $signal = 'no';
      echo json_encode($signal);
    }

  }

/* delete bookmarks hyperlinks on homepage */
if (isset($_POST['deletebookmark'])) {

  global $db;

  $id = $_SESSION['id']; 
  $current_project = $_SESSION['current_project'];

  $count2  = $_POST['rowid'];
  $cp     = $_POST['cp'];
  // delete only happens in projects table so no need for shared_with version

  $result = delete_bookmark($id, $current_project, $count2, $cp); 

  if ($result === 'pass') {
    $signal = 'ok';
    echo json_encode($signal);
  } else {
    $_SESSION['got-kicked-out'] = 'nossir';
    $signal = 'no';
    echo json_encode($signal);
  }

} 


/* new_project.php - create a new project */ 
  if (isset($_POST['create-new-project'])) {
    $signal = '';
    $li = '';
    $class = '';
   
    $user_id = $_SESSION['id'];
    $row = [];
    $row['project_name']  = $_POST['project_name']  ?? '' ;
    $row['project_notes'] = $_POST['project_notes']  ?? ''  ;
    $row['share']         = '1' ?? '' ;
    $row['edit']          = '1' ?? '' ;

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

    // validation
    if (empty($row['project_name'])) {
      $signal = 'bad';
      $li .= '<li class="no-count">Cannot leave Project Name empty.</li>';
      $class = 'red'; 
    }

    if (has_length_greater_than($row['project_notes'], 1500)) {
      $signal = 'bad';
      $li .= '<li class="no-count">Contain the beast! Project notes cannot exceed 1,500 characters.</li>';
      $class = 'red';
    }

    if ($li === '') {

      global $db;

      /* start by creating a new project with user_id = the user's ID */
      $one = "INSERT INTO projects ";
      $one .= "(project_name, project_notes) ";
      $one .= "VALUES ("; 
      $one .= "'" . db_escape($db, $row['project_name'])    . "', ";
      $one .= "'" . db_escape($db, $row['project_notes'])    . "'";
      $one .= ")";

      /* we're going to grab the last id assigned for the project just created and insert it as the project_id in the project_user table */
      $two = "INSERT INTO project_user ";
      $two .= "(owner_id, share, edit, project_id) ";
      $two .= "VALUES (";
      $two .= "'" . db_escape($db, $user_id) . "', ";
      $two .= "'" . db_escape($db, $row['share']) . "', ";
      $two .= "'" . db_escape($db, $row['edit']) . "', ";
      $two .= "LAST_INSERT_ID()";
      $two .= ")"; 

      /* running the 1st query to create a new project */
      $result1 = mysqli_query($db, $one);

      if ($result1 === true) {
      /* if the project was successfully created */

        /* grab that new project id, assign it to a variable $new_id and put it in the users table as this users current_project */
        $new_id = mysqli_insert_id($db);
        update_users_current_project($new_id, $user_id);

        /* and run the next query which adds this project to the project_user table */
        $result = mysqli_query($db, $two);

        if ($result) { 
        /* if the project is successfully added to the project_user table then change the current_project in the session and send them to the homepage with their new project */

          if (isset($_SESSION['first-project'])) { unset($_SESSION['first-project']); }
          if (isset($_SESSION['no-projects'])) { unset($_SESSION['no-projects']); }
          if (isset($_SESSION['cancel-option'])) { unset($_SESSION['cancel-option']); }
          if (isset($_SESSION['view-proj-pg'])) { unset($_SESSION['view-proj-pg']); }
          $_SESSION['current_project'] = $new_id;

          $signal = 'ok';
        } else {
          $signal = 'bad';
          $li .= '<li class="no-count">'. mysqli_error($db) . '</li>';
          $class = 'red';
          db_disconnect($db);
        } 
      } else {
        $signal = 'bad';
        $li .= '<li class="no-count">'. mysqli_error($db) . '</li>';
        $class = 'red';
        db_disconnect($db);
      }

    } // if ($li === '')
    $data = array(
      'signal' => $signal,
      'li' => $li,
      'class' => $class
    );
    echo json_encode($data);

  }


/* add new note */
if (isset($_POST['new_or_update_a_note'])) { 

  $user_id = $_SESSION['id'];
  $current_project = $_SESSION['current_project'];

  $sort           = $_POST['sort']  ?? ''  ;
  $cp             = $_POST['cp']  ?? '' ;
  $uid            = $_POST['uid']  ?? ''  ;
  $name           = $_POST['name']  ?? ''  ;
  $urly           = $_POST['urly']  ?? ''  ;
  $note           = $_POST['note']  ?? ''  ;
  $clipboard      = $_POST['clipboard']  ?? ''  ;
  $truncate       = $_POST['truncate']  ?? ''  ;
  
  global $db;

  $sql = "INSERT INTO notes ";
  $sql .= "(user_id, project_id, name, url, note, sort, clipboard, truncate) ";
  $sql .= "VALUES ("; 
  $sql .= "'" . $uid . "', ";
  $sql .= "'" . $cp    . "', ";
  $sql .= "'" . db_escape($db, $name)    . "', ";
  $sql .= "'" . db_escape($db, $urly)    . "', ";
  $sql .= "'" . db_escape($db, $note)    . "', ";
  $sql .= "'" . db_escape($db, $sort)    . "', ";
  $sql .= "'" . $clipboard    . "', ";
  $sql .= "'" . $truncate    . "'";
  $sql .= ")";

  $result = mysqli_query($db, $sql);

  if ($result) { 
    echo 'data updated';
  } 
}

  
if (isset($_POST['delete_a_note'])) {

  $user_id = $_SESSION['id'];
  $current_project = $_SESSION['current_project'];

  $deletethis     = $_POST['deletethis'];

  global $db;
 
  $sql = "DELETE FROM notes ";
  $sql .= "WHERE note_id='" . $deletethis . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if ($result) { 
    echo 'data updated';
  } 
}


if (isset($_POST['modify_a_note'])) {

  $user_id = $_SESSION['id'];
  $current_project = $_SESSION['current_project'];

  $name           = $_POST['name']  ?? ''  ;
  $urly           = $_POST['urly']  ?? ''  ;
  $note           = $_POST['note']  ?? ''  ;
  $clipboard      = $_POST['clipboard']  ?? ''  ;
  $truncate      = $_POST['truncate']  ?? ''  ;
  $nid            = $_POST['nid']   ?? ''  ;
  
  global $db;

  $sql = "UPDATE notes SET ";
  $sql .= "name='" . db_escape($db, h($name))    . "', ";
  $sql .= "url='" . db_escape($db, $urly)    . "', ";
  $sql .= "note='" . db_escape($db, h($note))    . "', ";
  $sql .= "clipboard='" . $clipboard    . "', ";
  $sql .= "truncate='" . $truncate    . "' ";
  $sql .= "WHERE note_id='"  . $nid . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if ($result) { 
    echo 'data updated';
  } 
}



/* Delete button on delete_project.php page - conditions have been met to allow deletion. */
  if (isset($_POST['vamoose'])) {

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }
    global $db;

    $li = '';
    $class = '';
    $current_project = $_SESSION['current_project'];
    $vamoose  = $_POST['vamoose'];
 
    // validation
    if (empty($vamoose)) {
      $signal = 'bad';
      $li .= '<li>You\'ll need to type, "Delete" in order to proceed.</li>';
      $class = 'red';
    }
    if (!empty($vamoose) && $vamoose !== 'Delete') {
      $signal = 'bad';
      $li .= '<li>You\'ve got to type "Delete" (capital "D") just like it says. We don\'t want any accidental deletions around here.</li>';
      $class = 'red';
    }

    if ($li === '') {

      $sql = "DELETE FROM projects ";
      $sql .= "WHERE id='" . $current_project . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);

      if ($result === true) {
        $_SESSION['ds'] = 'ds-success';
        $_SESSION['view-proj-pg'] = 'anothern';
        $signal = 'ok';
      } else {
        $signal = 'bad';
        $li .= '<li>' . mysqli_error($db) . '</li>';
        $class = 'red';
      }

    } // if ($li === '')
  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class
  );
  echo json_encode($data);

  }

  // 'Cancel' button on edit_project_details.php
  if (isset($_POST['cancel-deets'])) {
    $_SESSION['view-proj-pg'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }

  // 'Submit' button on edit_project_details.php
  if (isset($_POST['submitdeets'])) {

    $li = '';
    $class = '';
    $current_project = $_SESSION['current_project'];
    $row = [];
    $row['project_name']     = $_POST['project_name'];
    $row['project_notes']      = $_POST['project_notes'];

    // validation
    if (empty($row['project_name'])) {
      if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }
      $signal = 'bad';
      $li .= '<li class="no-count">Cannot leave Project Name empty.</li>';
      $class = 'red'; 
    }

    if (has_length_greater_than($row['project_notes'], 1500)) {
      $signal = 'bad';
      $li .= '<li class="no-count">Contain the beast! Project notes cannot exceed 1,500 characters.</li>';
      $class = 'red';
    }

    if ($li === '') {

      global $db;
      if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

      $result = update_project_deets($current_project, $row);

      if ($result === true) {
        $_SESSION['view-proj-pg'] = 'anothern';
        $signal = 'ok';

        } else {
          $signal = 'bad';
          $li .= '<li class="no-count">'. mysqli_error($db) . '</li>';
          $class = 'red';
          db_disconnect($db);
        } 
      } // if ($li === '')

  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class
  );
  echo json_encode($data);

  } // if (isset($_POST['submitdeets']))



/* ******************* share project : begin ************************ */
/* ******************** share owner : begin ************************* */
  if (isset($_POST['owner-share-submit'])) {
    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

    global $db;

    $li = '';
    $class = '';
    $eclass = '';
    $shared_names = '';

    $user_id = $_SESSION['id'];
    $id = $_POST['project_id'];
    if (isset($_POST['share'])) { $share = '1'; } else { $share = '0'; }
    if (isset($_POST['edit'])) { $edit = '1'; } else { $edit = '0'; }
    $current_project = $_POST['project_id'];
    $project_name = $_POST['project_name'];

    $row = [];
    $row['user_id']   = $_SESSION['id'];
    $row['project_name'] = $_POST['project_name'];
    $email = $_POST['user_email'];

    // validation 
    if (empty($email)) {
      $li .= '<li>Not much I can do without an email address.</li>';
      $class .= 'red';
      $eclass = 'red';
      $signal = 'bad';
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $li .= '<li>Email is invalid</li>';
      $class = 'red';
      $eclass = 'red';
      $signal = 'bad';
    }

    if ($li === '') {
      /* make sure email actually exists in db */
      $sql1 = "SELECT * FROM users WHERE "; 
      $sql1 .= "email='" . db_escape($db, $email) . "' ";
      $sql1 .= "LIMIT 1";

      $result1 = mysqli_query($db, $sql1);
      confirm_result_set($result1);
      $row1 = mysqli_fetch_assoc($result1); 
      /* assign users table content to the specific user whose email has been entered */

      if (isset($row1['email']) && ($row1['user_id'] != $user_id)) { 
        /* email exists and does not belong to the user submitting the request. */
        $share_with = $row1['user_id']; 
        /* ^ here's the user's id whose email was just submitted. let's make sure they don't already have this project shared with them. */
        $sql2 = "SELECT p_u.project_id, p_u.shared_with, p_u.owner_id, u.* ";
        $sql2 .= "FROM project_user as p_u ";
        $sql2 .= "LEFT JOIN users as u ON u.user_id=p_u.shared_with "; 
        $sql2 .= "WHERE p_u.project_id='" . db_escape($db, $id) . "' ";
        $sql2 .= "AND (p_u.shared_with='" . db_escape($db, $share_with) . "' ";
        $sql2 .= "OR p_u.owner_id='" . db_escape($db, $share_with) . "') ";
        $sql2 .= "LIMIT 1";

        $result2 = mysqli_query($db, $sql2);
        confirm_result_set($result2);
        $row2 = mysqli_fetch_assoc($result2); 
        /* assign value of user that was found to new var '$row2' so it does not interfere w/$row1 */

          if ($result2) { 
            if (isset($row2['email'])) {
              $li .= '<li>' . $row2['first_name'] . ' ' . $row2['last_name'] . ' is already a member of this project.</li>';
              $class = 'red';
              $signal = 'bad';
              } else { 

            /* keep going, everything good so far. user is unique and does not have the project shared with them already. */
            $sql3 = "INSERT INTO project_user ";
            $sql3 .= "(project_id, owner_id, shared_with, share, edit) ";
            $sql3 .= "VALUES ("; 
            $sql3 .= "'" . db_escape($db, $current_project)    . "', ";
            $sql3 .= "'" . db_escape($db, $user_id) . "', ";
            $sql3 .= "'" . db_escape($db, $share_with) . "', ";
            $sql3 .= "'" . db_escape($db, $share) . "', ";
            $sql3 .= "'" . db_escape($db, $edit) . "'";
            $sql3 .= ")";

            $result3 = mysqli_query($db, $sql3);

            if ($result3) {
            /* new member was successfully added to project. now let's prepare the results of all shared members to update the list on the page. */

              $is_it_shared = is_this_project_shared($_POST['project_id']); 
              $result3 = mysqli_num_rows($is_it_shared); 
              /* did we find any shared results? if so... */

              if ($result3 > 0) { 

                $sharing = show_shared_with_info($user_id, $_POST['project_id']); 
                $i = 0;
                while ($row3 = mysqli_fetch_assoc($sharing)) { 
                  $names[]  = '<li><form class="edit-user" method="post">';
                  $names[]  .= $row3['first_name'] . ' ' . $row3['last_name'] . ' | ' . $row3['email'];
                  $names[]  .= '<input type="hidden" id="'.$i.'_dsuser" name="delete-shared-user" value="' . $row3['shared_with'] . '">';
                  $names[]  .= '<input type="hidden" id="'.$i.'_project_id" name="project_id" value="' .  $row3['project_id'] . '">';


                  $names[]  .= '<input type="hidden" id="'.$i.'_edit" name="'.$i.'_edit" value="';
                  if ($row3['edit'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
                  $names[]  .= '">';

                  $names[]  .= '<input type="hidden" id="'.$i.'_share" name="'.$i.'_share" value="';
                  if ($row3['share'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
                  $names[]  .= '">';


                  $names[]  .= '<input type="hidden" id="'.$i.'_project_name" name="project_name" value="' . $project_name . '">';
                  $names[]  .= '<input type="hidden" id="'.$i.'_username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">';
                  $names[]  .= '<a data-id="'.$i.'" class="rsu editshareduser">Edit</a>';
                  $names[]  .= '</form><span>Permissions: ';
                  if ($row3['share'] == 0 && $row3['edit'] == 0) { $names[]  .= 'View only'; }
                  if ($row3['edit'] == 1) { $names[]  .= 'Can edit'; }
                  if ($row3['share'] == 1 && $row3['edit'] == 1) { $names[]  .= ' + '; }
                  if ($row3['share'] == 1) { $names[]  .= 'Can share'; }
                  $names[]  .= '</span></li>'; 
                  $i++;
                } 

              $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' ';
              $li .= 'has successfully been added to the project, "' . $project_name . '".</li>';
              $class = 'green';

              if (isset($names)) { $shared_names .= implode($names); }

              $signal = 'ok';

              /* end if ($result3 > 0) - beyond this $result3 */
              } 

            /* end if ($result3) - beyond this $result3 does not exist */
          } else {
            $li .= '<li>' .  mysqli_error($db) . '</li>';
            $class = 'red';
            $signal = 'bad';

          }
        }
      } 
   /* ^ if ($result2) */

    } else {
 /* ^ ends: if (isset($row1['email']) && ($row1['user_id'] != $user_id)) */

      if (!isset($row1['email'])) {
        $li .= '<li>The address, "' . $email . '" does not exist around here.</li>';
        $class .= 'red';
        $eclass .= 'red';
        $signal = 'bad';
      } else if (isset($row1['user_id']) && ($row1['user_id'] == $user_id)) {
        $li .= '<li>One is the lonliest number. You can\'t share a project with yourself.</li>';
        $class = 'red';
        $signal = 'bad';
      } else {
        $li .= '<li>' .  mysqli_error($db) . '</li>';
        $class = 'red';
        $signal = 'bad';
        
      }
    }
  } /* if ($li === '') */

  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class,
    'eclass' => $eclass,
    'shared_names' => $shared_names
  );
  echo json_encode($data);

  }
/* ********************** share owner : end ************************** */

  if (isset($_POST['sharer-share-submit'])) {
    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

    global $db;

    $li = '';
    $class = '';
    $eclass = '';
    $shared_names = '';

    $user_id = $_SESSION['id'];
    $id = $_POST['project_id'];
    if (isset($_POST['share'])) { $share = '1'; } else { $share = '0'; }
    if (isset($_POST['edit'])) { $edit = '1'; } else { $edit = '0'; }
    $current_project = $_POST['project_id'];
    $project_name = $_POST['project_name'];

    $row = [];
    $row['user_id']   = $_SESSION['id'];
    $row['project_name'] = $_POST['project_name'];
    $email = $_POST['user_email'];

    // validation 
    if (empty($email)) {
      $li .= '<li>Not much I can do without an email address.</li>';
      $class .= 'red';
      $eclass = 'red';
      $signal = 'bad';
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $li .= '<li>Email is invalid</li>';
      $class = 'red';
      $eclass = 'red';
      $signal = 'bad';
    }

    if ($li === '') {

      $sql = "SELECT * FROM project_user WHERE ";
      $sql .= "shared_with='" . db_escape($db, $user_id) . "' ";
      $sql .= "AND project_id='" . db_escape($db, $current_project) . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $last_check = mysqli_fetch_assoc($result);

      if (isset($last_check['shared_with'])) { 
      /* one last check to make sure this user wasn't removed from project before trying to share it (since they've been logged in to the share_projects.php page) */

        /* make sure email actually exists in db */
        $sql1 = "SELECT * FROM users WHERE "; 
        $sql1 .= "email='" . db_escape($db, $email) . "' ";
        $sql1 .= "LIMIT 1";

        $result1 = mysqli_query($db, $sql1);
        confirm_result_set($result1);
        $row1 = mysqli_fetch_assoc($result1); 
        /* assign users table content to the specific user whose email has been entered */

        if (isset($row1['email']) && ($row1['user_id'] != $user_id)) { 
          /* email exists and does not belong to the user submitting the request. */
          $share_with = $row1['user_id']; 
          /* ^ here's the user's id whose email was just submitted. let's make sure they don't already have this project shared with them. */
          $sql2 = "SELECT p_u.project_id, p_u.owner_id, p_u.shared_with, u.* ";
          $sql2 .= "FROM project_user as p_u ";
          $sql2 .= "LEFT JOIN users as u ON u.user_id=p_u.shared_with "; 
          $sql2 .= "WHERE p_u.project_id='" . db_escape($db, $id) . "' ";

          $sql2 .= "AND (p_u.shared_with='" . db_escape($db, $share_with) . "' ";
          $sql2 .= "OR p_u.owner_id='" . db_escape($db, $share_with) . "') ";

          $sql2 .= "LIMIT 1";

          $result2 = mysqli_query($db, $sql2);
          confirm_result_set($result2);
          $row2 = mysqli_fetch_assoc($result2);
          /* assign value of user that was found to new var '$row2' so it does not interfere w/$row1 */

          if ($result2) {
            if (isset($row2['owner_id']) && ($row2['owner_id'] == $share_with)) {
              $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' is the owner of this project.</li>';
              $class = 'red';
              $signal = 'bad';
            } else if (isset($row2['shared_with']) && ($row2['shared_with'] == $share_with)) {
              $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' is already a member of this project.</li>';
              $class = 'red';
              $signal = 'bad';

            } else { 
         /* ^ if (isset($row2['email'])) */
              /* keep going, everything good so far. user is unique and does not have the project shared with them already. */
              $sql3 = "INSERT INTO project_user ";
              $sql3 .= "(project_id, owner_id, shared_with, share, edit) ";
              $sql3 .= "VALUES ("; 
              $sql3 .= "'" . db_escape($db, $current_project)    . "', ";
              $sql3 .= "'" . db_escape($db, $user_id) . "', ";
              $sql3 .= "'" . db_escape($db, $share_with) . "', ";
              $sql3 .= "'" . db_escape($db, $share) . "', ";
              $sql3 .= "'" . db_escape($db, $edit) . "'";
              $sql3 .= ")";

              $result3 = mysqli_query($db, $sql3);

              if ($result3) {
              /* new member was successfully added to project. now let's prepare the results of all shared members to update the list on the page. */

                $sharing = show_shared_with_info($user_id, $_POST['project_id']); 
                $i = 0;
                while ($row3 = mysqli_fetch_assoc($sharing)) { 
                  $names[]  = '<li><form class="edit-user" method="post">';
                  $names[]  .= $row3['first_name'] . ' ' . $row3['last_name'] . ' | ' . $row3['email'];
                  $names[]  .= '<input type="hidden" id="'.$i.'_dsuser" name="delete-shared-user" value="' . $row3['shared_with'] . '">';
                  $names[]  .= '<input type="hidden" id="'.$i.'_project_id" name="project_id" value="' .  $row3['project_id'] . '">';


                  $names[]  .= '<input type="hidden" id="'.$i.'_edit" name="'.$i.'_edit" value="';
                  if ($row3['edit'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
                  $names[]  .= '">';

                  $names[]  .= '<input type="hidden" id="'.$i.'_share" name="'.$i.'_share" value="';
                  if ($row3['share'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
                  $names[]  .= '">';


                  $names[]  .= '<input type="hidden" id="'.$i.'_project_name" name="project_name" value="' . $project_name . '">';
                  $names[]  .= '<input type="hidden" id="'.$i.'_username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">';
                  $names[]  .= '<a data-id="'.$i.'" class="rsu editshareduser">Edit</a>';
                  $names[]  .= '</form><span>Permissions: ';
                  if ($row3['share'] == 0 && $row3['edit'] == 0) { $names[]  .= 'View only'; }
                  if ($row3['edit'] == 1) { $names[]  .= 'Can edit'; }
                  if ($row3['share'] == 1 && $row3['edit'] == 1) { $names[]  .= ' + '; }
                  if ($row3['share'] == 1) { $names[]  .= 'Can share'; }
                  $names[]  .= '</span></li>'; 
                  $i++;
                } 

                $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' ';
                $li .= 'has successfully been added to the project, "' . $project_name . '".</li>';
                $class = 'green';
                if (isset($names)) { $shared_names .= implode($names); }
                // $shared_names .= implode($names);
                $signal = 'ok';

              } else {
           /* ^ if ($result3) */
                $li .= '<li>' .  mysqli_error($db) . '</li>';
                $class = 'red';
                $signal = 'bad';
              }
            }
          } else {
       /* ^ if ($result2) */
            $li .= '<li>' .  mysqli_error($db) . '</li>';
            $class = 'red';
            $signal = 'bad';
          }     

        } else {
     /* ^ if (isset($row1['email']) && ($row1['user_id'] != $user_id)) */

          if (!isset($row1['email'])) {
            $li .= '<li>The address, "' . $email . '" does not exist around here.</li>';
            $class .= 'red';
            $eclass .= 'red';
            $signal = 'bad';
          } else if (isset($row1['user_id']) && ($row1['user_id'] == $user_id)) {
            $li .= '<li>One is the lonliest number. You can\'t share a project with yourself.</li>';
            $class = 'red';
            $signal = 'bad';
          } else {
            $li .= '<li>' .  mysqli_error($db) . '</li>';
            $class = 'red';
            $signal = 'bad';

          }
        }
      } else {

        $li .= '<li>You were removed from this project since you\'ve been on this page. Nothing will work for you pertaining to this project any longer.</li>';
        $class = 'red';
        $signal = 'bad';
      }
    } /* if ($li === '') */

  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class,
    'eclass' => $eclass,
    'shared_names' => $shared_names
  );
  echo json_encode($data);

  } /* if (isset($_POST['sharer-share-submit'])) */


  if (isset($_POST['updateshareduser'])) {
    $id = $_POST['project_id'];
    $update_this_user = $_POST['esuser'];
    $edit = $_POST['edit'];
    $share = $_POST['share'];
    $user_id = $_SESSION['id'];
    $li = '';
    $shared_names = '';

    global $db;

    $sql = "UPDATE project_user SET ";
    $sql .= "edit='" . db_escape($db, $edit) . "', ";
    $sql .= "share='" . db_escape($db, $share) . "' ";
    $sql .= "WHERE project_id='" . db_escape($db, $id) . "' ";
    $sql .= "AND (owner_id='" . db_escape($db, $update_this_user) . "' ";
    $sql .= "OR shared_with='" . db_escape($db, $update_this_user). "') ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

      if ($result) {

        $is_it_shared = is_this_project_shared($_POST['project_id']); 
        $result3 = mysqli_num_rows($is_it_shared);
        if ($result3 > 0) { 

          $sharing = show_shared_with_info($user_id, $_POST['project_id']);
          $i = 0; 
          while ($row3 = mysqli_fetch_assoc($sharing)) { 
            $names[]  = '<li><form class="edit-user" method="post">';
            $names[]  .= $row3['first_name'] . ' ' . $row3['last_name'] . ' | ' . $row3['email'];
            $names[]  .= '<input type="hidden" id="'.$i.'_dsuser" name="delete-shared-user" value="' . $row3['shared_with'] . '">';
            $names[]  .= '<input type="hidden" id="'.$i.'_project_id" name="project_id" value="' .  $row3['project_id'] . '">';


            $names[]  .= '<input type="hidden" id="'.$i.'_edit" name="'.$i.'_edit" value="';
            if ($row3['edit'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
            $names[]  .= '">';

            $names[]  .= '<input type="hidden" id="'.$i.'_share" name="'.$i.'_share" value="';
            if ($row3['share'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
            $names[]  .= '">';


            $names[]  .= '<input type="hidden" id="'.$i.'_project_name" name="project_name" value="' . $_POST['project_name'] . '">';
            $names[]  .= '<input type="hidden" id="'.$i.'_username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">';
            $names[]  .= '<a data-id="'.$i.'" class="rsu editshareduser">Edit</a>';
            $names[]  .= '</form><span>Permissions: ';
            if ($row3['share'] == 0 && $row3['edit'] == 0) { $names[]  .= 'View only'; }
            if ($row3['edit'] == 1) { $names[]  .= 'Can edit'; }
            if ($row3['share'] == 1 && $row3['edit'] == 1) { $names[]  .= ' + '; }
            if ($row3['share'] == 1) { $names[]  .= 'Can share'; }
            $names[]  .= '</span></li>'; 
            $i++; 
          } 
        /* below - $_POST['username'] is really first_name + last_name */
        $li .= '<li>You have successfully updated ' . $_POST['username'] . '\'s permissions on the project, "' . $_POST['project_name'] . '".</li>';
        $class = 'orange';
        if (isset($names)) { $shared_names .= implode($names); }
        $signal = 'ok';

        } else {

          $li .= '<li>You have successfully updated ' . $_POST['username'] . '\'s permissions ';
          $li .= 'on the project, "' . $_POST['project_name'] . '".</li>';
          $class = 'orange';
          $shared_names .= '<li class="alone">Just me</li>';
          $signal = 'ok';
        }

      } else {
        $_SESSION['share-project'] = 'anothern';
        $li .= '<li>' . mysqli_error($db) . '</li>';
        $class = 'red';
        $signal = 'bad';

      }

  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class,
    'shared_names' => $shared_names
  );
  echo json_encode($data);

  }


  if (isset($_POST['delete-shared-user'])) {
    $id = $_POST['project_id'];
    $remove_this_user = $_POST['delete-shared-user'];
    $user_id = $_SESSION['id'];
    $li = '';
    $shared_names = '';

    global $db; 
    $sql = "DELETE FROM project_user ";
    $sql .= "WHERE project_id='" . $id . "' ";
    $sql .= "AND shared_with='" . $remove_this_user . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

      if ($result) {

        $is_it_shared = is_this_project_shared($_POST['project_id']); 
        $result3 = mysqli_num_rows($is_it_shared);
        if ($result3 > 0) { 

          $sharing = show_shared_with_info($user_id, $_POST['project_id']);
          $i = 0; 
          while ($row3 = mysqli_fetch_assoc($sharing)) { 
            $names[]  = '<li><form class="edit-user" method="post">';
            $names[]  .= $row3['first_name'] . ' ' . $row3['last_name'] . ' | ' . $row3['email'];
            $names[]  .= '<input type="hidden" id="'.$i.'_dsuser" name="delete-shared-user" value="' . $row3['shared_with'] . '">';
            $names[]  .= '<input type="hidden" id="'.$i.'_project_id" name="project_id" value="' .  $row3['project_id'] . '">';


            $names[]  .= '<input type="hidden" id="'.$i.'_edit" name="'.$i.'_edit" value="';
            if ($row3['edit'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
            $names[]  .= '">';

            $names[]  .= '<input type="hidden" id="'.$i.'_share" name="'.$i.'_share" value="';
            if ($row3['share'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
            $names[]  .= '">';


            $names[]  .= '<input type="hidden" id="'.$i.'_project_name" name="project_name" value="' . $_POST['project_name'] . '">';
            $names[]  .= '<input type="hidden" id="'.$i.'_username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">';
            $names[]  .= '<a data-id="'.$i.'" class="rsu editshareduser">Edit</a>';
            $names[]  .= '</form><span>Permissions: ';
            if ($row3['share'] == 0 && $row3['edit'] == 0) { $names[]  .= 'View only'; }
            if ($row3['edit'] == 1) { $names[]  .= 'Can edit'; }
            if ($row3['share'] == 1 && $row3['edit'] == 1) { $names[]  .= ' + '; }
            if ($row3['share'] == 1) { $names[]  .= 'Can share'; }
            $names[]  .= '</span></li>'; 
            $i++;
          } 
        /* below - $_POST['username'] is really first_name + last_name */
        $li .= '<li>You have successfully removed ' . $_POST['username'] . ' from the project, "' . $_POST['project_name'] . '".</li>';
        $class = 'orange';
        if (isset($names)) { $shared_names .= implode($names); }
        $signal = 'ok';

        } else {

          $li .= '<li>You have successfully removed ' . $_POST['username'] . ' ';
          $li .= 'from the project, "' . $_POST['project_name'] . '".</li>';
          $class = 'orange';
          $shared_names .= '<li class="alone">Just me</li>';
          $signal = 'ok';
        }

      } else {
        $_SESSION['share-project'] = 'anothern';
        $li .= '<li>' . mysqli_error($db) . '</li>';
        $class = 'red';
        $signal = 'bad';

      }

  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class,
    'shared_names' => $shared_names
  );
  echo json_encode($data);

  }


  if (isset($_POST['remove_me'])) {
    global $db;

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

    $li = '';
    $class = '';
    $id = $_POST['project_id'];
    $remove_this_user = $_POST['remove_me']; 

    $sql = "DELETE FROM project_user ";
    $sql .= "WHERE project_id='" . $id . "' ";
    $sql .= "AND shared_with='" . $remove_this_user . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result === true) {
      if (isset($_SESSION['share-project'])) { unset($_SESSION['share-project']); }
      $_SESSION['view-proj-pg'] = 'anothern';
      $signal = 'ok';
    } else {

      $_SESSION['view-proj-pg'] = 'anothern';
      $li .= '<li>' . mysqli_error($db) . '</li>';
      $class = 'red';
      $signal = 'bad';
    }
    $data = array(
      'signal' => $signal,
      'li' => $li,
      'class' => $class
    );
    echo json_encode($data);

  }


  if (isset($_POST['leave_project'])) {
    global $db;

    if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(1); }

    $li = '';
    $class = '';
    $id = $_POST['project_id'];
    $remove_this_user = $_POST['leave_project']; 

    $sql = "DELETE FROM project_user ";
    $sql .= "WHERE project_id='" . $id . "' ";
    $sql .= "AND shared_with='" . $remove_this_user . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    $_SESSION['view-proj-pg'] = 'anothern';
    $_SESSION['leaveproject'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);

  }

/* ******************* share project : end ************************ */ 






























/* footer contact: comments | questions | suggestions */
if (isset($_POST['contactbob'])) {
  $signal = '';
  $msg = '';
  $li = '';
  $class = '';
  $msg_txt = '';

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['comments']);

  // if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(3); }

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

    // if (WWW_ROOT == 'http://localhost/browsergadget') { sleep(2); }

    if (WWW_ROOT != 'http://localhost/browsergadget') {
      emailBob($name, $email, $message);
    }

    $signal = 'ok';

  }
  $data = array(
    'signal' => $signal,
    'msg' => $msg, 
    'li' => $li,
    'class' => $class
  );
  echo json_encode($data);
}




} // end if (is_post_request())