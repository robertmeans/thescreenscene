<nav>
	<ul>
		<!-- 1st link -->
		<?php
		switch ($layout_context) {
			case 'home-first-visit' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'home-private' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'homepage' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'delete_project' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'edit_order' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'edit_searches' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'edit_hyperlinks' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'my_projects' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'share_project' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'project-view' 	:	echo "<li><a class=\"logout\" href=\"logout.php\"><i class=\"fas fa-power-off\"></i> Exit</a></li>"; 	break;
			case 'home-public' 		:	echo "<li><a class=\"logout\" href=\"login.php\"><i class=\"fas fa-sign-in-alt\"></i> Login</a></li>"; 		break;
			default 				:	 																				break;
		}
		?>

		<!-- 2nd link... -->
		<?php
		switch ($layout_context) {
			case 'edit_order' 	:	echo "<li><a class=\"logout\" href=" . WWW_ROOT . "><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;
			case 'edit_hyperlinks' 	:	echo "<li><a class=\"logout\" href=" . WWW_ROOT . "><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;
			case 'edit_searches' 	:	echo "<li><a class=\"logout\" href=" . WWW_ROOT . "><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;
			case 'delete_project' 	:	echo "<li><a class=\"logout\" href=" . WWW_ROOT . "><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;

			// case 'projects' 	:	echo "<li><a class=\"logout\" href=\"project_view.php?id=" . h(u($row['id'])) . "\"><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;
			// ^^ look at this later - can't use the GET $id if routed from home > projects > home
			case 'my_projects' 	:	echo "<li><a class=\"logout\" href=" . WWW_ROOT . "><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;
			case 'share_project' 	:	echo "<li><a class=\"logout\" href=" . WWW_ROOT . "><i class=\"fas fa-home\"></i> Home</a></li>"; 	break;
			default 				:	 																				break;
		}
		?>


		<!-- 3rd link... -->
		<?php
		switch ($layout_context) {
			case 'home-private' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'homepage' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'delete_project' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'edit_order' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'edit_hyperlinks' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'share_project' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'edit_searches' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			case 'my_projects' 	:	 	break;
			case 'project-view' 	:	echo "<li><a class=\"logout\" href=\"my_projects.php\"><i class=\"fas fa-list-ol\"></i> Projects</a></li>"; 	break;
			default 				:	 																				break;
		}
		?>

		
		
	</ul>
</nav>