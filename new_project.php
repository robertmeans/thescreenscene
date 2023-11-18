<?php $layout_context = "home-private"; 

require_once 'config/initialize.php';

if (!isset($_SESSION['id'])) {
  header('location:' . WWW_ROOT);
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
  header('location:' . WWW_ROOT);
	exit();
}

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];  

if (is_post_request()) {

$row = [];
// $row['user_id']       = $_SESSION['id'];
$row['project_name']  = $_POST['project_name']  ?? '' ;
$row['project_notes'] = $_POST['project_notes']  ?? ''  ;
$row['share']         = '1' ?? '' ;
$row['edit']          = '1' ?? '' ;

$result = create_new_project($row, $user_id);

  if ($result === true) {

  } else {
    $errors = $result;
  }
}

?>
<?php
$any_projects_for_user = find_users_projects($user_id);
$projects = mysqli_num_rows($any_projects_for_user);
$row = mysqli_fetch_assoc($any_projects_for_user);
?>
<?php require '_includes/head.php'; ?>
<body onLoad="document.new.project_name.focus();">
<?php require '_includes/nav.php'; ?>

<div id="table-page">
 	<div id="edit-deets">

    <?php if ($projects < 3 || $row['admin'] == 1) { ?>
    <form name="new" action="" method="post">

        <?php if($errors): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

      <p>Name your project | Limit 30 characters</p>
      <input type="text" name="project_name" id="p-name" maxlength="30" value="<?php if (isset($_POST['project_name'])) { echo $_POST['project_name']; } ?>">

      <p>Project Notes | Limit 1,500 characters</p>
      <textarea id="textbox" name="project_notes" maxlength="1500"><?php if (isset($_POST['project_notes'])) { echo $_POST['project_notes']; } ?></textarea>
      
      <div class="btn-wrap">
        <a href="my_projects.php" class="cancel-deets">Cancel</a><input type="submit" name="update-deets">
      </div>

    </form>
  <?php } else { ?>
      <p class="query-tinkerer">There is a limit of 3 projects for now. Would you pay $20 a year to have a limit of 10 projects?</p>
  <?php } ?>

  </div><!-- #edit-deets -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>