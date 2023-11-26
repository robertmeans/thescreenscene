<?php
require_once 'config/initialize.php';

if (is_post_request()) {

  // 'View Projects Page' link
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
        $row = update_color($id, $current_project);
        $_SESSION['color'] = $row['color'];
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
        $row = update_color($id, $current_project);
        $_SESSION['color'] = $row['color'];
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
      $row = update_color($id, $current_project);
      $_SESSION['color'] = $row['color'];
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

              $is_it_shared = is_this_project_shared($_POST['project_id']); 
              $result3 = mysqli_num_rows($is_it_shared); 
              /* did we find any shared results? if so... */

              if ($result3 > 0) { 

                $sharing = show_shared_with_info($user_id, $_POST['project_id']); 
                while ($row3 = mysqli_fetch_assoc($sharing)) { 
                  $names[] = '<li><form class="edit-user" method="post">' . $row3['first_name'] . ' ' . $row3['last_name'] . ' (' . $row3['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row3['shared_with'] . '">
                    <input type="hidden" id="project_id" name="project_id" value="' .  $row3['project_id'] . '">
                    <input type="hidden" id="project_name" name="project_name" value="' . $project_name . '">
                    <input type="hidden" id="username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">
                    <a class="removeshareduser rsu">Remove</a>
                  </form></li>';
                } 

              $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' has successfully been added to the project, "' . $project_name . '".</li>';
              $class = 'green';
              $shared_names .= implode($names);
              $signal = 'ok';

              /* end if ($result3 > 0) - beyond this $result3 */
              } else {

                $sharing = show_shared_with_info($user_id, $_POST['project_id']);
                $row3 = mysqli_fetch_assoc($sharing);


                $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' has successfully been added to the project, "' . $project_name . '".</li>';
                $class = 'green';
                $shared_names .= '<li><form class="edit-user" method="post">' . $row3['first_name'] . ' ' . $row3['last_name'] . ' (' . $row3['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row3['shared_with'] . '">
                  <input type="hidden" id="project_id" name="project_id" value="' .  $row3['project_id'] . '">
                  <input type="hidden" id="project_name" name="project_name" value="' . $project_name . '">
                  <input type="hidden" id="username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">
                  <a class="rsu removeshareduser">Remove</a>
                </form></li>';
                $signal = 'ok';

            }

            /* end if ($result3) - beyond this $result3 does not exist */
          } else {
            $li .= '<li>' .  mysqli_error($db) . '</li>';
            $class = 'red';
            $signal = 'bad';

          }

        }

      } /* if ($result2) */

    } else {
 /* ^ ends: if (isset($row1['email']) && ($row1['user_id'] != $user_id)) */

      if (!isset($row1['email'])) {
        $li .= '<li>The address, "' . $email . '" does not exist around here.</li>';
        $class .= 'red';
        $eclass .= 'red';
        $signal = 'bad';
      }
      if (isset($row1['user_id']) && ($row1['user_id'] == $user_id)) {
        $li .= '<li>One is the lonliest number. You can\'t share a project with yourself.</li>';
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
          while ($row3 = mysqli_fetch_assoc($sharing)) { 
            $names[] = '<li><form class="edit-user" method="post">' . $row3['first_name'] . ' ' . $row3['last_name'] . ' (' . $row3['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row3['shared_with'] . '">
              <input type="hidden" id="project_id" name="project_id" value="' .  $row3['project_id'] . '">
              <input type="hidden" id="project_name" name="project_name" value="' . $_POST['project_name'] . '">
              <input type="hidden" id="username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">
              <a class="rsu removeshareduser">Remove</a>
            </form></li>';
          } 

        $li .= '<li>You have successfully removed ' . $_POST['username'] . ' from the project, "' . $_POST['project_name'] . '".</li>';
        $class = 'orange';
        $shared_names .= implode($names);
        $signal = 'ok';

        } else {

          $li .= '<li>You have successfully removed ' . $_POST['username'] . ' from the project, "' . $_POST['project_name'] . '".</li>';
          $class = 'orange';
          $shared_names .= '<li class="alone">Just you</li>';
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

      /* make sure email actually exists in db */
      $sql = "SELECT * FROM project_user WHERE "; 
      $sql .= "shared_with='" . db_escape($db, $user_id) . "' ";
      $sql .= "AND project_id='" . db_escape($db, $current_project) . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $last_check = mysqli_fetch_assoc($result);
      /* making sure person here is still affiliated with this project. */

      if (isset($last_check['shared_with'])) { 
      /* one last check to make sure this user wasn't removed from project before trying to share it (since they've been logged in to the share_projects.php page) */

        /* making sure email actually exists in db */
        $sql2 = "SELECT * FROM users WHERE "; 
        $sql2 .= "email='" . db_escape($db, $email) . "' ";
        $sql2 .= "LIMIT 1";

        $result = mysqli_query($db, $sql2);
        confirm_result_set($result);
        $row = mysqli_fetch_assoc($result); 
        /* assigning users table content to the specific user whose email has been entered */

          if (isset($row['email']) && ($row['user_id'] != $user_id)) { 
            /* ********* error checking after this if statement is done ********* */
            /* email exists and does not belong to the user submitting the request. */
            $share_with = $row['user_id']; /* here's the user's id whose email was just submitted. */
            // let's make sure they don't already have this project shared with them.

            $sql3 = "SELECT p_u.project_id, p_u.owner_id, p_u.shared_with, u.* ";
            $sql3 .= "FROM project_user as p_u ";
            $sql3 .= "LEFT JOIN users as u ON u.user_id=p_u.owner_id "; /* needs to prevent being shared with owner. */
            $sql3 .= "WHERE p_u.project_id='" . db_escape($db, $id) . "' ";
            $sql3 .= "AND (p_u.shared_with='" . db_escape($db, $share_with) . "' ";
            $sql3 .= "OR p_u.owner_id='" . db_escape($db, $share_with) . "') ";
            $sql3 .= "LIMIT 1";

            $result2 = mysqli_query($db, $sql3);
            confirm_result_set($result2);
            $row2 = mysqli_fetch_assoc($result2); 
            /* assign value of user that was found to '$row2' so it does not interfere w/$row */

            if ($result2) { 
              /* send user's info to validation to throw personalized error */
              $li .= '<li>That user is already a member of this project.</li>';
              $class = 'red';
              $signal = 'bad';

            } else {
              /* keep going, everything good so far. user is unique and does not have the project shared with them already. */
              $sql4 = "INSERT INTO project_user ";
              $sql4 .= "(project_id, owner_id, shared_with, share, edit) ";
              $sql4 .= "VALUES ("; 
              $sql4 .= "'" . db_escape($db, $current_project)    . "', ";
              $sql4 .= "'" . db_escape($db, $user_id) . "', ";
              $sql4 .= "'" . db_escape($db, $share_with) . "', ";
              $sql4 .= "'" . db_escape($db, $share) . "', ";
              $sql4 .= "'" . db_escape($db, $edit) . "'";
              $sql4 .= ")";

              $result3 = mysqli_query($db, $sql4);
              if ($result3) {


                $sharing = show_shared_with_info($user_id, $_POST['project_id']); 
                while ($row3 = mysqli_fetch_assoc($sharing)) { 
                  $names[] = '<li><form class="edit-user" method="post">' . $row3['first_name'] . ' ' . $row3['last_name'] . ' (' . $row3['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row3['shared_with'] . '">
                    <input type="hidden" id="project_id" name="project_id" value="' .  $row3['project_id'] . '">
                    <input type="hidden" id="project_name" name="project_name" value="' . $project_name . '">
                    <input type="hidden" id="username" name="username" value="' . $row3['first_name'] . ' ' . $row3['last_name'] . '">
                    <a class="rsu removeshareduser">Remove</a>
                  </form></li>';
                } 

                $li .= '<li>' . $row1['first_name'] . ' ' . $row1['last_name'] . ' has successfully been added to the project, "' . $project_name . '".</li>';
                $class = 'green';
                $shared_names .= implode($names);
                $signal = 'ok';




              } else {
                $li .= '<li>' .  mysqli_error($db) . '</li>';
                $class = 'red';
                $signal = 'bad';
              }
            }
          
      /* ^ if (isset($row['email']) && ($row['user_id'] != $user_id)) */
        } else {
          if (!isset($row['email'])) {
            $li .= '<li>The address, "' . $email . '" does not exist around here.</li>';
            $class .= 'red';
            $eclass .= 'red';
            $signal = 'bad';
          }
          if (isset($row['user_id']) && ($row['user_id'] == $user_id)) {
            $li .= '<li>One is the lonliest number. You can\'t share a project with yourself. ...Plus, you\'re already a member of this project. What in the world?!</li>';
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







  if (isset($_POST['remove_me'])) {
    $id = $_POST['project_id'];
    $remove_this_user = $_POST['remove_me'];

    $result = remove_me($id, $remove_this_user);
      if ($result === true) {


        $_SESSION['view-proj-pg'] = 'anothern';
        $signal = 'ok';
        echo json_encode($signal);
      }
  }





} // end if (is_post_request())