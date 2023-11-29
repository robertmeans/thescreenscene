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

$current_project = $_SESSION['current_project'];
$user_id = $_SESSION['id']; 

?>

<?php require '_includes/head.php'; ?>
<body>
<?php preload_config($layout_context); ?>

<?php require '_includes/nav.php'; ?>

<div id="table-page">
<div id="edit-deets">
<?php show_session_variables(); ?>
<?php
$row = show_project($current_project);

if ($row['owner_id'] == $user_id) { ?>

<form id="epd-form" method="post">
  <input type="hidden" name="submitdeets" value="yo">

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

  <p>Rename project | Limit 30 characters</p>
  <input type="text" name="project_name" id="p-name" maxlength="30" value="<?= $row['project_name']; ?>">

  <p>Project Notes | Limit 1,500 characters</p>
  <textarea id="textbox" name="project_notes" maxlength="1500"><?= $row['project_notes']; ?></textarea>
  
  <div id="buttons">
    <a class="cancel cancel-new-project">Cancel</a><a class="submit submit-deets">Submit</a>
  </div>

</form>
<form id="new-project-cancel-btn" method="post">
  <input type="hidden" name="cancelprojectdetails" value="yo"> 
  <input type="hidden" name="newprojectcancelbtn" value="yo">
</form>
<?php 
} else {
  echo "<p class=\"edit-tinkerer\">Only a project owner can modify their project name and notes.</p>";
}   
?>

</div><!-- #edit-deets -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>