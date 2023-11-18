<?php $layout_context = "no-projects";

if (isset($row['color'])) { // booyeah!
  $_SESSION['color'] = $row['color'];
}
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
    <p>You don't have any projects. The last project you were viewing has been deleted and there are no others to choose from.</p>
    <p>Time to start a new one.</p>

  <?php } else { ?>
    <p>Start a new project:</p>
  <?php } ?>

    <form id="first-project" action="" method="post">

        <?php if(isset($errors) && $errors): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

      <p>Name your first project | Limit 30 characters</p>
      <input type="text" class="first-project-name" name="project_name" maxlength="30" value="<?php if (isset($_POST['project_name'])) { echo $_POST['project_name']; } ?>">

      <p>Project Notes | Limit 1,500 characters</p>
      <textarea id="textbox" name="project_notes" maxlength="1500"><?php if (isset($_POST['project_notes'])) { echo $_POST['project_notes']; } ?></textarea>

      <input type="submit" class="first-submit" name="first_project" value="Go!">

    </form>


  <?php } else { ?>
      <p class="query-tinkerer">There is a limit of 10 projects for now. Is it worth $20 a year to have unlimited projects? Let me know via the contact form at the bottom of this page.</p>
  <?php } ?>


</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><!-- #table-page -->
<?php require '_includes/footer.php'; ?>