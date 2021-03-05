<nav>
	<ul id="navtog">
	<!-- 1st link -->
	<?php
	switch ($layout_context) {
		default :	?><li><a class="logout" href="logout.php"><i class="fas fa-power-off"></i> Exit</a></li><?php 	break;
	}
	?>

	<!-- 2nd link... -->
	<?php
	switch ($layout_context) {
		case 'edit_order' 			:	?><li><a class="logout" href="<?= WWW_ROOT ?>"><i class="fas fa-home"></i> Home</a></li><?php 	break;
		case 'edit_searches' 		:	?><li><a class="logout" href="<?= WWW_ROOT ?>"><i class="fas fa-home"></i> Home</a></li><?php 	break;
		case 'delete_project' 	:	?><li><a class="logout" href="<?= WWW_ROOT ?>"><i class="fas fa-home"></i> Home</a></li><?php 	break;
		case 'my_projects' 			:	?><li><a class="logout" href="<?= WWW_ROOT ?>"><i class="fas fa-home"></i> Home</a></li><?php 	break;
		case 'share_project' 		:	?><li><a class="logout" href="<?= WWW_ROOT ?>"><i class="fas fa-home"></i> Home</a></li><?php 	break;
		default :	break;
	}
	?>

	<!-- 3rd link... -->
	<?php
	switch ($layout_context) {
		case 'my_projects' 				:	 	break;
		case 'home-first-visit' 	:	 	break;
		case 'no-projects' 	      :	 	break;
		// dropdown nav ->
		default :	?>
		<?php 
		$result = build_projects_navigation($user_id);
		$projects = mysqli_num_rows($result); // to use in if statement when you get to it
		?>
		<div class="menuitem">
			<div class="dropdown">
				<a class="pen">&nbsp;</a>
			<?php while ($rowg = mysqli_fetch_assoc($result)) { ?>		
				<form action="my_projects.php" method="post">
				<input type="hidden" name="current_project" value="<?= $rowg['project_id']; ?>">
				<input type="hidden" name="go_to_homepage" value="1">

					<a href="#" class="static dda" onclick="$(this).closest('form').submit()"><?= $rowg['project_name'] ?></a>
				</form>	
			<?php	} mysqli_free_result($result); ?>
					<a href="my_projects.php" class="dda">My Projects Page</a>
			</div>
			<div class="nav-item">
				<a class="projects-dd" href="my_projects.php"><i class="fas fa-list-ol"></i> Projects</a>
			</div>
		</div>
		<?php 	break;
	}
	?>

	</ul>
</nav>