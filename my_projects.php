<?php $layout_context = "my_projects";

require_once 'config/initialize.php';


$user_id = $_SESSION['id'];

?>
<?php
$any_projects_for_user = find_users_projects($user_id);
$projects = mysqli_num_rows($any_projects_for_user);
?>
<?php require '_includes/head.php'; ?>
<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>

<div id="table-page" class="my-projects">
 	<div id="project-wrap">
<?php show_session_variables(); ?>
  <div class="project-greeting">
    <div>
      <p class="h">My account info</p>
      <p>First name: <?= $_SESSION['firstname']; ?> | Last name: <?= $_SESSION['lastname']; ?></p>
      <p>Username: <?= $_SESSION['username']; ?></p>
      <p>Email: <?= $_SESSION['email']; ?></p>
    </div>
    <div>
      <form class="gth" method="post">
        <input type="hidden" name="startanewproject" value="yo">
        <input type="hidden" name="my_projects" value="yo">
        <a class="np-link"><i class="far fa-plus-square"></i> Start a new project</a>
      </form>
    </div>
  </div>

<ul class="manage-my-projects">
<?php 
/* find out if user has any projects they manage */
if ($projects > 0) { 
/* (321) */

  if (isset($_SESSION['ds'])) {
    echo '<div id="success-wrap"><span class="success-msg">Delete successful!</span></div>';
    unset($_SESSION['ds']); 
  }
  if (isset($_SESSION['leaveproject'])) {
    echo '<div id="success-wrap"><span class="success-msg">Adios amigos!</span></div>';
    unset($_SESSION['leaveproject']); 
  }


	while ($row = mysqli_fetch_assoc($any_projects_for_user)) { 
  /* (123) while this user has projects, list them. */
		$this_project = $row['project_id'];
		$sharing = show_shared_with_info($user_id, $this_project);
		
	if (($row['owner_id'] == $_SESSION['id']) || ($row['shared_with'] == $_SESSION['id'])) { //(xyz) 
	/* making sure visitor is one of the users listed as either owner_id or shared_with */ 

	$is_it_shared = is_this_project_shared($this_project);
	$result2 = mysqli_num_rows($is_it_shared); 
  /* did we find any shared results? if so... */

	if ($result2 > 0) { 
  /* (abc) we found shared results - here's a special version of results so we can display them. */

	if (($row['owner_id'] == $user_id) && ($row['shared_with'] != $user_id)) { 
  /* if you're the owner */ ?>
	<li>

		<div class="review-project my-projects">

			<div class="pro-left">
        <form class="hmp" method="post">
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="go_to_homepage" value="1">
          <a class="gth-link shared"><i class="fas fa-home fa-fw"></i></a>
        </form>
      </div>

			<div class="pro-right">
        <div>
          <?= $row['project_name']; ?>
        </div> 
        <div class="tooltip">
          <span class="tooltiptext">This project is shared</span><i class="fas fa-user-friends"></i>
        </div>
      </div> 

		</div><!-- .review-project .my-projects -->

		<div class="project-details">

		<?php /* nav for YOU owner -> sharing with others */ ?> 
		<ul class="inner-nav project-pg">
			<li>
        <form method="post">
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="go_to_homepage" value="1">
          <div class="tooltip"><span class="tooltiptext">Homepage of this project</span><a class="gth-link"><i class="fas fa-home fa-fw"></i></a></div>
        </form>
			</li>
			<li>
				<form method="post">
  				<input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="organizesearchfields" value="1">
          <div class="tooltip"><span class="tooltiptext">Organize search fields</span><a class="osf-link"><i class="fas fa-sort fa-fw"></i></a></div>
				</form>
			</li>
	    <li>
        <form method="post">
          <input type="hidden" name="editthesedetails" value="yo">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <a class="epd-link"><div class="tooltip"><span class="tooltiptext">Project name &amp; notes</span><i class="fas fa-info-circle fa-fw"></i></div></a>
        </form>
	    </li>
	    <li>
	    	<form method="post">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="shareproject" value="yo">
          <a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
        </form>
	    </li>
      <li>
        <form method="post">
          <input type="hidden" name="deleteproject" value="yo">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <a class="dp-link"><div class="tooltip"><span class="tooltiptext">Delete Project</span><i class="fas fa-minus-circle fa-fw"></i></div></a>
        </form>
      </li>

		</ul>

    <div class="shared-with">

    <?php echo "Owner: You | Sharing with: ";
    /* get names ready in case this project is shared being shared with multiple people. add comma between names, remove last one. */
    while ($row3 = mysqli_fetch_assoc($sharing)) { 
      $names[] = $row3['first_name'] . " " . $row3['last_name'] . ", ";  
    } 
    echo rtrim(implode(array_unique($names)), ', ');
    unset($names);
    ?>

    </div>

    <?php 
    if (($row['project_notes']) != "") { ?>
      <div class="project-notes">
        <p><?= h($row['project_notes']); ?><p>
      </div><!-- .project-notes -->
    <?php } else { ?>
      <div class="project-notes my-projects-pg">
        <p>This project has nary a note.</p>
      </div><!-- .project-notes -->
    <?php } ?>

		</div><!-- .project-details -->
	</li>

	<?php } else { /* if you're the shared_with */ ?>

	<li>
    <div class="review-project my-projects">

      <div class="pro-left">
        <form class="hmp" method="post">
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="go_to_homepage" value="1">
          <a class="gth-link shared"><i class="fas fa-home fa-fw"></i></a>
        </form>
      </div>

      <div class="pro-right">
        <div>
          <?= $row['project_name']; ?>
        </div> 
        <div class="tooltip">
          <span class="tooltiptext">This project is shared</span><i class="fas fa-user-friends"></i>
        </div>
      </div> 
       
    </div><!-- .review-project .my-projects -->

		<div class="project-details">
		<?php /* nav if this project is being shared with you (you are not the owner) */ ?>

		<ul class="inner-nav project-pg">
			<li>
				<form method="post">
        <input type="hidden" name="user_id" value="<?= $user_id; ?>">
				<input type="hidden" name="current_project" value="<?= $row['id']; ?>">
				<input type="hidden" name="go_to_homepage" value="1">
        <div class="tooltip"><span class="tooltiptext">Homepage of this project</span><a class="gth-link"><i class="fas fa-home fa-fw"></i></a></div>
				</form>
			</li>
			<li>
				<form method="post">
				<input type="hidden" name="current_project" value="<?= $row['id']; ?>">
        <input type="hidden" name="organizesearchfields" value="1">
        <div class="tooltip"><span class="tooltiptext">Organize search fields</span><a class="osf-link"><i class="fas fa-sort fa-fw"></i></a></div>
				</form>
			</li>
	    <?php if ($row['share'] == "1") { ?>
	    <li>
	    	<form method="post">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="shareproject" value="yo">
          <a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
        </form>
	    </li>
			<?php }
      /* give the shared_with user an option to quit this project */ ?>

      <li>
        <form method="post">
          <input type="hidden" id="project_name" name="project_name" value="<?= $row['project_name']; ?>">
          <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
          <input type="hidden" id="username" name="username" value="<?= $row['first_name'] . ' ' . $row['last_name']; ?>">
          <input type="hidden" id="leave_project" name="leave_project" value="<?= $user_id; ?>">
          <a class="leaveproject"><div class="tooltip"><span class="tooltiptext">Leave Project</span><i class="fas fa-minus-circle fa-fw"></i></div></a>
        </form>
      </li>

		</ul>
		<?php /*
			below, need to show the current project owner's first & last name
			- and also shared_with's first and last name. these cannot be done 
			in one function because both require u.fist_name & u.last_name.
		*/ ?>
		<div class="shared-with">
		<?php echo "Project Owner: ";
		$owner = show_owner_info($this_project);
		$row4 = mysqli_fetch_assoc($owner); // this will return 1 name (first + last)
		echo $row4['first_name'] . " " . $row4['last_name']; // project owner's name
		// mysqli_free_result($owner);

		echo " | Shared with: You";

		$this_project = $row['project_id'];
		$foo = show_shared_with_info($user_id, $this_project);
		$anything_here = mysqli_num_rows($foo);

		if ($anything_here > 0) {
      while ($row3 = mysqli_fetch_assoc($foo)) { 
        $names[] = ", " . $row3['first_name'] . " " . $row3['last_name'] . ", ";  
      } 
      echo rtrim(implode(array_unique($names)), ', ');
      unset($names);
			} ?>
		</div>

    <?php 
    if(($row['project_notes']) != "") { ?>
      <div class="project-notes">
        <p><?= h($row['project_notes']); ?><p>
      </div><!-- .project-notes -->
    <?php } else { ?>
      <div class="project-notes my-projects-pg">
        <p>This project has nary a note.</p>
      </div><!-- .project-notes -->
    <?php } ?>

		</div><!-- .project-details -->
	</li>
<?php }  //mysqli_free_result($owner); ?>
<?php 	 } else { // this project is not shared  ?>         
<?php // ^ (abc) ?>
	<li>

    <div class="review-project my-projects">

      <div class="pro-left">
        <form class="hmp" method="post">
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="go_to_homepage" value="1">
          <a class="gth-link shared"><i class="fas fa-home fa-fw"></i></a>
        </form>
      </div>

      <div class="pro-right">
        <div>
          <?= $row['project_name']; ?>
        </div> 
      </div> 

    </div><!-- .review-project .my-projects -->

		<div class="project-details">
		<?php /* nav for YOU owner -> not shared with anyone */ ?>
		<ul class="inner-nav project-pg">
			<li>
				<form method="post">
  				<input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
  				<input type="hidden" name="go_to_homepage" value="1">
          <div class="tooltip"><span class="tooltiptext">Homepage of this project</span><a class="gth-link"><i class="fas fa-home fa-fw"></i></a></div>
				</form>
			</li>
			<li>
				<form method="post">
				<input type="hidden" name="current_project" value="<?= $row['id']; ?>">
        <input type="hidden" name="organizesearchfields" value="1">
        <div class="tooltip"><span class="tooltiptext">Organize search fields</span><a class="osf-link"><i class="fas fa-sort fa-fw"></i></a></div>
				</form>
			</li>
	    <li>
        <form method="post">
          <input type="hidden" name="editthesedetails" value="yo">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <a class="epd-link"><div class="tooltip"><span class="tooltiptext">Project name &amp; notes</span><i class="fas fa-info-circle fa-fw"></i></div></a>
        </form>
	    </li>
	    <li>
        <form method="post">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <input type="hidden" name="shareproject" value="yo">
	    	  <a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
        </form>
	    </li>
      <li>
        <form method="post">
          <input type="hidden" name="deleteproject" value="yo">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
          <a class="dp-link"><div class="tooltip"><span class="tooltiptext">Delete Project</span><i class="fas fa-minus-circle fa-fw"></i></div></a>
        </form>
      </li>

		</ul>
    <div class="shared-with">

    <?php echo "Owner: You | Not shared";?>

    </div>

    <?php 
    if(($row['project_notes']) != "") { ?>
      <div class="project-notes">
        <p><?= h($row['project_notes']); ?><p>
      </div><!-- .project-notes -->
    <?php } else { ?>
      <div class="project-notes my-projects-pg">
        <p>This project has nary a note.</p>
      </div><!-- .project-notes -->
    <?php } ?>

		</div><!-- .project-details -->
	</li>
	<?php }  ?>

	<?php } //(xyz) end if owner_id == $_SESSION['id'] || shared_width == $_SESSION['id']
 	} //(123) end while loop (while this user has projects, list them)

	} else { // user has no meetings to manage
 // ^(321) -> if (projects > 0)
		header('location:' . WWW_ROOT );
		// echo "<p class=\"query-tinkerer\">You have no projects. How did you get here?</p>";
	}  mysqli_free_result($any_projects_for_user); ?>

	</ul><!-- .manage-my-projects -->
	</div><!-- #project-wrap -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>