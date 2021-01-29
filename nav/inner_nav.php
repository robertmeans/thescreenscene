<?php
	switch ($inner_nav_context) { // start shared_with navigation
		
	case 'shared_with' :
	if ($layout_context != 'homepage') { ?>	
	<li><a href="<?= WWW_ROOT ?>"><div class="tooltip"><span class="tooltiptext">Homepage of this project</span><i class="fas fa-house-user fa-fw"></i></div></a></li>
	<?php }

	if (($row['edit'] == "1") && ($layout_context == 'homepage')) { ?>
	<li>
		<form id="et-form" action="" method="post">
			<input type="hidden" id="ownShare" name="ownShare" value="0">
			<input type="hidden" id="curpro" name="current_project" value="<?= $current_project; ?>">
			<input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
			<input type="checkbox" id="et1" name="edit_toggle" value="1" <?php if ($row['edit_toggle'] == "1") { echo "checked"; }  ?>>
			<a href="#" id="edit-content" class="static <?php if ($row['edit_toggle'] == "1") { echo "active"; }  ?>"><div class="tooltip"><span class="tooltiptext">Edit bookmarks</span><i class="far fa-edit fa-fw"></i></div></a>
		</form>
	</li>
	<?php }

	if ($layout_context != 'edit_order') { ?>
	<li><a href="edit_searches.php"><div class="tooltip"><span class="tooltiptext">Reorder search fields</span><i class="fas fa-sort fa-fw"></i></div></a></li>
	<?php }

	if ($row['share'] == "1") { ?>
	<li><a href="share_project.php?id=<?= $row['project_id']; ?>"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a></li>
	<?php }

	if ($layout_context == 'homepage') { ?>
	<li>
		<a href="#" class="static"><div class="tooltip"><span class="tooltiptext">Color theme</span><i class="fas fa-fill-drip fa-fw"></i></div></a>
		<ul>
			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="1">
				<input type="hidden" name="shared_with" value="1">
				<a href="#" class="static darkmode" onclick="$(this).closest('form').submit()">Dark Mode</a>
			</form>
			</li>			
			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="2">
				<input type="hidden" name="shared_with" value="1">
				<a href="#" class="static spring" onclick="$(this).closest('form').submit()">Spring</a>
			</form>
			</li>
<!-- 			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="3">
				<input type="hidden" name="shared_with" value="1">
				<a href="#" class="static classic" onclick="$(this).closest('form').submit()">Classic</a>
			</form>
			</li> -->
		</ul>
	</li>
	<?php } 

	if ($layout_context == 'edit_hyperlinks') { ?>
	<li class="project-name">| <span class="attn">EDITING:</span> <a href="my_projects.php" class="project-link"><?= $row['project_name']; ?></a></li>

	<?php } else { ?>
	<li class="project-name">| <a href="my_projects.php" class="project-link"><div class="tooltip"><span class="tooltiptext">My Projects</span><?= $row['project_name']; ?></div></a></li>
	<?php }


	break; // end shared_with navigation | begin owner navigation


	case 'owner' :	
	if ($layout_context != 'homepage') { // begin owner navigation ?>	
	<li><a href="<?= WWW_ROOT ?>"><div class="tooltip"><span class="tooltiptext">Homepage of this project</span><i class="fas fa-house-user fa-fw"></i></div></a></li>
	<?php } 

	if (($layout_context == 'homepage')) { ?>
	<li>
		<form id="et-form" action="" method="post">
			<input type="hidden" id="ownShare" name="ownShare" value="1">
			<input type="hidden" id="curpro" name="current_project" value="<?= $current_project; ?>">
			<input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
			<input type="checkbox" id="et1" name="edit_toggle" value="1" <?php if ($row['edit_toggle'] == "1") { echo "checked"; }  ?>>
			<a href="#" id="edit-content" class="static <?php if ($row['edit_toggle'] == "1") { echo "active"; }  ?>"><div class="tooltip"><span class="tooltiptext">Edit bookmarks</span><i class="far fa-edit fa-fw"></i></div></a>
		</form>
	</li>
	<?php }

	if ($layout_context != 'edit_order') { ?>
	<li><a href="edit_searches.php"><div class="tooltip"><span class="tooltiptext">Reorder search fields</span><i class="fas fa-sort fa-fw"></i></div></a></li>
	<?php }

	if ($layout_context != 'edit_order') { ?>
	<li><a href="edit_order.php"><div class="tooltip"><span class="tooltiptext">Rearrange bookmarks</span><i class="fas fa-arrows-alt fa-fw"></i></div></a></li>
	<?php } ?>

	<li><a href="share_project.php?id=<?= $row['project_id']; ?>"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a></li>

	<?php if ($layout_context == 'homepage') { ?>
	<li>
		<a href="#" class="static"><div class="tooltip"><span class="tooltiptext">Color theme</span><i class="fas fa-fill-drip fa-fw"></i></div></a>
		<ul>
			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="1">
				<input type="hidden" name="owner" value="1">
				<a href="#" class="static darkmode" onclick="$(this).closest('form').submit()">Dark Mode</a>
			</form>
			</li>			
			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="2">
				<input type="hidden" name="owner" value="1">
				<a href="#" class="static spring" onclick="$(this).closest('form').submit()">Spring</a>
			</form>
			</li>
<!-- 			<li>
			<form action="" method="post">
				<input type="hidden" name="color" value="3">
				<input type="hidden" name="owner" value="1">
				<a href="#" class="static classic" onclick="$(this).closest('form').submit()">Classic</a>
			</form>
			</li> -->
		</ul>
	</li>
	<?php } 

	if ($layout_context == 'edit_hyperlinks') { ?>
	<li class="project-name">| <span class="attn">EDITING:</span> <a href="my_projects.php" class="project-link"><?= $row['project_name']; ?></a></li>

	<?php } else if ($layout_context == 'edit_order') { ?>
	<li class="project-name">| <span class="attn">Drag &amp; Drop:</span> <a href="my_projects.php" class="project-link"><?= $row['project_name']; ?></a></li> 

	<?php } else if ($layout_context == 'delete_project') { ?>
	<li class="project-name">| <span class="attn">DELETE:</span> <a href="my_projects.php" class="project-link"><?= $row['project_name']; ?></a></li> 

	<?php } else { ?>
	<li class="project-name">| <a href="my_projects.php" class="project-link"><div class="tooltip"><span class="tooltiptext">My Projects</span><?= $row['project_name']; ?></div></a></li> 
	<?php }



	break;



	default : break;
}

?>