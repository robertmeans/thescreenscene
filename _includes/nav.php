<nav>
	<ul id="navtog">
	<!-- 1st link -->
	<li class="desk-orient"><a class="logout" href="logout.php"><i class="fas fa-power-off"></i> Exit</a></li>

	<li class="mobile-orient"><a class="logout" href="logout.php"><i class="fas fa-power-off"></i> Exit</a></li>
	<?php if ($layout_context == 'homepage') { ?>
		<li class="mobile-orient"><a href="my_projects.php" class="logout"><i class="fas fa-list-ol"></i> Projects</a></li>
	<?php } ?>
	<!-- 2nd link... -->
	<?php
	switch ($layout_context) {
		case 'home-first-visit' :	 	break;
		case 'no-projects' 	    :	 	break;
		/* dropdown nav */
		default :	?>
		<?php 
		$result = build_projects_navigation($user_id);
		$projects = mysqli_num_rows($result); // to use in if statement when you get to it
		?>
		<div id="theDropdown" class="menuitem">
			<div class="dropdown">
				<a class="pen">&nbsp;</a>
				<!-- working on fuzzy search... -->
				<span><i class="fas fa-search fa-fw"></i><input class="nav-ac" type="text" id="dd_searchInput" placeholder="Search..." tabinex="1"></span>
			<form method="post"><input type="hidden" name="viewprojectspage" value="yo"><a class="vpp-link dda vpp">View Projects Page</a></form>
			<?php 
      $i = 2;
      while ($rowg = mysqli_fetch_assoc($result)) { ?>		
				<form method="post" class="dd">
        <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
        <input type="hidden" name="user_id" value="<?= $user_id; ?>">

        <?php /*
        ***************************** DON'T CHANGE A MOTHER FRICKIN' THING HERE! *****************************
        */ ?>

        <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project - about to be "last" */ ?>
        <input type="hidden" name="last_project_name" value="<?= $_SESSION['current_project_name']; ?>"><?php /* NAME of current project - about to be "last"  ... var here was: $row['project_name']; before changed to $_SESSION */ ?>

				<input type="hidden" name="current_project" value="<?= $rowg['project_id']; ?>"><?php /* ID of destination project */ ?>

        <?php /*
        ***************************** DON'T CHANGE A MOTHER FRICKIN' THING HERE! *****************************
        */ ?>

				<a class="gth-link dda" tabindex="<?= $i ?>"><?= $rowg['project_name']; ?></a>
				</form>	 
			<?php	$i++;
          } mysqli_free_result($result); ?>	
			</div>
			<div class="nav-item">
				<!-- <a class="projects-dd" href="my_projects.php"><i class="fas fa-list-ol"></i> Projects</a> -->
				<a class="projects-dd"><i class="fas fa-list-ol"></i> Projects</a>
			</div>
		</div> 
		<?php 	break;
	}
	?>
	</ul>
</nav>