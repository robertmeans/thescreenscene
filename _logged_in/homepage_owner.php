<?php 
$layout_context = 'homepage';

if (isset($row['color'])) { // booyeah!
  $_SESSION['color'] = $row['color'];
}
require '_includes/head.php'; 

$r    = explode(",",$row['row_order']);
$s    = explode(",",$row['search_order']);
?>

<?php
  if ($s[0] == "1") { ?><body onLoad="clearForms(); document.google.q.focus(); document.urlField.address.value='http\://';"><?php }
  if ($s[0] == "2") { ?><body onLoad="clearForms(); document.urlField.address.focus(); document.urlField.address.value='http\://';"><?php }
  if ($s[0] == "3") { ?><body onLoad="clearForms(); document.bing.q.focus(); document.urlField.address.value='http\://';"><?php } 
  if ($s[0] == "4") { ?><body onLoad="clearForms(); document.reference.sr_04.focus(); document.urlField.address.value='http\://';"><?php }
  if ($s[0] == "5") { ?><body onLoad="clearForms(); document.youtube.sr_05.focus(); document.urlField.address.value='http\://';"><?php } ?>

<div class="preload"></div>

<?php // primary navigation
require '_includes/nav.php'; ?>

  <div id="table-page">
  <div id="table-wrap">
<?php require '_includes/search_stack_top.php'; ?>

<div class="tabs">

  <ul class="tab-links">
    <li <?php if ($row['page_number'] == "1") { echo "class=\"active\""; }  ?> >
      <form id="page_number1" class="ajax" action="project_view_owner.php" method="post">
      <input type="hidden" name="page_number" value="1">
      <input type="submit" name="tab1" value="Page 1">
      </form>
    </li>
    <li <?php if ($row['page_number'] == "2") { echo "class=\"active\""; }  ?> >
      <form id="page_number2" class="ajax" action="project_view_owner.php" method="post">
      <input type="hidden" name="page_number" value="2">
      <input type="submit" name="tab2" value="Page 2">
      </form>
    </li>
    <li <?php if ($row['page_number'] == "3") { echo "class=\"active\""; }  ?> >
      <form id="page_number3" class="ajax" action="project_view_owner.php" method="post">
      <input type="hidden" name="page_number" value="3">
      <input type="submit" name="tab3" value="Page 3">
      </form>
    </li>
  </ul>

  <?php $inner_nav_context = "owner"; ?>
  <ul class="inner-nav">
    <?php require 'nav/inner_nav.php'; ?>
  </ul>

<ul id="static-sort" class="homepage <?php if ($row['edit_toggle'] == "1") { echo "edit-shim"; }  ?>">

<div class="tab-content">

<!-- page 1 -->
<div id="tab1" class="tab <?php if ($row['page_number'] == "1") { echo "active"; }  ?>">
<?php
for ($row_count = 0; $row_count < 24; $row_count++){

$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);
?>

<li id="<?php echo $id_count ?>" class="ui-state-default">           
<?php 
  if (h($row[$r[$row_count] . '_text']) != "") { ?>
    <span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
    <span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
    <a data-target="urlz" href="<?php echo h($row[$r[$row_count] . '_url']); ?>" class="project-links" target="_blank"><?php echo h($row[$r[$row_count] . '_text']); ?></a><a href="#" data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
<?php  } else {  ?>
    <span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
    <span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
    <a data-target="urlz" class="project-links-empty shim" target="_blank"></a><a href="#" data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a>
<?php } ?></li><?php } // end for loop page 1 ?>

</div><!-- #tab1 -->

<!-- page 2 -->
<div id="tab2" class="tab <?php if ($row['page_number'] == "2") { echo "active"; }  ?>">
<?php
for ($row_count = 24; $row_count < 48; $row_count++){

$id_count = 1 + $row_count;
?>

<li id="<?php echo $id_count ?>" class="ui-state-default">           
<?php 
  if (h($row[$r[$row_count] . '_text']) != "") { ?>
    <span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
    <span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
    <a data-target="urlz" href="<?php echo h($row[$r[$row_count] . '_url']); ?>" class="project-links" target="_blank"><?php echo h($row[$r[$row_count] . '_text']); ?></a><a href="#" data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
<?php  } else {  ?>
    <span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
    <span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
    <a data-target="urlz" class="project-links-empty shim" target="_blank"></a><a href="#" data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a>
<?php } ?></li><?php } // end for loop page 2 ?>

</div><!-- #tab2 -->

<!-- page 3 -->
<div id="tab3" class="tab <?php if ($row['page_number'] == "3") { echo "active"; }  ?>">
<?php
for ($row_count = 48; $row_count < 72; $row_count++){

$id_count = 1 + $row_count;
?>

<li id="<?php echo $id_count ?>" class="ui-state-default">           
<?php 
  if (h($row[$r[$row_count] . '_text']) != "") { ?>
    <span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
    <span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
    <a data-target="urlz" href="<?php echo h($row[$r[$row_count] . '_url']); ?>" class="project-links" target="_blank"><?php echo h($row[$r[$row_count] . '_text']); ?></a><a href="#" data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
<?php  } else {  ?>
    <span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
    <span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
    <a data-target="urlz" class="project-links-empty shim" target="_blank"></a><a href="#" data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a>
<?php } ?></li><?php } // end for loop page 3 ?>

</div><!-- #tab3 -->
</div><!-- .tab-content -->

    </ul><!-- .static-sort -->

</div><?php // #tabs ?>

<?php require '_includes/search_stack_bottom.php'; ?>
</div><!-- #table-wrap -->
</div><?php // #table-page ?>

<!-- Modal -->
<div id="theModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="static closefp"><i class="fas fa-times-circle"></i></a>
        <h4 class="modal-title">Add | Edit | Delete</h4>
      </div>
      <div class="modal-body">

      <form class="edit-link-form">
        <input type="hidden" name="rowid" id="rowid">
        <input type="hidden" name="cp" id="cp" value="<?= $current_project; ?>">
        <input type="hidden" name="idcount" id="idcount">

        <label>Name | Limit 30 characters
        <input name="name" id="name" class="edit-input link-name" type="text" maxlength="30"></label>

        <label>URL
        <input name="urlz" id="urlz" class="edit-input link-url" type="text" placeholder="http://"></label>
        <div class="submit-links">
          <!-- <input type="submit" name="owner-update-link" style="display:none"> -->
          <input name="delete" id="delete" class="delete" value="Delete">
          <input name="update" id="update" class="update" value="Update">
         <!--  <a href="#" id="update">Update</a> -->
        </div><!-- #submit-links -->
      </form>
      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
      </div>
    </div>
  </div>
</div>
<?php require '_includes/footer.php'; ?>