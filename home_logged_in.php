<?php $layout_context = "home-private"; 

require_once 'config/initialize.php';

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];

if (is_post_request()) {

  if (isset($_POST['project_name'])) {

  $row = [];
  $row['project_name']  = $_POST['project_name']  ?? '' ;
  $row['project_notes'] = $_POST['project_notes']  ?? ''  ;
  $row['share']         = '1' ?? '' ;
  $row['edit']          = '1' ?? '' ;

  $result = create_new_project($row, $user_id);

    if ($result !== true) {
      $errors = $result;
    }
  }

  if(isset($_POST['owner'])) {

    $color = $_POST['color']  ?? ''  ;

    $result = project_colormode_owner($user_id, $color, $current_project);

    if ($result === true) {

      header('location:' . WWW_ROOT);
    } else {
    $errors = $result;
    }
  }

  if(isset($_POST['shared_with'])) {

    $color = $_POST['color']  ?? ''  ;

    $result = project_colormode_shared_with($user_id, $color, $current_project);

    if ($result === true) {

      header('location:' . WWW_ROOT);
    } else {
    $errors = $result;
    }
  }
}
?>

<?php
if ($current_project != "0") { // not a brand new member
  $row = assemble_current_project($user_id, $current_project); // get project deets ready

  if (isset($row['shared_with']) && $row['shared_with'] == $user_id) { // show shared_with results
    require '_logged_in/homepage_shared_with.php';

  } else if (isset($row['owner_id']) && $row['owner_id'] == $user_id) { // show owner's results
    require '_logged_in/homepage_owner.php';

  } else if (!isset($row['owner_id']) && !isset($row['shared_with'])) {
    $result = does_user_have_a_single_project($user_id);
    $has_project = mysqli_num_rows($result);

    if ($has_project > 0) { // they have at least 1 project but their last was deleted since last visit
      require '_logged_in/current_project_not_found.php';

    } else { // they have no projects and their last was deleted since last visit
      $_SESSION['no-projects'] = 'no-projects';
      require 'new_project.php';
      // header('location:' . WWW_ROOT . '/new_project.php' );
      // exit;
    }
  }
} else { // brand new member - first visit
  $_SESSION['first-project'] = 'first-project';
  require 'new_project.php';
  // header('location:' . WWW_ROOT . '/new_project.php' );
  // exit;

}