<?php $layout_context = "home-private"; 

require_once 'config/initialize.php';

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];



if (is_post_request()) {


  // if (isset($_POST['project_notes'])) {
  // $row = [];
  // $row['project_name']  = $_POST['project_name']  ?? '' ;
  // $row['project_notes'] = $_POST['project_notes']  ?? ''  ;
  // $row['share']         = '1' ?? '' ;
  // $row['edit']          = '1' ?? '' ;

  // $result = create_new_project($row, $user_id);

  //   if ($result !== true) {
  //     $errors = $result;
  //   }
  // }

  if(isset($_POST['color'])) {
    $color = $_POST['color'];
    if (isset($_POST['owner'])) {
      $result = project_colormode_owner($user_id, $color, $current_project);
    } else {
      $result = project_colormode_shared_with($user_id, $color, $current_project);
    }
    if ($result === true) {
      header('location:' . WWW_ROOT);
    } else {
      $errors = $result;
    }
  }

  /* begin processing for share_project.php */
  if (isset($_POST['project_id'])) { 
    $id = $_POST['project_id'];
  }
  
  // $current_project  = $_POST['project_id'];

}
?>

<?php
if ($current_project != "0") { // not a brand new member
  $row = assemble_current_project($user_id, $current_project); // get project deets ready

  if (isset($row['shared_with']) && $row['shared_with'] == $user_id) { // show shared_with results

    if (isset($_SESSION['view-proj-pg'])) {
      /* Main dropdown nav = 'View Projects Page' */
      /* session set in: set-session-vpp.php | click event _scripts/scripts.js: .vpp-link */
      unset($_SESSION['view-proj-pg']); 
      require 'my_projects.php';

    } else if (isset($_SESSION['organize'])) {
      /* tooltip = 'Organize search fields' */
      /* session set in: set-session-osf.php | click event _scripts/scripts.js: .osf-link */
      unset($_SESSION['organize']); 
      require 'edit_searches.php';

    } else if (isset($_SESSION['order'])) {
      /* tooltip = 'Rearrange bookmarks' */
      /* session set in: set-session-eo.php | click event _scripts/scripts.js: .eo-link */
      unset($_SESSION['order']); 
      require 'edit_order.php';

    } else if (isset($_SESSION['share-project'])) {
      /* tooltip = 'Start a new project' */
      /* session set in: set-session-np.php | click event _scripts/scripts.js: .np-link */
      unset($_SESSION['share-project']);
      require 'share_project.php';

    } else if (isset($_SESSION['another-proj'])) {
      /* tooltip = 'Start a new project' */
      /* session set in: set-session-np.php | click event _scripts/scripts.js: .np-link */
      if (isset($_SESSION['newprojectcancelbtn'])) { 

        if (isset($_SESSION['backtohomepage'])) { 
          unset($_SESSION['newprojectcancelbtn']);
          unset($_SESSION['backtohomepage']);
          unset($_SESSION['another-proj']);
          require '_logged_in/homepage_shared_with.php';
          // exit; 
        }
        if (isset($_SESSION['backtomyprojects'])) {
          unset($_SESSION['newprojectcancelbtn']); 
          unset($_SESSION['backtomyprojects']);
          unset($_SESSION['another-proj']); 
          require 'my_projects.php';
          // exit; 
        }
      } else {
        unset($_SESSION['another-proj']);
        require 'new_project.php';
      }

    } else if (isset($_SESSION['editprojectdetails'])) {
      unset($_SESSION['editprojectdetails']);
      require 'edit_project_details.php';

    } else { 
      require '_logged_in/homepage_shared_with.php';
    }
  } else if (isset($row['owner_id']) && $row['owner_id'] == $user_id) { // show owner's results

    if (isset($_SESSION['view-proj-pg'])) {
      /* Main dropdown nav = 'View Projects Page' */
      /* session set in: set-session-vpp.php | click event _scripts/scripts.js: .vpp-link */
      unset($_SESSION['view-proj-pg']); 
      require 'my_projects.php';

    } else if (isset($_SESSION['organize'])) {
      /* tooltip = 'Organize search fields' */
      /* session set in: set-session-osf.php | click event _scripts/scripts.js: .osf-link */
      unset($_SESSION['organize']);
      require 'edit_searches.php';

    } else if (isset($_SESSION['order'])) {
      /* tooltip = 'Rearrange bookmarks' */
      /* session set in: set-session-eo.php | click event _scripts/scripts.js: .eo-link */
      unset($_SESSION['order']); 
      require 'edit_order.php';

    } else if (isset($_SESSION['share-project'])) {
      /* tooltip = 'Start a new project' */
      /* session set in: set-session-np.php | click event _scripts/scripts.js: .np-link */
      unset($_SESSION['share-project']);
      require 'share_project.php';

    } else if (isset($_SESSION['another-proj'])) {
      /* tooltip = 'Start a new project' */
      /* session set in: set-session-np.php | click event _scripts/scripts.js: .np-link */
      if (isset($_SESSION['newprojectcancelbtn'])) { 

        if (isset($_SESSION['backtohomepage'])) { 
          unset($_SESSION['newprojectcancelbtn']);
          unset($_SESSION['backtohomepage']);
          unset($_SESSION['another-proj']);
          require '_logged_in/homepage_owner.php';
          // exit; 
        }
        if (isset($_SESSION['backtomyprojects'])) {
          unset($_SESSION['newprojectcancelbtn']); 
          unset($_SESSION['backtomyprojects']);
          unset($_SESSION['another-proj']); 
          require 'my_projects.php';
          // exit; 
        }
      } else {
        unset($_SESSION['another-proj']);
        require 'new_project.php';
      }

    } else if (isset($_SESSION['editprojdeets'])) {
      unset($_SESSION['editprojdeets']);
      require 'edit_project_details.php';

    } else { 
      // default to
      require '_logged_in/homepage_owner.php';
    }

  } else if (!isset($row['owner_id']) && !isset($row['shared_with'])) {
    $result = does_user_have_a_single_project($user_id);
    $has_project = mysqli_num_rows($result);

    if ($has_project > 0) { 
      // they have at least 1 project but their last was deleted since last visit
      require '_logged_in/current_project_not_found.php';

    } else { 
      // they have no projects and their last was deleted since last visit
      if (isset($_SESSION['another-proj'])) { unset($_SESSION['another-proj']); }
      $_SESSION['no-projects'] = 'no-projects';
      $_SESSION['cancel-option'] = 'off';
      require 'new_project.php';
    }
  }
} else { 
  // brand new member - first visit
  if (isset($_SESSION['another-proj'])) { unset($_SESSION['another-proj']); }
  $_SESSION['first-project'] = 'first-project';
  $_SESSION['cancel-option'] = 'off';
  require 'new_project.php';
}