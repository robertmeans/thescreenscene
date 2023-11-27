<?php $layout_context = "delete_project"; 

require_once 'config/initialize.php';

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

<?php // sortable ul from: https://jqueryui.com/sortable ?>
<div id="edit-delete-page">
<div id="edit-wrap">
<?php
$row = show_project($current_project);

if (isset($row['owner_id']) && $row['owner_id'] == $_SESSION['id']) {  ?>
<p class="delete-title">Delete <?= $row['project_name'] ?></p>

<form id="delete-form" method="post">
  <p>Type "Delete" and click Delete</p>

  <div id="message" class="delete-page"> 
    <ul id="msg-ul"></ul>
  </div>

  <input type="hidden" name="current_project" value="<?= $current_project ?>">
  <input type="text" name="vamoose" value="<?php if (isset($_POST['vamoose'])) { echo $_POST['vamoose']; } ?>">

  <div id="buttons" class="delete-page">
    <a class="cancel cancel-deets">Never mind</a><a class="delete delete-my-project">Delete</a>
  </div>

</form>

<?php
$r = explode(",",$row['row_order']);
$s = explode(",",$row['search_order']);
?>
<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs">
<ul class="tab-links">

  <li <?php if ($row['page_number'] == "1") { echo "class=\"active\""; }  ?> >
    <form id="page_number1" class="ajax" action="project_edit_view.php" method="post">
    <input type="hidden" name="page_number" value="1">
    <input type="submit" name="tab1" value="Page 1">
    </form>
  </li>

  <li <?php if ($row['page_number'] == "2") { echo "class=\"active\""; }  ?> >
    <form id="page_number2" class="ajax" action="project_edit_view.php" method="post">
    <input type="hidden" name="page_number" value="2">
    <input type="submit" name="tab2" value="Page 2">
    </form>
  </li>

  <li <?php if ($row['page_number'] == "3") { echo "class=\"active\""; }  ?> >
    <form id="page_number3" class="ajax" action="project_edit_view.php" method="post">
    <input type="hidden" name="page_number" value="3">
    <input type="submit" name="tab3" value="Page 3">
    </form>
  </li>

  <?php $inner_nav_context = "owner"; ?>
  <ul class="inner-nav">
    <?php require 'nav/inner_nav.php'; ?>
  </ul>
        
</ul><!-- .tab-links -->

<ul id="static-sort">
<div class="tab-content">

<!-- page 1 -->
<div id="tab1" class="tab <?php if ($row['page_number'] == "1") { echo "active"; }  ?>">
<?php
// stop at $row_count < 24 because $row['row_count'] starts at 0
// and you need to stay 1 number ahead in order to get 01 through 24 here.
for ($row_count = 0; $row_count < 24; $row_count++) {

// $id_count starts at 01 and goes through 24 
$id_count = 1 + $row_count;
$str_length = 2;
// add a leading 0 to 1-9
$id_count = substr("0{$id_count}", -$str_length);

// this assigns the cell's order number in order to update & delete - *super important*
$edit_count = $r[$row_count];

// create string for $modal_id, $url and $name
$modal_id = "modal_" . $id_count;
$url = h($row[$r[$row_count] . "_url"]);
$name = h($row[$r[$row_count] . "_text"]);
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
  if (h($row[$r[$row_count] . '_text']) != null) { 

        echo "<a href=\"#\" class=\"project-links delete-pg static\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 

  } else { 
    $url = "";
    $name = "";

        echo "<a href=\"#\" class=\"project-links edit-shim delete-pg static\"><img src=\"_images/shim.png\"></a>";

} ?></li><?php } // end for loop page 1 ?>

</div><!-- #tab1 -->

<!-- page 2 -->
<div id="tab2" class="tab <?php if ($row['page_number'] == "2") { echo "active"; }  ?>">
<?php
for ($row_count = 24; $row_count < 48; $row_count++) {

$id_count = 1 + $row_count;
$str_length = 2;
// $id_count = substr("0{$id_count}", -$str_length);

// this assigns the cell's order number in order to update & delete - *super important*
$edit_count = $r[$row_count];

$modal_id = "modal_" . (1 + $row_count);
$url = $row[$r[$row_count] . "_url"];
$name = $row[$r[$row_count] . "_text"];
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
  if (h($row[$r[$row_count] . '_text']) != null) { 

        echo "<a href=\"#\" class=\"project-links delete-pg static\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 

  } else { 
    $url = "";
    $name = "";

        echo "<a href=\"#\" class=\"project-links edit-shim delete-pg static\"><img src=\"_images/shim.png\"></a>";

} ?></li><?php } // end for loop page 2 ?>

</div><!-- #tab2 -->

<!-- page 3 -->
<div id="tab3" class="tab <?php if ($row['page_number'] == "3") { echo "active"; }  ?>">
<?php
for ($row_count = 48; $row_count < 72; $row_count++) {

$id_count = 1 + $row_count;
$str_length = 2;
// $id_count = substr("0{$id_count}", -$str_length);

// this assigns the cell's order number in order to update & delete
$edit_count = $r[$row_count];

$modal_id = "modal_" . ($id_count);
$url = $row[$r[$row_count] . "_url"];
$name = $row[$r[$row_count] . "_text"];
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
  if (h($row[$r[$row_count] . '_text']) != null) { ;

        echo "<a href=\"#\" class=\"project-links delete-pg static\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 

  } else { 
    $url = "";
    $name = "";

        echo "<a href=\"#\" class=\"project-links edit-shim delete-pg static\"><img src=\"_images/shim.png\"></a>";

} ?></li><?php } // end for loop page 3 ?>

</div><!-- #tab3 -->

</div><!-- .tab-content -->
</ul><!-- #static-sort -->

</div><!-- .tabs -->
<?php require '_includes/search_stack_bottom.php'; ?>
<?php 
  } else  {
    echo "<p class=\"delete-tinkerer\">Only a project owner can delete their project.</p>";
  } 	
?>

  </div><!-- #edit-wrap -->
</div><!-- #delete-page -->

<?php require '_includes/footer.php'; ?>