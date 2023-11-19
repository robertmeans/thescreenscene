<?php
/* 
one day, figure out why $layout_context needs to be directly above "require '_includes/head.php'" it is otherwise not enduring until it gets there - ?! 
*/ 

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

$layout_context = 'new-project';
require '_includes/head.php';
?>

<body onLoad="document.google.q.focus();">
<?php // set default values for search rows
$s = array(0=>"1", 1=>"2", 2=>"3", 3=>"4", 4=>"5");
$row['reference'] = "1";

preload_config($layout_context); 

// they got here via a very circuitous route that ultimately started with deleting their only project.
if (isset($_SESSION['ds']) && $_SESSION['ds'] == 'ds-success') {
  echo '<div id="success-wrap"><span class="success-msg">Delete Successful!</span></div>';
  unset($_SESSION['ds']);
}

require '_includes/nav.php'; 
?>

  <div id="table-page">
  <div id="table-wrap">
<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs new-intro">
<?php
$any_projects_for_user = find_users_projects($user_id);
$projects = mysqli_num_rows($any_projects_for_user);
$row = mysqli_fetch_assoc($any_projects_for_user);

if ($projects < 10 || $row['admin'] == 1) {

  if (isset($_SESSION['first-project'])) { ?>
    <p>Welcome <?= $_SESSION['username']; ?>,</p>
    <p>You don't have any projects. Let's get started!</p>
    <p>All you need is a name for your project and you can change it anytime.</p>

  <?php } else if (isset($_SESSION['no-projects'])) { ?>

    <p>Hello <?= $_SESSION['username']; ?>,</p>
    <p>You don't have any projects. The last project you were viewing was deleted and there are no others to choose from. Time to start a new one.</p>

  <?php } else { ?>
    <p>Start a new project:</p>
  <?php } ?>

    <form id="new-project-form" method="post">

    <div id="new-project-alert">
      <ul id="new-project-errors"></ul>
    </div>

      <p>Name your first project | Limit 30 characters</p>
      <input type="text" class="first-project-name" name="project_name" maxlength="30" value="<?php if (isset($_POST['project_name'])) { echo $_POST['project_name']; } ?>">

      <p>Project Notes | Limit 1,500 characters</p>
      <textarea id="textbox" name="project_notes" maxlength="1500"><?php if (isset($_POST['project_notes'])) { echo $_POST['project_notes']; } ?></textarea>

  <?php if (isset($_SESSION['cancel-option'])) { ?>
      <input type="hidden" id="can-opt" name="can-opt" value="off">
      <div id="np-toggle-btn">
        <div id="new-project-btn"><span class="login-txt">Start new project</span></div>
      </div>

    <?php } else { ?>
      <div id="np-toggle-btn" class="cancel">
        <a id="new-project-cancel-btn" class="cncl" href="<?= WWW_ROOT ?>"><span class="login-txt">Cancel</span></a>
        <div id="new-project-btn" class="cncl"><span class="login-txt">Start new project</span></div>
      </div>
    <?php } ?>

    </form>


  <?php } else { ?>
      <p class="query-tinkerer">There is a limit of 10 projects for now. Is it worth $20 a year to have unlimited projects? Let me know via the contact form at the bottom of this page.</p>
  <?php } ?>


</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><!-- #table-page -->
<?php require '_includes/footer.php'; ?>