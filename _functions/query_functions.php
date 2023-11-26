<?php

function build_projects_navigation($user_id) { 
  global $db;
  $sql = "SELECT p_u.owner_id, p_u.shared_with, p_u.project_id, p.project_name "; 
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";
  $sql .= "WHERE p_u.owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "OR p_u.shared_with='" . db_escape($db, $user_id) . "' ";
  $sql .= "GROUP BY p_u.project_id ";
  $sql .= "ORDER BY project_name";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result;  
}


function find_users_projects($user_id) { // 12.29.20 rewritten
  global $db;
  // solution learned at: https://www.youtube.com/watch?v=2HVMiPPuPIM&ab_channel=JoeyBlue
  $sql = "SELECT u.first_name, u.last_name, u.admin, p_u.owner_id, p_u.shared_with, p_u.project_id, p_u.share, p_u.edit, p.id, p.project_name, p.project_notes "; 
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";
  $sql .= "LEFT JOIN users as u on u.user_id=p_u.owner_id ";
  $sql .= "WHERE p_u.owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "OR p_u.shared_with='" . db_escape($db, $user_id) . "' ";
  $sql .= "GROUP BY p_u.project_id ";
  $sql .= "ORDER BY project_name";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result;  
}











function update_color($user_id, $current_project) { 
  global $db;

  $sql = "SELECT p_u.color, p.id ";
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";
  $sql .= "WHERE p_u.project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "AND (p_u.owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "OR p_u.shared_with='" . db_escape($db, $user_id) . "') ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  return $row;  
}

















function assemble_current_project($user_id, $current_project) { 
  global $db;

  $sql = "SELECT p_u.color, p_u.project_id, p_u.owner_id, p_u.shared_with, p_u.search_order, p_u.reference, p_u.page_number, p_u.share, p_u.edit, p_u.edit_toggle, p.* ";
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";
  $sql .= "WHERE p_u.project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "AND (p_u.owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "OR p_u.shared_with='" . db_escape($db, $user_id) . "') ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  return $row;  
}


function is_this_project_shared($this_project) {
  global $db;

  $sql = "SELECT p_u.shared_with, p_u.project_id ";
  $sql .= "FROM project_user as p_u ";
  $sql .= "WHERE p_u.shared_with IS NOT NULL AND ";
  $sql .= "p_u.project_id='" . db_escape($db, $this_project) . "' ";
  $sql .= "ORDER BY p_u.shared_with ASC";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;  
}


function show_shared_with_info($user_id, $this_project) { 
// this is for the owner of the project.
// who is the project shared with?
  global $db;

  $sql = "SELECT u.first_name, u.last_name, u.email, p_u.shared_with, p_u.project_id, p_u.share, p_u.edit ";
  $sql .= "FROM users as u ";
  $sql .= "LEFT JOIN project_user as p_u ON u.user_id=p_u.shared_with ";
  $sql .= "WHERE u.user_id=p_u.shared_with ";
  $sql .= "AND p_u.project_id='" . db_escape($db, $this_project) . "' ";
  $sql .= "AND p_u.shared_with!='" . db_escape($db, $user_id) . "' ";
  // $sql .= "GROUP BY u.user_id ";
  $sql .= "ORDER BY u.first_name ASC";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;  // returns an assoc. array 
}

function show_owner_info($this_project) { 
// this is NOT the owner - it is someone who has had the project
// shared with them. need to show them who owns the project AND
// who all the project is shared with.
  global $db;

  $sql = "SELECT u.first_name, u.last_name, p_u.owner_id, p_u.share, p_u.edit ";
  $sql .= "FROM users as u ";
  $sql .= "LEFT JOIN project_user as p_u ON u.user_id=p_u.owner_id ";
  $sql .= "WHERE p_u.project_id='" . db_escape($db, $this_project) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;  // returns an assoc. array 
}

function shared_or_owner($user_id, $current_project) {
  global $db;

  $sql = "SELECT shared_with from project_user ";
  $sql .= "WHERE shared_with='" . db_escape($db, $user_id) . "' ";
  $sql .= "AND project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function edit_search_order($user_id, $current_project) {
  global $db;

  $sql = "SELECT p_u.project_id, p_u.owner_id, p_u.shared_with, p_u.search_order, p_u.reference, p_u.edit, p_u.share, p.project_name ";
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";
  $sql .= "WHERE p_u.project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "AND (p_u.owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "OR p_u.shared_with='" . db_escape($db, $user_id) . "') ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  return $row;
}

function update_current_project($id, $current_project) { // 12.30.20 - checks out/no changes
  global $db;

  $sql = "UPDATE users SET current_project = '" . $current_project . "' ";

  $sql .= "WHERE user_id='"  . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  if($result === true) {
    return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}

function project_colormode_owner($user_id, $color, $current_project) { // 12.30.20 - checks out/no changes
  global $db;

  $sql = "UPDATE project_user SET color = '" . $color . "' ";

  $sql .= "WHERE owner_id='"  . db_escape($db, $user_id) . "' ";
  $sql .= "AND project_id='"  . $current_project . "' ";
  $sql .= "AND shared_with IS NULL ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  if($result === true) {
    return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}

function project_colormode_shared_with($user_id, $color, $current_project) { // 12.30.20 - checks out/no changes
  global $db;

  $sql = "UPDATE project_user SET color = '" . $color . "' ";

  $sql .= "WHERE shared_with='"  . db_escape($db, $user_id) . "' ";
  $sql .= "AND project_id='"  . $current_project . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  if($result === true) {
    return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}

// function add_note($row, $url) {
//   global $db;

//   $sql = "INSERT INTO notes ";
//   $sql .= "(user_id, project_id, name, url, note, sort, clipboard) ";
//   $sql .= "VALUES ("; 
//   $sql .= "'" . $row['user_id'] . "', ";
//   $sql .= "'" . db_escape($db, $row['project_id'])    . "', ";
//   $sql .= "'" . db_escape($db, $row['name'])    . "', ";
//   $sql .= "'" . db_escape($db, $url)    . "', ";
//   $sql .= "'" . db_escape($db, $row['note'])    . "', ";
//   $sql .= "'" . db_escape($db, $row['sort'])    . "', ";
//   $sql .= "'" . $row['clipboard']    . "'";
//   $sql .= ")";

//   $result = mysqli_query($db, $sql);
//   // echo $sql;  
//   if ($result) {
//     return true;
//   } else {
//     echo mysqli_error($db);
//     db_disconnect($db);
//     exit;
//   }
// }

function modify_note($row, $this_note, $url) {
  global $db;

  $sql = "UPDATE notes SET "; 
  $sql .= "name='" . db_escape($db, h($row['name']))    . "', ";
  $sql .= "url='" . db_escape($db, $url)    . "', ";
  $sql .= "note='" . db_escape($db, h($row['note']))    . "', ";
  $sql .= "clipboard='" . $row['clipboard']    . "' ";
  $sql .= "WHERE note_id='"  . $this_note . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);  

  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_project_notes($user_id, $current_project) {
  global $db;

  $sql = "SELECT * FROM notes WHERE ";
  $sql .= "user_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "AND project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "ORDER BY sort ASC";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result; // returns an assoc. array    
}

// function delete_note($note_id) {
//   global $db;
 
//   $sql = "DELETE FROM notes ";
//   $sql .= "WHERE note_id='" . $note_id . "' ";
//   $sql .= "LIMIT 1";

//   $result = mysqli_query($db, $sql);

//   if($result) {
//     header('location:' . WWW_ROOT);
//   } else {
//     // delete failed
//     mysqli_error($db);
//     db_disconnect($db);
//     exit;
//   }
// }


// 1222202024
function update_users_current_project($new_id, $user_id) {
  global $db;

  $sql = "UPDATE users SET ";
  $sql .= "current_project ='" . $new_id . "' ";
  $sql .= "WHERE user_id='"  . $user_id . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // echo $sql;  

  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

// used on home_logged_in.php to see where to direct this user
function does_user_have_a_single_project($user_id) {
  global $db;

  $sql = "SELECT * from project_user ";
  $sql .= "WHERE shared_with='" . db_escape($db, $user_id) . "' ";
  $sql .= "OR owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}






// function owner_share_project($row, $user_id, $id, $share, $edit, $current_project) { // coming in $row = $_POST values
//   global $db;
//   $email = $row['users_email'];

//   $errors = validate_share($row); // just making sure email field is not empty
//   if (!empty($errors)) {          // if not, keep going...
//     return $errors;
//   }

//   $sql = "SELECT * FROM users WHERE "; // making sure email actually exists in db
//   $sql .= "email='" . db_escape($db, $row['users_email']) . "' ";
//   $sql .= "LIMIT 1";

//   $result = mysqli_query($db, $sql);
//   confirm_result_set($result);
//   $row = mysqli_fetch_assoc($result); // assigning users table content to the specific
//                                       // user whose email has been entered

//     if (isset($row['email']) && ($row['user_id'] != $user_id)) { // email exists and does not
//       // belong to the user submitting the request.
//       $share_with = $row['user_id']; // here's the user's id whose email was just submitted.
//       // let's make sure they don't already have this project shared with them.

//       $sql = "SELECT p_u.project_id, p_u.shared_with, p_u.owner_id, u.* ";
//       $sql .= "FROM project_user as p_u ";
//       $sql .= "LEFT JOIN users as u ON u.user_id=p_u.shared_with "; // needs to prevent being shared with same user multiple times.
//       $sql .= "WHERE p_u.project_id='" . db_escape($db, $id) . "' ";
//       $sql .= "AND (p_u.shared_with='" . db_escape($db, $share_with) . "' ";
//       $sql .= "OR p_u.owner_id='" . db_escape($db, $share_with) . "') ";
//       $sql .= "LIMIT 1";

//       $result = mysqli_query($db, $sql);
//       confirm_result_set($result);
//       $row2 = mysqli_fetch_assoc($result); // assign value of user that was found to 
//                                            // new var '$row2' so it does not interfere w/$row

//       if ($result) { // send user's info to validation to throw personalized error

//         $errors = validate_unique($row2);
//         if (!empty($errors)) {
//         return $errors;

//       } else {
//         // keep going, everything good so far. user is unique and does not have the
//         // project shared with them already.
//         $sql = "INSERT INTO project_user ";
//         $sql .= "(project_id, owner_id, shared_with, share, edit) ";
//         $sql .= "VALUES ("; 
//         $sql .= "'" . db_escape($db, $current_project)    . "', ";
//         $sql .= "'" . db_escape($db, $user_id) . "', ";
//         $sql .= "'" . db_escape($db, $share_with) . "', ";
//         $sql .= "'" . db_escape($db, $share) . "', ";
//         $sql .= "'" . db_escape($db, $edit) . "'";
//         $sql .= ")";

//         $result = mysqli_query($db, $sql);
//         if ($result) {
//           return true;
//         } else {
//           echo mysqli_error($db);
//           db_disconnect($db);
//           exit;
//         }
//       }
//     }
//   } else {
//     $errors = validate_email($email, $row, $user_id);
//     if (!empty($errors)) {
//       return $errors;
//     }
//   }
// }

// function sharer_share_projectzzzz($row, $user_id, $id, $share, $edit, $current_project) { // coming in $row = $_POST values
//   global $db;
//   $email = $row['users_email'];

//   $errors = validate_share($row); // just making sure email field is not empty
//   if (!empty($errors)) {          // if not, keep going...
//     return $errors;
//   }


//   $sql = "SELECT * FROM project_user WHERE ";
//   $sql .= "shared_with='" . db_escape($db, $user_id) . "' ";
//   $sql .= "AND project_id='" . db_escape($db, $current_project) . "' ";
//   $sql .= "LIMIT 1";

//   $result = mysqli_query($db, $sql);
//   confirm_result_set($result);
//   $last_check = mysqli_fetch_assoc($result);

//   if (isset($last_check['shared_with'])) { // one last check to make sure this user wasn't removed from
//                                     // project before trying to share it (since they've been logged
//                                     // in to the share_projects.php page)

//     $sql = "SELECT * FROM users WHERE "; // making sure email actually exists in db
//     $sql .= "email='" . db_escape($db, $row['users_email']) . "' ";
//     $sql .= "LIMIT 1";

//     $result = mysqli_query($db, $sql);
//     confirm_result_set($result);
//     $row = mysqli_fetch_assoc($result); // assigning users table content to the specific
//                                         // user whose email has been entered

//       if (isset($row['email']) && ($row['user_id'] != $user_id)) { // email exists and does not
//         // belong to the user submitting the request.
//         $share_with = $row['user_id']; // here's the user's id whose email was just submitted.
//         // let's make sure they don't already have this project shared with them.

//         $sql = "SELECT p_u.project_id, p_u.owner_id, p_u.shared_with, u.* ";
//         $sql .= "FROM project_user as p_u ";
//         $sql .= "LEFT JOIN users as u ON u.user_id=p_u.owner_id "; // needs to prevent being shared with owner.
//         $sql .= "WHERE p_u.project_id='" . db_escape($db, $id) . "' ";
//         $sql .= "AND (p_u.shared_with='" . db_escape($db, $share_with) . "' ";
//         $sql .= "OR p_u.owner_id='" . db_escape($db, $share_with) . "') ";
//         $sql .= "LIMIT 1";

//         $result = mysqli_query($db, $sql);
//         confirm_result_set($result);
//         $row2 = mysqli_fetch_assoc($result); // assign value of user that was found to 
//                                              // new var '$row2' so it does not interfere w/$row

//         if ($result) { // send user's info to validation to throw personalized error

//           $errors = validate_unique_from_shared($row2);
//           if (!empty($errors)) {
//           return $errors;

//         } else {
//           // keep going, everything good so far. user is unique and does not have the
//           // project shared with them already.
//           $sql = "INSERT INTO project_user ";
//           $sql .= "(project_id, owner_id, shared_with, share, edit) ";
//           $sql .= "VALUES ("; 
//           $sql .= "'" . db_escape($db, $current_project)    . "', ";
//           $sql .= "'" . db_escape($db, $user_id) . "', ";
//           $sql .= "'" . db_escape($db, $share_with) . "', ";
//           $sql .= "'" . db_escape($db, $share) . "', ";
//           $sql .= "'" . db_escape($db, $edit) . "'";
//           $sql .= ")";

//           $result = mysqli_query($db, $sql);
//           if ($result) {
//             return true;
//           } else {
//             echo mysqli_error($db);
//             db_disconnect($db);
//             exit;
//           }
//         }
//       }
//     } else {
//       $errors = validate_email($email, $row, $user_id);
//       if (!empty($errors)) {
//         return $errors;
//       }
//     }

//   } else {
//     $errors = user_removed();
//     if (!empty($errors)) {
//       return $errors;
//     }
//   }

// }

function user_removed() {
  $errors = [];

  if (!isset($row['shared_with'])) {
    $errors['not_here'] = "You were removed from this project since you've been on this page. Nothing will work for you pertaining to this project any longer.";
  }
  return $errors;
}

function validate_share($row) {
  $errors = [];

  if (is_blank($row['users_email'])) {
    $errors['email_error'] = "Do you intend to share \"" . $row['project_name'] . "\" with your invisible friend? Please provide an email address.";
  }
  return $errors; 
}


function validate_email($email, $row, $user_id) {
  $errors = [];

  if (!isset($row['email'])) {
    $errors['email_error'] = "The address, \"" . $email . "\" does not exist around here.";
  }

  if (isset($row['user_id']) && ($row['user_id'] == $user_id)) {
    $errors['email_error'] = "One is the loneliest number. You can't share with yourself.";
  }

  return $errors;
}

function validate_unique($row2) {
  $errors = [];

  if (isset($row2['email'])) {
    $errors['email_error'] = $row2['first_name'] . " " . substr($row2['last_name'], 0, 1) . ". is already a member of this project.";
  }
  return $errors; 
}

function validate_unique_from_shared($row2) {
  $errors = [];

  if (isset($row2['email'])) {
    $errors['email_error'] = "That user is already a member of this project.";
  }
  return $errors; 
}

function find_user_by_email($users_email) {
  global $db;

  $sql = "SELECT * FROM users WHERE ";
  $sql .= "email='" . db_escape($db, $users_email) . "' ";
  $sql .= "LIMIT 1";

  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $user;  // returns an assoc. array    
}


function show_project($current_project) {
  global $db;

  $sql = "SELECT p_u.project_id, p_u.owner_id, p_u.search_order, p_u.reference, p_u.page_number, p_u.share, p_u.edit, u.first_name, u.last_name, u.user_id, p.* ";
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p_u.project_id=p.id ";
  $sql .= "LEFT JOIN users as u on p_u.owner_id=u.user_id ";
  $sql .= "WHERE p_u.project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql; 
  $result = mysqli_query($db, $sql); 
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  return $row;   
}

function show_project_to_owner($current_project) {
  global $db;

  $sql = "SELECT p_u.project_id, p_u.owner_id, p_u.page_number, p_u.share, p_u.edit, u.first_name, u.last_name, u.user_id, p.* ";
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";

  $sql .= "LEFT JOIN users as u on u.user_id=p_u.owner_id ";

  $sql .= "WHERE p_u.project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql; 
  $result = mysqli_query($db, $sql); 
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  // mysqli_free_result($result);
  return $row;   
}

function show_project_to_shared($current_project, $user_id) {
  global $db;

  $sql = "SELECT p_u.project_id, p_u.owner_id, p_u.shared_with, p_u.page_number, p_u.share, p_u.edit, u.first_name, u.last_name, u.user_id, p.* ";
  $sql .= "FROM projects as p ";
  $sql .= "LEFT JOIN project_user as p_u ON p.id=p_u.project_id ";

  $sql .= "LEFT JOIN users as u on u.user_id=p_u.shared_with ";

  $sql .= "WHERE p_u.project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "AND p_u.shared_with='" . db_escape($db, $user_id) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql; 
  $result = mysqli_query($db, $sql); 
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  // mysqli_free_result($result);
  return $row;   
}


function owner_or_shared_with($current_project, $user_id) {
  global $db;

  $sql = "SELECT * FROM project_user ";
  $sql .= "WHERE owner_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "AND project_id='" . db_escape($db, $current_project) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql); 
  confirm_result_set($result);
  return $result;
}

function validate_update($row) {

if (!is_blank($row['name']) && has_length_greater_than($row['name'], 30)) {
    $errors['name'] = "more than 3 characters? hope this works!";
  }

  $errors = [];
  return $errors; 
}


function update_page_number_shared_with($user_id, $current_project, $page_number) {
  global $db;

  $sql = "UPDATE project_user SET ";
  $sql .= "page_number='"  . $page_number . "' ";
  $sql .= "WHERE project_id='"  . db_escape($db, $current_project) . "' ";
  $sql .= "AND shared_with='"  . db_escape($db, $user_id) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // UPDATE statements are true/false
  if($result === true) {
    return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}

function update_page_number_owner($user_id, $current_project, $page_number) {
  global $db;

  $sql = "UPDATE project_user SET ";
  $sql .= "page_number='"  . $page_number . "' ";
  $sql .= "WHERE project_id='"  . db_escape($db, $current_project) . "' ";
  $sql .= "AND owner_id='"  . db_escape($db, $user_id) . "' ";
  $sql .= "AND shared_with IS NULL ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // UPDATE statements are true/false
  if($result === true) {
    return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}


function update_project_deets($current_project, $row) {
  global $db;

  $errors = validate_project_update($row);
  if (!empty($errors)) {
    return $errors;
  }   
  // only an owner can do this
  $sql = "UPDATE projects SET ";
  $sql .= "project_name='"  . db_escape($db, $row['project_name'])  . "', ";
  $sql .= "project_notes='"   . db_escape($db, $row['project_notes'])   . "' ";
  $sql .= "WHERE id='"  . db_escape($db, $current_project) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // UPDATE statements are true/false
  if($result === true) {
    return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}


function update_row_order($current_project, $row) {
  global $db;

  $sql = "UPDATE projects SET ";
  $sql .= "row_order='"       . $row['row_order']           . "' ";
  $sql .= "WHERE id='"  . db_escape($db, $current_project) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // UPDATE statements are true/false
  if($result === true) {
    return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}

function delete_project($current_project, $vamoose) {
  global $db;

  $errors = validate_delete($vamoose); 
  if (!empty($errors)) {
    return $errors;
  }  

  $sql = "DELETE FROM projects ";
  $sql .= "WHERE id='" . $current_project . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result) {
    // send back to my_projects.php with ds=1 in 
    // order to allow $_GET to echo a success msg
    $_SESSION['ds'] = 'ds-success';
    header('location: my_projects.php');
    exit;
  } else {
    $errors = mysqli_error($db);
    return $errors;
  }
}

function remove_shared_user($id, $remove_this_user) {
  global $db; 

  $sql = "DELETE FROM project_user ";
  $sql .= "WHERE project_id='" . $id . "' ";
  $sql .= "AND shared_with='" . $remove_this_user . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result) {
    header('location: share_project.php?id=' . $id);
  } else {
    // delete failed
    mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function remove_me($id, $remove_this_user) {
  global $db; 

  $sql = "DELETE FROM project_user ";
  $sql .= "WHERE project_id='" . $id . "' ";
  $sql .= "AND shared_with='" . $remove_this_user . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  return $result;
}


function validate_delete($vamoose) {

  $errors = [];

  if ($vamoose !== "Delete") {
    $errors['row_order'] = "You've got to type \"Delete\" (capital \"D\") just like it says. We don't want any accidental deletions around here.";
  }

  return $errors; 
}

function validate_project_update($row) {

  $errors = [];

  if (is_blank($row['project_name'])) {
    $errors['project_name'] = "Cannot leave Project Name empty.";
  }

  if (has_length_greater_than($row['project_notes'], 1500)) {
    $errors['project_notes'] = "Contain the beast! Project notes cannot exceed 1,500 characters.";
  }

  return $errors; 
}


function is_blank($value) {
	
  return !isset($value) || trim($value) === '';
}

function has_presence($value) {
	
  return !is_blank($value);
}

// has_length_greater_than('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_greater_than($value, $min) {
  $length = strlen($value);
  return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_less_than($value, $max) {
  $length = strlen($value);
  return $length < $max;
}
// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function has_length($value, $options) {
  if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
    return false;
  } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
    return false;
  } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
    return false;
  } else {
    return true;
  }
}