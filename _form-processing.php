<?php
require_once 'config/initialize.php';

if (is_post_request()) {

  // go to 'View Projects Page' from main navigation
  if (isset($_POST['viewprojectspage'])) {
    $_SESSION['view-proj-pg'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }


  // Go to homepage - works everywhere
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


  // 'Organize search fields' -> edit_searches.php 
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


  // 'Rearrange bookmarks' -> edit_order.php
  if (isset($_POST['rearrangebookmarks'])) {
    $_SESSION['order'] = 'anothern';
    $signal = 'ok';
    echo json_encode($signal);
  }



  // 'Share project' -> share_project.php 
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


















  // from edit_project_details.php (Submit button)
  if (isset($_POST['submitdeets'])) {
    $current_project = $_SESSION['current_project'];
    $row = [];
    $row['project_name']     = $_POST['project_name'];
    $row['project_notes']      = $_POST['project_notes'];

    // validation
    if (empty($row['project_name'])) {
      $signal = 'bad';
      $li .= '<li class="no-count">Cannot leave Project Name empty.</li>';
      $class = 'red'; 
    }




  if ($li === '') {

    global $db;

    $result = update_project_deets($current_project, $row);

    if ($result === true) {

      $_SESSION['view-proj-pg'] = 'anothern';
      $signal = 'ok';
      echo json_encode($signal);

      } else {
        $signal = 'bad';
        $li .= '<li class="no-count">Something\'s no bueno. Please try again. You may have to wait a minute as this could indicate an error on the server which is certainly being investigated.</li>';
        $class = 'red'; 
      } 
    }

  }
  
























} // end if (is_post_request())