<?php $layout_context = "home-private"; 

require_once 'config/initialize.php';

// off for local testing

if (!isset($_SESSION['id'])) {
  header('location:' . WWW_ROOT);
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
  header('location:' . WWW_ROOT);
	exit();
}

$current_project = $_GET['id'];
$user_id = $_SESSION['id'];

if (is_post_request()) {

  $row = [];
  $row['project_name']     = $_POST['project_name'] ?? '';
  $row['project_notes']      = $_POST['project_notes'] ?? '';

  $result = update_project_deets($current_project, $row);

  if ($result === true) {
    header('location: my_projects.php?id=' . $current_project);

    } else {
          $errors = $result;
    } 
}  

?>

<?php require '_includes/head.php'; ?>
<body>
<?php preload_config($layout_context); ?>

<?php require '_includes/nav.php'; ?>

<div id="table-page">
<div id="edit-deets">

<?php
$row = show_project($current_project);

if ($row['owner_id'] == $user_id) { ?>

<form action="" method="post">

    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <?php // if(isset($rememberme_error)) { echo $rememberme_error; } ?>
            <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

  <p>Rename project | Limit 30 characters</p>
  <input type="text" name="project_name" id="p-name" maxlength="30" value="<?= $row['project_name']; ?>">

  <p>Project Notes | Limit 1,500 characters</p>
  <textarea id="textbox" name="project_notes" maxlength="1500"><?= $row['project_notes']; ?></textarea>
  
  <div class="btn-wrap">
    <a href="my_projects.php" class="cancel-deets">Cancel</a><input type="submit" name="update-deets">
  </div>

</form>

<?php 
} else {
      echo "<p class=\"edit-tinkerer\">Only a project owner can modify their project name and notes.</p>";
}   
?>

</div><!-- #edit-deets -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>