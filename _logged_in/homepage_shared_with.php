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

	if ($s[0] == "3") { 
    if ($s[1] == "1") { ?><body onLoad="clearForms(); document.google.q.focus(); document.urlField.address.value='http\://';"><?php }
    if ($s[1] == "2") { ?><body onLoad="clearForms(); document.urlField.address.focus(); document.urlField.address.value='http\://';"><?php }
    if ($s[1] == "4") { ?><body onLoad="clearForms(); document.reference.sr_04.focus(); document.urlField.address.value='http\://';"><?php }
    if ($s[1] == "5") { ?><body onLoad="clearForms(); document.youtube.sr_05.focus(); document.urlField.address.value='http\://';"><?php }
  } 

	if ($s[0] == "4") { ?><body onLoad="clearForms(); document.reference.sr_04.focus(); document.urlField.address.value='http\://';"><?php }
	if ($s[0] == "5") { ?><body onLoad="clearForms(); document.youtube.sr_05.focus(); document.urlField.address.value='http\://';"><?php } ?>

<?php preload_config($layout_context); ?>

<?php // primary navigation
require '_includes/nav.php'; ?>

	<div id="table-page">
	<div id="table-wrap">
<?php require '_includes/search_stack_top.php'; ?>
<?php show_session_variables(); ?>
<div class="tabs">

	<ul class="tab-links">
		<li <?php if ($row['page_number'] == "1") { echo "class=\"active\""; }  ?> >
			<form id="page_number1" class="ajax" action="project_view_shared_with.php" method="post">
			<input type="hidden" id="rememberOpenTab" name="rememberOpenTab">
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

<ul id="static-sort" class="homepage <?php if ($row['edit'] == "1" && $row['edit_toggle'] == "1") { echo "edit-shim"; }  ?>">

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
		<a data-target="urlz" href="<?php echo h($row[$r[$row_count] . '_url']); ?>" class="project-links" target="_blank"><?php echo h($row[$r[$row_count] . '_text']); ?></a>
		<?php if ($row['edit'] == '1') { ?>
			<a data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
		<?php } ?>
<?php  } else {  ?>
		<span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
		<span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
		<a data-target="urlz" class="project-links-empty shim" target="_blank"></a>
		<?php if ($row['edit'] == '1') { ?>
			<a data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
		<?php } ?>
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
		<a data-target="urlz" href="<?php echo h($row[$r[$row_count] . '_url']); ?>" class="project-links" target="_blank"><?php echo h($row[$r[$row_count] . '_text']); ?></a>
		<?php if ($row['edit'] == '1') { ?>
			<a data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
		<?php } ?>
<?php  } else {  ?>
		<span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
		<span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
		<a data-target="urlz" class="project-links-empty shim" target="_blank"></a>
		<?php if ($row['edit'] == '1') { ?>
			<a data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
		<?php } ?>
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
		<a data-target="urlz" href="<?php echo h($row[$r[$row_count] . '_url']); ?>" class="project-links" target="_blank"><?php echo h($row[$r[$row_count] . '_text']); ?></a>
		<?php if ($row['edit'] == '1') { ?>
			<a data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
		<?php } ?> 
<?php  } else {  ?>
		<span data-target="idcount" style="display:none;"><?php echo $id_count; ?></span>
		<span data-target="rowid" style="display:none;"><?php echo $r[$row_count]; ?></span>
		<a data-target="urlz" class="project-links-empty shim" target="_blank"></a>
		<?php if ($row['edit'] == '1') { ?>
			<a data-role="update" data-id="<?php echo $id_count ?>" class="ue"><i class="fas fa-ellipsis-h fa-fw"></i></a> 
		<?php } ?>
<?php } ?></li><?php } // end for loop page 3 ?>

</div><!-- #tab3 -->

<?php if (($user_id == '1') || ($user_id == '3')) { ?>
<?php /* if me, then show edit option for notes regardless of whether I am owner or shared_with. - this was all done when query strings were visibally availalbe for development purposes but doesn't really server any purpose now. */ ?>
<div id="tab4" class="tab">

  <span class="note-header">
    <p class="note-title">Project Notes</p>
    <span id="nei" class="note-edit-icon">
      <a class="eicon"><div class="tooltip"><span class="tooltiptext">Bob's Exception</span><i data-role="edit-portal" class="far fa-edit fa-fw"></i></div></a>
    </span>

  </span>
  <div id="first-pass" style="display:none;"><?= nl2br(h($row['project_notes'])); ?></div>
  <div id="multi-pass" style="display:none;"></div>

  <?php if (trim($row['project_notes']) != '') { ?>
    <div id="note-portal" class="pop-note-portal display-portal"><?php echo nl2br(h($row['project_notes'])); ?></div>

  <?php } else { ?>

    <div id="note-portal" class="empty-note-portal display-portal">This project has nary a note.</div>
    
  <?php } ?>

</div>

<?php } else { ?>
<?php /* everyone else will not see the edit option if they are the "shared_with" of this project */ ?>
<div id="tab4" class="tab">

  <span class="note-header">
    <p class="note-title">Project Notes</p>
    <span id="nei" class="note-edit-icon">
      <p class="ooce">Only owner can edit</p>
    </span>
  </span>

<?php 
if (trim($row['project_notes']) != '') { ?>
<div id="note-portal" class="pop-note-portal display-portal">
<?php	echo nl2br(h($row['project_notes'])); ?>
</div>

<?php } else { ?>
<div id="note-portal" class="pop-note-portal display-portal">  
	<div id="note-portal" class="empty-note-portal display-portal">There are no project notes to display.</div>
</div>
<?php } ?>
</div>
<?php } ?>

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
				<a class="static closefp"><i class="fas fa-times-circle"></i></a>
				<h4 class="modal-title">Add | Edit | Delete</h4>
			</div>
			<div class="modal-body">
			<form class="edit-link-form">
				<input type="hidden" name="rowid" id="rowid">
				<input type="hidden" name="cp" id="cp" value="<?= $current_project; ?>">
				<input type="hidden" name="idcount" id="idcount">

				<label>Name | Limit 18 characters
				<input name="name" id="name" class="edit-input link-name" type="text" maxlength="18"></label>

				<label>URL
				<input name="urlz" id="urlz" class="edit-input link-url" type="text" placeholder="http://"></label>

        <div class="submit-links">
          <a class="delete delete-bookmark">Delete</a><a class="submit update-bookmark">Update</a>
        </div>

			</form>
			</div>
			<div class="modal-footer">
				<h3>&nbsp;</h3>
			</div>
		</div>
	</div>
</div>
<?php require '_includes/footer.php'; ?>