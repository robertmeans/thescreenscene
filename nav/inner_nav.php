<?php
	switch ($inner_nav_context) { // start shared_with navigation
	case 'shared_with' :

	if ($layout_context != 'homepage') { ?>	
	<li>
    <form class="gth" method="post">
      <input type="hidden" name="user_id" value="<?= $user_id; ?>">
      <input type="hidden" name="current_project" value="<?= $current_project; ?>">
      <input type="hidden" name="go_to_homepage" value="1">
      <a class="gotohomepage"><div class="tooltip"><span class="tooltiptext">Homepage of this project</span><i class="fas fa-house-user fa-fw"></i></div></a>
    </form>
  </li>
	<?php }

	if (($row['edit'] == "1") && ($layout_context == 'homepage')) { ?>
	<li>
		<form id="et-form" action="" method="post">
			<input type="hidden" id="ownShare" name="ownShare" value="0">
			<input type="hidden" id="curpro" name="current_project" value="<?= $current_project; ?>">
			<input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
			<input type="checkbox" id="et1" name="edit_toggle" value="1" <?php if ($row['edit_toggle'] == "1") { echo "checked"; }  ?>>
			<a id="edit-content" class="static <?php if ($row['edit_toggle'] == "1") { echo "active"; }  ?>"><div class="tooltip"><span class="tooltiptext">Edit bookmarks</span><i class="far fa-edit fa-fw"></i></div></a>
		</form>
	</li>
	<?php }

	if ($layout_context != 'edit_searches') { ?>
  <li>
    <form method="post">
      <input type="hidden" name="organizesearchfields" value="1">
      <a class="osf-link"><div class="tooltip"><span class="tooltiptext">Organize search fields</span><i class="fas fa-sort fa-fw"></i></div></a>
    </form>
  </li>
	<?php }

	if (($row['share'] == "1") && ($layout_context != 'share_project')) { ?>
  <form id="sp-form" style="display:none;"><input type="hidden" name="change_project_id" value="<?= $row['project_id']; ?>"></form>
	<li><a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a></li>
	<?php } ?>

  <li><a id="np-link" class="my-nav"><div class="tooltip"><span class="tooltiptext">Start a new project</span><i class="far fa-plus-square fa-fw"></i></div></a></li>

  <?php
	if ($layout_context == 'homepage') { ?>
	<li>
		<a class="static"><div class="tooltip"><span class="tooltiptext">Color theme</span><i class="fas fa-fill-drip fa-fw"></i></div></a>
		<ul>
 			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="3">
				<a class="static classic" onclick="$(this).closest('form').submit()">Light</a>
			</form>
			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="2">
				<a class="static spring" onclick="$(this).closest('form').submit()">Spring</a>
			</form>
			</li>	
      <li>
      <form action="" method="post">
        <input type="hidden" name="color" value="1">
        <a class="static darkmode" onclick="$(this).closest('form').submit()">Dark</a>
      </form>
      </li>		
		</ul>
	</li>
	<?php } 


  if ($layout_context == 'homepage') { ?> 
	<li class="project-name">| <a name="tab4" class="project-link tabs tab-links show-notes"><div class="tooltip"><span class="tooltiptext">Project notes</span><input type="submit" id="yotab4" name="tab4" value="<?= $row['project_name']; ?>"></div></a></li>

  <?php } else { ?>

  <li class="project-name" style="cursor:default;">| <span style="margin-left:0.5em;cursor:default;"><?= $row['project_name']; ?></span></li>  

  <?php } 
	break; // end shared_with navigation | begin owner navigation


	case 'owner' :	

	if ($layout_context != 'homepage') { // begin owner navigation ?>	
	<li>
    <form class="gth" method="post">
      <input type="hidden" name="user_id" value="<?= $user_id; ?>">
      <input type="hidden" name="current_project" value="<?= $current_project; ?>">
      <input type="hidden" name="go_to_homepage" value="1">
      <a class="gotohomepage"><div class="tooltip"><span class="tooltiptext">Homepage of this project</span><i class="fas fa-house-user fa-fw"></i></div></a>
    </form>
  </li>
	<?php } 

	if ($layout_context == 'homepage') { ?>
	<li>
		<form id="et-form" action="" method="post">
			<input type="hidden" id="ownShare" name="ownShare" value="1">
			<input type="hidden" id="curpro" name="current_project" value="<?= $current_project; ?>">
			<input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
			<input type="checkbox" id="et1" name="edit_toggle" value="1" <?php if ($row['edit_toggle'] == "1") { echo "checked"; }  ?>>
			<a id="edit-content" class="static <?php if ($row['edit_toggle'] == "1") { echo "active"; }  ?>"><div class="tooltip"><span class="tooltiptext">Edit bookmarks</span><i class="far fa-edit fa-fw"></i></div></a>
		</form>
	</li>
	<?php }

	if ($layout_context != 'edit_searches') { ?>
  
	<li>
    <form method="post">
      <input type="hidden" name="organizesearchfields" value="1">
      <a class="osf-link"><div class="tooltip"><span class="tooltiptext">Organize search fields</span><i class="fas fa-sort fa-fw"></i></div></a>
    </form>
  </li>
	<?php }

	if ($layout_context != 'edit_order') { ?>
	<li><a id="eo-link"><div class="tooltip"><span class="tooltiptext">Rearrange bookmarks</span><i class="fas fa-arrows-alt fa-fw"></i></div></a></li>
	<?php }

  if ($layout_context != 'share_project') { ?>
  <form style="display:none;"><input type="hidden" name="change_project_id" value="<?= $row['project_id']; ?>"></form>
	<li><a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a></li>
  <?php } ?>

  <li><a id="np-link" class="my-nav"><div class="tooltip"><span class="tooltiptext">Start a new project</span><i class="far fa-plus-square fa-fw"></i></div></a></li>

  <?php
	if ($layout_context == 'homepage') { ?>
	<li>
		<a class="static"><div class="tooltip"><span class="tooltiptext">Color theme</span><i class="fas fa-fill-drip fa-fw"></i></div></a>
		<ul>
      <li>
      <form action="" method="post">
        <input type="hidden" name="color" value="3">
        <input type="hidden" name="owner" value="1">
        <a class="static classic" onclick="$(this).closest('form').submit()">Light</a>
      </form>
      </li> 
			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="2">
				<input type="hidden" name="owner" value="1">
				<a class="static spring" onclick="$(this).closest('form').submit()">Spring</a>
			</form>
			</li>	
      <li>
      <form action="" method="post">
        <input type="hidden" name="color" value="1">
        <input type="hidden" name="owner" value="1">
        <a class="static darkmode" onclick="$(this).closest('form').submit()">Dark</a>
      </form>
      </li>      	
		</ul>
	</li>
	<?php } 

	if ($layout_context == 'edit_order') { ?>
	<li class="project-name">| <span class="attn">Drag &amp; Drop:</span> <a href="my_projects.php" class="project-link" style="pointer-events:none;cursor:default;"><?= $row['project_name']; ?></a></li> 

	<?php } else if ($layout_context == 'delete_project') { ?>
	<li class="project-name">| <span class="attn">DELETE:</span> <a href="my_projects.php" class="project-link" style="pointer-events:none;cursor:default;"><?= $row['project_name']; ?></a></li> 

	<?php } else if ($layout_context == 'homepage') { ?>

	<li class="project-name">| <a name="tab4" class="project-link tabs tab-links show-notes"><div class="tooltip"><span class="tooltiptext">Project notes</span><input type="submit" id="yotab4" name="tab4" value="<?= $row['project_name']; ?>"></div></a></li>
	
	<?php } else { ?>

  <li class="project-name" style="cursor:default;">| <span style="margin-left:0.5em;cursor:default;"><?= $row['project_name']; ?></span></li> 

  <?php } 

	break;

	default : break;
}

?>