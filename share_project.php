<?php $layout_context = "share_project";

require_once 'config/initialize.php';
// require_once '_includes/session.php';

// off for local testing

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$user_id = $_SESSION['id'];
$id = $_GET['id'];
$current_project = $_GET['id'];

if (is_post_request()) {

	if (isset($_POST['owner-share-submit'])) {

		$row = [];
		$row['user_id'] 	= $user_id;
		$row['project_name'] = $_POST['project_name'];
		$row['users_email'] = $_POST['user_email'];

		$share = $_POST['share'] ?? '0';
		$edit = $_POST['edit'] ?? '0';

		//$role 	= $_POST['role']; // because $row[] gets repurposed in share_project() - below

		$result = owner_share_project($row, $user_id, $id, $share, $edit, $current_project); // validate & execute

		if ($result === true) { // INSERT was a success - everything validated and user was added to 
								// project. let's add a happy little personalized success message
								// just to keep things over the top, of couse.

			$users_email = $_POST['user_email'];
			$user = find_user_by_email($users_email);

		  	$errors = [];
		    $errors['successfully_added'] = "You have successfully added " . $user['first_name'] . " " . $user['last_name'] . " to the project \"" . $row['project_name'] . ".\"";

		} else { 
			$errors = $result; 
		}
	}



	if (isset($_POST['sharer-share-submit'])) {

		$row = [];
		$row['user_id'] 	= $user_id;
		$row['project_name'] = $_POST['project_name'];
		$row['users_email'] = $_POST['user_email'];
		$share = $_POST['share'] ?? '0';
		$edit = $_POST['edit'] ?? '0';

		// $role	= $_POST['role']; // because $row[] gets repurposed in share_project() - below

		$result = sharer_share_project($row, $user_id, $id, $share, $edit, $current_project); // validate & execute

		if ($result === true) { // INSERT was a success - everything validated and user was added to 
								// project. let's add a happy little personalized success message
								// just to keep things over the top, of couse.

			$users_email = $_POST['user_email'];
			$user = find_user_by_email($users_email);

		  	$errors = [];
		    $errors['successfully_added'] = "You have successfully added " . $user['first_name'] . " " . $user['last_name'] . " to the project \"" . $row['project_name'] . ".\"";

		} else { 
			$errors = $result; 
		}
	}

	if (isset($_POST['delete'])) {
		$remove_this_user = $_POST['delete-shared-user']   ?? '';
		// $from_this_project = $_POST['']  ?? '';

		$result = remove_shared_user($id, $remove_this_user);
	    if ($result === true) {
	      
	    } else {
	      //$errors = $result; 
	    }
	}

	if (isset($_POST['remove-self'])) {
		$remove_this_user = $_POST['delete-shared-user']   ?? '';
		// $from_this_project = $_POST['']  ?? '';

		$result = remove_me($id, $remove_this_user);
	    if ($result === true) {
	      
	    } else {
	      //$errors = $result; 
	    }
	}
}

$row = show_project_to_owner($current_project);

?>

<?php require '_includes/head.php'; ?>
<body>

<?php require '_includes/nav.php'; ?>

<div id="table-page">
 	<div id="project-wrap">
 	<div class="sharing">

	<?php 

		if ((($row['owner_id'] || $row['shared_with']) == $user_id) && $row['share'] == "1") { ?>

<?php
$whos_project = owner_or_shared_with($current_project, $user_id);
$owner = mysqli_num_rows($whos_project);
if ($owner > 0) { // (0105212030) this is the owner of the project
?>


		<h1><?= $row['project_name']; ?></h1>
		<?php echo "<p class=\"owner-txt\">You are the OWNER of this project.</p>"; ?>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger <?php if(isset($errors['successfully_added'])) { echo "success-instead"; } ?>">
	            <?php foreach($errors as $error): ?>
	            <li><?php echo $error; ?></li>
	        	<?php endforeach; ?>
            </div>
        <?php endif; ?>


 	<form action="" method="post">
 		<input type="hidden" name="project_name" value="<?= $row['project_name']; ?>">
 		
 		<input type="email" name="user_email" class="<?php if(isset($errors['email_error'])) { echo "email-error"; } ?>" placeholder="Email address of user with whom to share">

 		<p>Select the privliges for this user</p>

 		<label for="edit" class="edit"><input id="edit" type="checkbox" class="edit" name="edit" value="1"><div class="echeckon"><i class="fas fa-check"></i></div> Add, edit or delete links in this project.</label>



 		<label for="share" class="share"><input id="share" type="checkbox" class="share" name="share" value="1"><div class="scheckon"><i class="fas fa-check"></i></div> Share this project, and these permissions, with others.</label>

 		<div class="share-note">Note: Only an owner of a project can rename or delete their project no matter what permissions are shared here. Default permissions are VIEW ONLY.</div>

 		<input type="submit" name="owner-share-submit" value="Share">

 	</form>

<?php
	$this_project = $row['project_id'];
	$is_it_shared = is_this_project_shared($this_project);
	$result = mysqli_num_rows($is_it_shared); // did we find any shared results? if so...

	if ($result > 0) {
		$sharing = show_shared_with_info($user_id, $this_project);
		while ($row = mysqli_fetch_assoc($sharing)) { 
			$names[] = "<div class=\"shared-users\">
							<form class=\"edit-user\" action=\"\" method=\"post\"  
							onsubmit=\"return confirm('Confirm: Remove " . $row['first_name'] . " " . $row['last_name'] . " from project?');\">" 
								. $row['first_name'] . " " . $row['last_name'] . 
								"<input type=\"hidden\" name=\"delete-shared-user\" value=\"" 
								. $row['shared_with'] . "\">
								<div>
								<input type=\"submit\" class=\"remove\" name=\"delete\" value=\"Remove\">
								</div>
							</form>
						</div>";
		} 

		if ($names) {
			echo "<h2 class=\"edit-share\">Project Users</h2>";
			echo implode($names);
		} else {
			// echo "<h2 class=\"edit-share\">Edit Users</h2>";
			// echo "<p>You</p>";
		}
		//echo implode($names); 
	}
	// mysqli_free_result($row);
?>

<?php

} else { // this is someone who the project is shared with
	$row = show_project_to_shared($current_project, $user_id);
	if ($row['share'] == "1") { // (0106211755)
?>
		<h1><?= $row['project_name']; ?></h1>

        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger <?php if(isset($errors['successfully_added'])) { echo "success-instead"; } ?>">
	            <?php foreach($errors as $error): ?>
	            <li><?php echo $error; ?></li>
	        	<?php endforeach; ?>
            </div>
        <?php endif; ?>


 	<form action="" method="post">
 		<input type="hidden" name="project_name" value="<?= $row['project_name']; ?>">
 		
 		<input type="email" name="user_email" class="<?php if(isset($errors['email_error'])) { echo "email-error"; } ?>" placeholder="Email address of user with whom to share">

 		<p>Select the privliges for this user</p>

 		<?php if ($row['edit'] == "1") { ?>
 		<label for="edit" class="edit"><input id="edit" type="checkbox" class="edit" name="edit" value="1"><div class="echeckon"><i class="fas fa-check"></i></div> Edit - Allow this person to add, edit or delete links in this project.</label>
 		<?php } ?>

 		<?php if ($row['share'] == "1") { ?>
 		<label for="share" class="share"><input id="share" type="checkbox" class="share" name="share" value="1"><div class="scheckon"><i class="fas fa-check"></i></div> Share - Allow this person to share this project with others.</label>
 		<?php } ?>

 		<div class="share-note">Note: Only an owner of a project can rename or delete their project no matter what permissions are shared here. Default permissions are VIEW ONLY.</div>

 		<input type="submit" name="sharer-share-submit" value="Share">

 	</form>

<?php
	$this_project = $row['project_id'];
	$is_it_shared = is_this_project_shared($this_project);
	$result = mysqli_num_rows($is_it_shared); // did we find any shared results? if so...

	echo "<h2 class=\"edit-share\">Project Users</h2>";
	?>
	<form action="" class="remove-self" method="post" onsubmit="return confirm('Confirm: Remove yourself from <?= $row['project_name']; ?>?')">
		<p class="mep">Me</p>
		<input type="hidden" name="delete-shared-user" value="<?= $user_id; ?>">
		<input type="submit" name="remove-self" value="Leave this project">
	</form>
	<?php
	if ($result > 1) {
		$sharing = show_shared_with_info($user_id, $this_project);
		while ($row = mysqli_fetch_assoc($sharing)) { 
			$names[] = "<div class=\"shared-users\"><form class=\"edit-user\" action=\"\" method=\"post\" onsubmit=\"return confirm('Confirm: Remove " . $row['first_name'] . " " . $row['last_name'] . " from this project?');\">" . $row['first_name'] . " " . $row['last_name'] . "<input type=\"hidden\" name=\"delete-shared-user\" value=\"" . $row['shared_with'] . "\"><input type=\"submit\" class=\"remove\" name=\"delete\" value=\"Remove\">" . "</form></div>";
		} 

		if ($names) {
			// echo "<h2 class=\"edit-share\">Edit Users</h2>";
			echo implode($names);
		} else {

		} 
	}
} else { // (0106211755)
          echo "<p class=\"query-tinkerer\">The content you are seeking is not for you. Shield your eyes and run away!</p>";
    } 
}

    } else {
          echo "<p class=\"query-tinkerer\">The content you are seeking is not for you. Shield your eyes and run away!</p>";
    } 	
?>

 	</div><!-- .sharing -->
	</div><!-- #project-wrap -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>