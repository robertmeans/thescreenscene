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
	<p>Looks like the project you were most recently viewing was deleted since you last saw it.
    <form method="post" style="display: block;margin: 0 auto; width: 96%;">
      <input type="hidden" id="viewprojectspage" name="viewprojectspage" value="yo">
      <a class="vpp-link go">Go to your projects page</a> and choose another.
    </form>
  </p>
</div><!-- .tabs .new-intro -->

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><!-- #table-page -->
<?php require '_includes/footer.php'; ?>