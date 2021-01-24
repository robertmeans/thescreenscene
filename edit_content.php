<?php $layout_context = "edit_hyperlinks"; 

require_once 'config/initialize.php';

if (!isset($_SESSION['id'])) {
  header('location: home.php');
  exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
  header('location: home.php');
  exit();
}

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];

if (is_post_request()) {

  if (isset($_POST['update-link'])) {
    $row = [];
    $row['count']     = $_POST['count'] ?? '';
    $row['name']      = $_POST['name'] ?? '';
    $row['url']       = $_POST['url'] ?? '';

    $url = $_POST['url']  ?? ''  ; 
    if (($_POST['url']) != '') {
      if (!preg_match('#^[a-zA-Z]+://#', $url)) {
        $url = 'http://' . $url;
      }
    }

    $result = update_link($current_project, $row, $url);

  } 

  if (isset($_POST['delete-link'])) { // delete...
    $row = [];
    $row['count']     = $_POST['count'] ?? '';
    $result = delete_link($current_project, $row);
  }

  if ($result === true) {

    header('location: edit_content.php?id=' . $current_project);

    } else {
          $errors = $result;
    } 
}  

?>

<?php require '_includes/head.php'; ?>
<body>
<div class="preload"></div>
<?php require '_includes/nav.php'; ?>
 
<div id="edit-content-page">
 	<div id="edit-wrap">
<?php
$row = assemble_current_project($user_id, $current_project); 

if ($row['edit'] == "1") {

  if (isset($row['shared_with']) && $row['shared_with'] == $user_id) {

    require '_logged_in/edit_hyperlinks_shared_with.php';

    } else if (isset($row['owner_id']) && $row['owner_id'] == $user_id) {

      require '_logged_in/edit_hyperlinks_owner.php';

    } 

  } else {
    echo "<p class=\"query-tinkerer\">Either you're trying to be sneaky or the Internet is angling to sabbotage your immaculate reputation. You need to do something different.</p>";
}   

?>
  </div><!-- #edit-wrap -->
</div><!-- #edit-content-page -->

<?php require '_includes/footer.php'; ?>