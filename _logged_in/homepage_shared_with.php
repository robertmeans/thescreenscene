<?php
$layout_context = 'homepage';

if (isset($row['color'])) { // booyeah!
  $_SESSION['color'] = $row['color'];
}
require '_includes/head.php';

$r    = explode(",",$row['row_order']);
$s    = explode(",",$row['search_order']);
?>

<body <?php
  if ($s[0] == "1") { echo "onLoad=\"document.google.q.focus();\"";}
  if ($s[0] == "2") { echo "onLoad=\"document.urlField.address.focus();\"";}
  if ($s[0] == "3") { echo "onLoad=\"document.bing.q.focus();\"";} 
  if ($s[0] == "4") { echo "onLoad=\"document.reference.refsearch.focus();\"";}
  if ($s[0] == "5") { echo "onLoad=\"document.youtube.ytsearch.focus();\""; } ?>>

<div class="preload"></div>

<?php // primary navigation
require '_includes/nav.php'; ?>

  <div id="table-page">
  <div id="table-wrap">
<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs">

      <ul class="tab-links">

        <li <?php if ($row['page_number'] == "1") { echo "class=\"active\""; }  ?> >
          <form id="page_number1" class="ajax" action="project_view_shared_with.php" method="post">
          <input type="hidden" name="page_number" value="1">
          <input type="submit" name="tab1" value="Page 1">
          </form>
        </li>

        <li <?php if ($row['page_number'] == "2") { echo "class=\"active\""; }  ?> >
          <form id="page_number2" class="ajax" action="project_view_shared_with.php" method="post">
          <input type="hidden" name="page_number" value="2">
          <input type="submit" name="tab2" value="Page 2">
          </form>
        </li>

        <li <?php if ($row['page_number'] == "3") { echo "class=\"active\""; }  ?> >
          <form id="page_number3" class="ajax" action="project_view_shared_with.php" method="post">
          <input type="hidden" name="page_number" value="3">
          <input type="submit" name="tab3" value="Page 3">
          </form>
        </li>
      </ul>

      <?php $inner_nav_context = "shared_with"; ?>
      <ul class="inner-nav">
        <?php require 'nav/inner_nav.php'; ?>
      </ul>

<ul id="static-sort" class="homepage">

<div class="tab-content">

<!-- page 1 -->
<div id="tab1" class="tab <?php if ($row['page_number'] == "1") { echo "active"; }  ?>">
<?php
for ($row_count = 0; $row_count < 24; $row_count++){

$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo "<a href=\"" . h($row[$r[$row_count] . '_url']) . "\" class=\"project-links\" target=\"_blank\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 
      } else { 
            echo "<a class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } // end for loop page 1 ?>

</div><!-- #tab1 -->

<!-- page 2 -->
<div id="tab2" class="tab <?php if ($row['page_number'] == "2") { echo "active"; }  ?>">
<?php
for ($row_count = 24; $row_count < 48; $row_count++){

$id_count = 1 + $row_count;
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo "<a href=\"" . h($row[$r[$row_count] . '_url']) . "\" class=\"project-links\" target=\"_blank\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 
      } else { 
            echo "<a class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } // end for loop page 2 ?>

</div><!-- #tab2 -->

<!-- page 3 -->
<div id="tab3" class="tab <?php if ($row['page_number'] == "3") { echo "active"; }  ?>">
<?php
for ($row_count = 48; $row_count < 72; $row_count++){

$id_count = 1 + $row_count;
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo "<a href=\"" . h($row[$r[$row_count] . '_url']) . "\" class=\"project-links\" target=\"_blank\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 
      } else { 
            echo "<a class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php 
      }  // mysqli_free_result($any_links_for_user); // end for loop page 3 ?>

</div><!-- #tab3 -->
</div><!-- .tab-content -->

    </ul><!-- .static-sort -->

</div><?php // #tabs ?>

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><?php // #table-page ?>
<?php require '_includes/footer.php'; ?>