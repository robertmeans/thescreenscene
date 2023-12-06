<?php $layout_context = "cp-not-found";

if (isset($row['color'])) { // booyeah!
  $_SESSION['color'] = $row['color'];
}
require '_includes/head.php';
?>

<body <?= "onLoad=\"document.google.q.focus();\""; ?>>
<?php // set default values for search rows
  $s = array(0=>"1", 1=>"2", 2=>"3", 3=>"4", 4=>"5");
  $row['reference'] = "1";
?>
<?php preload_config($layout_context); ?>

<?php require '_includes/nav.php'; ?>
  <div id="table-page">
  <div id="table-wrap">
<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs new-intro">
<?php   $inner_nav_context = "cp-not-found"; ?>
  <ul class="inner-nav" style="float:none;margin:-1em 0em 1em;">
    <?php require 'nav/inner_nav.php'; ?>
  </ul>
<?php if (isset($_SESSION['got-kicked-out'])) { ?>
<?php /* $_SESSION['got-kicked-out']; is unset if they click on the 'Go to your projects page' link */ ?>

<?php show_session_variables(); ?>

  <div class="cpnf">
  <p>You were removed from the project you were on.</p>
    <form method="post" style="display: block;margin: 0 auto; width: 96%;">
      <input type="hidden" id="viewprojectspage" name="viewprojectspage" value="yo">
      Go to your <a class="vpp-link go">projects page</a> and choose another.
    </form>
  </div>

<?php } else { ?>

<?php show_session_variables(); ?>

  <div class="cpnf">
  	<p>Looks like the project you were most recently viewing was deleted since you last saw it.
      <form method="post" style="display: block;margin: 0 auto; width: 96%;">
        <input type="hidden" id="viewprojectspage" name="viewprojectspage" value="yo">
        Go to your <a class="vpp-link go">projects page</a> and choose another.
      </form>
    </p>
  </div>

<?php } ?>

</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><!-- #table-page -->
<?php require '_includes/footer.php'; ?>