<?php $layout_context = "edit_order";
/* $layout_context was not working above (online) (although it worked locally) up here so I moved it down the page and for some reason it works now. ?! */

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

<div id="edit-order-page">
<div id="edit-order-wrap">
<?php
$row = show_project($current_project);
$r = explode(",",$row['row_order']);

if ($row['owner_id'] == $user_id) { // only an owner can move bookmarks.
?>

<?php 
$inner_nav_context = "owner";
$layout_context = "edit_order"; 
?>
<ul class="inner-nav">
  <?php require 'nav/inner_nav.php'; ?>
</ul>
<p class="oyo">Note: Buckle up! This feature is wonky AF! When you move a bookmark, every bookmark moves one space to the right. They don't swap places. I wish they did but you cannot imagine the complications that creates.</p>
<?php show_session_variables(); ?>
<ul id="sortable" class="order">

<?php
for ($row_count = 0; $row_count < 24; $row_count++){
$sort = $row_count + 1;
?>

<li id="<?= $r[$row_count] ?>" sort="<?= $sort ?>" class="ui-state-default pg1">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo h($row[$r[$row_count] . '_text']); 
      } else { 
            echo "<a class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } // end for loop page 1 ?>

<!-- <li class="page-divider">Page 2</li> -->
<?php
for ($row_count = 24; $row_count < 48; $row_count++){
$sort = $row_count + 1;
?>

<li id="<?= $r[$row_count] ?>" sort="<?= $sort ?>" class="ui-state-default pg2">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo h($row[$r[$row_count] . '_text']); 
      } else { 
             echo "<a class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } // end for loop page 2 ?>

<!-- <li class="page-divider">Page 3</li> -->
<?php
for ($row_count = 48; $row_count < 72; $row_count++){
$sort = $row_count + 1;  
?>

<li id="<?= $r[$row_count] ?>" sort="<?= $sort ?>" class="ui-state-default pg3">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo h($row[$r[$row_count] . '_text']); 
      } else { 
             echo "<a class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } // end for loop page 2 ?>

    </ul><!-- #sortable .order -->
<form action=""><input type="hidden" id="row_order"></form>

<?php
  } else {
      echo "<p class=\"query-tinkerer\">Only the owner of a project can change the order of their project's links. Can you imagine the chaos if everyone was dragging and dropping? It would be a mixed up mess indeed.</p>";
  }
?>

</div><!-- #edit-order-wrap -->
</div><!-- #edit-order-page -->

<?php require '_includes/footer.php'; ?>