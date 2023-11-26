<?php $layout_context = "share_project";

require_once 'config/initialize.php';

$row = show_project_to_owner($current_project);
$project_name = $row['project_name']; 

require '_includes/head.php'; ?>

<body>
<?php require '_includes/nav.php'; ?>

<div id="table-page">
 	<div id="project-wrap">
 	<div class="sharing">

	<?php 

		if ($row != NULL && ((($row['owner_id'] || $row['shared_with']) == $user_id) && $row['share'] == "1")) { 

    $whos_project = owner_or_shared_with($current_project, $user_id);
    $owner = mysqli_num_rows($whos_project);

    if ($owner > 0) { // (0105212030) this is the owner of the project
     
    $inner_nav_context = "owner";
    $layout_context = "share_project"; ?>

<ul class="inner-nav" style="float:none;margin:0.75em 0em;">
  <?php require 'nav/inner_nav.php'; ?>
</ul>

<p class="owner-txt">You are the OWNER of this project.</p>

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

 	<form method="post">
 		<input type="hidden" name="project_name" value="<?= $row['project_name']; ?>">
    <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
 		
 		<input id="user-email" type="email" name="user_email" placeholder="Email address of user with whom to share">

 		<p>Select the privliges for this user</p>

 		<label for="edit" class="edit"><input id="edit" type="checkbox" class="edit" name="edit" value="1"><div class="echeckon"><i class="fas fa-check"></i></div> Add, edit or delete links in this project.</label>

 		<label for="share" class="share"><input id="share" type="checkbox" class="share" name="share" value="1"><div class="scheckon"><i class="fas fa-check"></i></div> Share this project, and these permissions, with others.</label>

 		<div class="share-note">Note: Only an owner of a project can rename or delete their project no matter what permissions are shared here. Default permissions are VIEW ONLY.</div>

    <input type="hidden" name="owner-share-submit" value="yo">
    
    <div id="buttons">
      <a class="shareproject submit full-width">Share</a>
    </div>

 	</form>

      <div class="shared-users">
        <h2 class="edit-share">Project Users</h2>
        <ul id="shared-list" class="shared-list">

<?php
	$this_project = $row['project_id'];
	$is_it_shared = is_this_project_shared($this_project);
	$result = mysqli_num_rows($is_it_shared); // did we find any shared results? if so...

	if ($result > 0) { 

    $sharing = show_shared_with_info($user_id, $this_project); 

    while ($row = mysqli_fetch_assoc($sharing)) { 
      $names[] = '<li><form class="edit-user" method="post">' . $row['first_name'] . ' ' . $row['last_name'] . ' (' . $row['email'] . ') ' . '<input type="hidden" name="delete-shared-user" value="' . $row['shared_with'] . '">
        <input type="hidden" id="project_id" name="project_id" value="' .  $row['project_id'] . '">
        <input type="hidden" id="project_name" name="project_name" value="' . $project_name . '">
        <input type="hidden" id="username" name="username" value="' . $row['first_name'] . ' ' . $row['last_name'] . '">
        <a class="rsu removeshareduser">Remove</a>
      </form></li>'; 
    } 

		if ($names) { ?>
  		  <?php	echo implode($names); ?>
	   <?php } 
	} else { ?> 
      <li class="alone">Just me</li>
  <?php } ?>
        </ul>
      </div>







<?php } else { 
  /* this is someone who the project is shared with */
	$row = show_project_to_shared($current_project, $user_id);
	if ($row['share'] == "1") { // (0106211755)
?>
  <?php 
  $inner_nav_context = "shared_with";
  $layout_context = "share_project"; ?>
  <ul class="inner-nav" style="float:none;margin:0.75em 0em;">
    <?php require 'nav/inner_nav.php'; ?>
  </ul>

  <p class="owner-txt" style="line-height:1.5em;">This project is being SHARED with you. You have been given permission to share with others.</p>

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

 	<form method="post">
 		<input type="hidden" name="project_name" value="<?= $row['project_name']; ?>">
    <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
 		
 		<input type="email" name="user_email" class="<?php if(isset($errors['email_error'])) { echo "email-error"; } ?>" placeholder="Email address of user with whom to share">

 		<p>Select the privliges for this user</p>

 		<?php if ($row['edit'] == "1") { ?>
 		<label for="edit" class="edit"><input id="edit" type="checkbox" class="edit" name="edit" value="1"><div class="echeckon"><i class="fas fa-check"></i></div> Edit - Allow this person to add, edit or delete links in this project.</label>
 		<?php } ?>

 		<?php if ($row['share'] == "1") { ?>
 		<label for="share" class="share"><input id="share" type="checkbox" class="share" name="share" value="1"><div class="scheckon"><i class="fas fa-check"></i></div> Share - Allow this person to share this project with others.</label>
 		<?php } ?>

 		<div class="share-note">Note: Only an owner of a project can rename or delete their project no matter what permissions are shared here. Default permissions are VIEW ONLY.</div>

    <input type="hidden" name="sharer-share-submit" value="yo">
    <!-- <a class="shareproject">Share</a> -->
    <div id="buttons">
      <a class="shareproject submit full-width">Share</a>
    </div>



 	</form>

  <div class="shared-users">
    <h2 class="edit-share">Project Users</h2>
    <ul id="shared-list" class="shared-list">


<?php
	$this_project = $row['project_id'];
	$is_it_shared = is_this_project_shared($this_project);
	$result = mysqli_num_rows($is_it_shared); // did we find any shared results? if so...

	?>
	<li>
    <form class="edit-user remove-self" method="post"> 
      <div>Me</div>
      <input type="hidden" id="project_name" name="project_name" value="<?= $row['project_name']; ?>">
      <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
      <input type="hidden" id="username" name="username" value="<?= $row['first_name'] . ' ' . $row['last_name']; ?>">
      <input type="hidden" id="remove_me" name="remove_me" value="<?= $user_id; ?>">
      <a class="rsu removeme">Leave</a>
    </form>
  </li>
	<?php
	if ($result > 1) {
		$sharing = show_shared_with_info($user_id, $this_project);

    while ($row = mysqli_fetch_assoc($sharing)) { 
      $names[] = '<li><form class="edit-user" method="post">' . $row['first_name'] . ' ' . $row['last_name'] . ' (' . $row['email'] . ') ' .  '<input type="hidden" name="delete-shared-user" value="' . $row['shared_with'] . '">
                <input type="hidden" id="project_id" name="project_id" value="' .  $row['project_id'] . '">
                <a class="rsu removeshareduser">Remove</a>
              </form></li>';
          }



		if ($names) {
			echo implode($names); 
  } else { ?> 
      <li class="alone">Just me</li>
  <?php } ?>


<?php	} ?>
        </ul>
      </div><!-- 1125231548 -->
<?php
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