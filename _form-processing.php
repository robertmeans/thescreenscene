<?php
require_once 'config/initialize.php';

if (is_post_request()) {

  // go to 'View Projects Page' link from main navigation
  if (isset($_POST['viewprojectspage'])) {
    $_SESSION['view-proj-pg'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }


  // 'Go to homepage' link - works everywhere
  if (isset($_POST['go_to_homepage'])) {
    $id = $_POST['user_id'];
    $current_project = $_POST['current_project'];

    $result = update_current_project($id, $current_project);

    if ($result === true) {
      $_SESSION['current_project'] = $current_project;
      $signal = 'ok';
      echo json_encode($signal);
    } 
  }


  // 'Organize search fields' link -> edit_searches.php 
  if (isset($_POST['organizesearchfields'])) {

    if (isset($_POST['current_project'])) {
      $id = $_SESSION['id'];               ;
      $current_project = $_POST['current_project'];
      $result = update_current_project($id, $current_project);

      if ($result === true) {
        $_SESSION['current_project'] = $current_project;
        $_SESSION['organize'] = 'anothern';

        $signal = 'ok';
        echo json_encode($signal); 
      }

    } else {
      $_SESSION['organize'] = 'anothern';
      $signal = 'ok';
      echo json_encode($signal);
    } 
  } 


  // 'Rearrange bookmarks' link -> edit_order.php
  if (isset($_POST['rearrangebookmarks'])) {
    $_SESSION['order'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }



  // 'Share project' link -> share_project.php 
  if (isset($_POST['shareproject'])) {

    if (isset($_POST['current_project'])) {
      $id = $_SESSION['id'];               ;
      $current_project = $_POST['current_project'];
      $result = update_current_project($id, $current_project);

      if ($result === true) {
        $_SESSION['current_project'] = $current_project;
        $_SESSION['share-project'] = 'anothern';

        $signal = 'ok';
        echo json_encode($signal); 
      }

    } else {
      $_SESSION['share-project'] = 'anothern';
      $signal = 'ok';
      echo json_encode($signal);
    } 
  } 



  // 'Start a new project' link to get to -> new_project.php
  if (isset($_POST['startanewproject'])) {

    if (isset($_POST['inner_nav'])) {
      $_SESSION['another-proj'] = 'anothern';
      $_SESSION['backtohomepage'] = 'yo';
      $signal = 'ok';
      echo json_encode($signal);

    } else if (isset($_POST['my_projects'])) {
      $_SESSION['another-proj'] = 'anothern';
      $_SESSION['backtomyprojects'] = 'yo';
      $signal = 'ok';
      echo json_encode($signal);

    } else if (isset($_POST['newprojcancelbtn'])) {
      $_SESSION['another-proj'] = 'anothern';
      $_SESSION['newprojectcancelbtn'] = 'yo';

      $signal = 'ok';
      echo json_encode($signal); 
    }
    
  }





  // 'Project name & notes' (edit_project_details.php). trigger in: my_projects.php: .epd-link
  if (isset($_POST['editprojectdetails'])) {

    $id = $_SESSION['id'];
    $current_project = $_POST['current_project'];
    $result = update_current_project($id, $current_project);

    if ($result === true) {
      $_SESSION['current_project'] = $current_project;
      $_SESSION['editprojdeets'] = 'anothern';

      $signal = 'ok';
      echo json_encode($signal);
    }

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

  



















/* ******************* share project stuff ************************ */
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
      $eclass .= 'red';
      $signal = 'bad';
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $li .= '<li>Email is invalid</li>';
      $class = 'red';
      $eclass .= 'red';
      $signal = 'bad';
    }

    if ($li === '') {

      $sql = "SELECT * FROM users WHERE "; // making sure email actually exists in db
      $sql .= "email='" . db_escape($db, $email) . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $row = mysqli_fetch_assoc($result); // assigning users table content to the specific
                                      // user whose email has been entered

      if (isset($row['email']) && ($row['user_id'] != $user_id)) { // email exists and does not
        // belong to the user submitting the request.
        $share_with = $row['user_id']; // here's the user's id whose email was just submitted.
        // let's make sure they don't already have this project shared with them.

        $sql = "SELECT p_u.project_id, p_u.shared_with, p_u.owner_id, u.* ";
        $sql .= "FROM project_user as p_u ";
        $sql .= "LEFT JOIN users as u ON u.user_id=p_u.shared_with "; // needs to prevent being shared with same user multiple times.
        $sql .= "WHERE p_u.project_id='" . db_escape($db, $id) . "' ";
        $sql .= "AND (p_u.shared_with='" . db_escape($db, $share_with) . "' ";
        $sql .= "OR p_u.owner_id='" . db_escape($db, $share_with) . "') ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $row2 = mysqli_fetch_assoc($result); // assign value of user that was found to 
                                             // new var '$row2' so it does not interfere w/$row

        if ($result) { 
          if (isset($row2['email'])) {
            $li .= '<li>' . $row2['first_name'] . ' ' . $row2['last_name'] . ' is already a member of this project.</li>';
            $class .= 'red';
            $signal = 'bad';
            } else { 

          // keep going, everything good so far. user is unique and does not have the
          // project shared with them already.
          $sql = "INSERT INTO project_user ";
          $sql .= "(project_id, owner_id, shared_with, share, edit) ";
          $sql .= "VALUES ("; 
          $sql .= "'" . db_escape($db, $current_project)    . "', ";
          $sql .= "'" . db_escape($db, $user_id) . "', ";
          $sql .= "'" . db_escape($db, $share_with) . "', ";
          $sql .= "'" . db_escape($db, $share) . "', ";
          $sql .= "'" . db_escape($db, $edit) . "'";
          $sql .= ")";

          $result = mysqli_query($db, $sql);

          if ($result) {










            // $this_project = $_POST['project_id'];
            $is_it_shared = is_this_project_shared($_POST['project_id']); // problem - not calling first_name, last_name, email
            $result = mysqli_num_rows($is_it_shared); // did we find any shared results? if so...

            if ($result > 0) { 

              $sharing = show_shared_with_info($user_id, $_POST['project_id']); 
              while ($row = mysqli_fetch_assoc($sharing)) { 
                $names[] = '<li><form class="edit-user" method="post">' . $row['first_name'] . ' ' . $row['last_name'] . ' (' . $row['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row['shared_with'] . '">
                          <div>
                          <input type="hidden" id="project_id" name="project_id" value="' .  $row['project_id'] . '">
                          <input type="hidden" id="username" name="username" value="' . $row['first_name'] . ' ' . $row['last_name'] . '">
                          <a class="removeshareduser">Remove</a>
                          </div>
                        </form></li>';
              } 

            $li .= '<li>' . $row['first_name'] . ' ' . $row['last_name'] . ' has successfully been added to the project, "' . $project_name . '".</li>';
            $class .= 'green';
            $shared_names .= implode($names);
            $signal = 'ok';

            } else {

              $sharing = show_shared_with_info($user_id, $_POST['project_id']);
              $row = mysqli_fetch_assoc($sharing);




            $li .= '<li>' . $row['first_name'] . ' ' . $row['last_name'] . ' has successfully been added to the project, "' . $project_name . '".</li>';
            $class .= 'green';
            $shared_names .= '<li><form class="edit-user" method="post">' . $row['first_name'] . ' ' . $row['last_name'] . ' (' . $row['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row['shared_with'] . '">
                          <div>
                          <input type="hidden" id="project_id" name="project_id" value="' .  $row['project_id'] . '">
                          <input type="hidden" id="username" name="username" value="' . $row['first_name'] . ' ' . $row['last_name'] . '">
                          <a class="removeshareduser">Remove</a>
                          </div>
                        </form></li>';
            $signal = 'ok';

          }







          } else {
            $li .= '<li>' .  mysqli_error($db) . '</li>';
            $class .= 'red';
            $signal = 'bad';

          }

        }

      }


      } else {

        if (!isset($row['email'])) {
          $li .= '<li>The address, "' . $email . '" does not exist around here.</li>';
          $class .= 'red';
          $eclass .= 'red';
          $signal = 'bad';
        }
        if (isset($row['user_id']) && ($row['user_id'] == $user_id)) {
          $li .= '<li>One is the lonliest number. You can\'t share a project with yourself.</li>';
          $class .= 'red';
          $signal = 'bad';
        }
      }

  }


  $data = array(
    'signal' => $signal,
    'li' => $li,
    'class' => $class,
    'eclass' => $eclass,
    'shared_names' => $shared_names
  );
  echo json_encode($data);

  }
























  if (isset($_POST['delete-shared-user'])) {
    $id = $_POST['project_id'];
    $remove_this_user = $_POST['delete-shared-user'];
    $shared_names = '';

    global $db; 

    $sql = "DELETE FROM project_user ";
    $sql .= "WHERE project_id='" . $id . "' ";
    $sql .= "AND shared_with='" . $remove_this_user . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if ($result) {
      $_SESSION['share-project'] = 'anothern';
      $li .= 'You have successfully removed ' . $_POST['fullname'] . ' from the project "' . $_POST['project******_name'] . '"';
      $shared_names .= '';
      $class .= 'green';
      $signal = 'ok'; 
    } else {
      $_SESSION['share-project'] = 'anothern';
      $li .= '<li>' . mysqli_error($db) . '</li>';
      $class .= 'red';
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































  if (isset($_POST['sharer-share-submit'])) {

    $row = [];
    $row['user_id']   = $user_id;
    $row['project_name'] = $_POST['project_name'];
    $row['users_email'] = $_POST['user_email'];
    $share = $_POST['share'] ?? '0';
    $edit = $_POST['edit'] ?? '0';

    // $role  = $_POST['role']; // because $row[] gets repurposed in share_project() - below

    $result = sharer_share_project($row, $user_id, $id, $share, $edit, $current_project); // validate & execute

    if ($result === true) { // INSERT was a success - everything validated and user was added to 
                // project. let's add a happy little personalized success message
                // just to keep things over the top, of couse.

      $users_email = $_POST['user_email'];
      $user = find_user_by_email($users_email);

      $errors = [];
      $errors['successfully_added'] = "You have successfully added " . $user['first_name'] . " " . $user['last_name'] . " to the project \"" . $row['project_name'] . ".\"";

      $_SESSION['share-project-id'] = $_POST['project_id'];
      $_SESSION['share-project'] = 'anothern';
        $signal = 'ok';
        echo json_encode($signal);

    } else { 
      $errors = $result;
      $_SESSION['share-project-id'] = $_POST['project_id'];
      $_SESSION['share-project'] = 'anothern'; 
        $signal = '1552 fix this';
        echo json_encode($signal);

    }
  }



  if (isset($_POST['remove-self'])) {
    $remove_this_user = $_POST['delete-shared-user'];

    $result = remove_me($id, $remove_this_user);
      if ($result === true) {
        $_SESSION['share-project'] = 'anothern';
      } else {
        //$errors = $result; 
      }
  }




















} // end if (is_post_request())