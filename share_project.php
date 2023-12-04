<?php $layout_context = "share_project";

require_once 'config/initialize.php';

$row = show_project_to_owner($current_project);
$project_name = $row['project_name']; 

require '_includes/head.php'; ?>

<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>

<div id="table-page">
 	<div id="project-wrap">
 	<div class="sharing">

	<?php 

		if ($row != NULL && ((($row['owner_id'] || $row['shared_with']) == $user_id) && $row['share'] == "1")) { 

    $whos_project = owner_or_shared_with($current_project, $user_id);
    $owner = mysqli_num_rows($whos_project);

    if ($owner > 0) { 
    /* (0105212030) this is the owner of the project */
     
    $inner_nav_context = "owner";
    $layout_context = "share_project"; ?>

<ul class="inner-nav" style="float:none;margin:0.75em 0em;">
  <?php require 'nav/inner_nav.php'; ?>
</ul>
<?php show_session_variables(); ?>
<p class="owner-txt">You are the OWNER of this project.</p>

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

 	<form id="sharep" method="post">
 		<input type="hidden" name="project_name" value="<?= $row['project_name']; ?>">
    <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
 		
 		<input id="user-email" type="email" name="user_email" placeholder="Email address of user with whom to share">
<!--     <input type="hidden" class="edit" name="edit" value="0">
    <input type="hidden" class="share" name="share" value="0"> -->

 		<p>Select the permissions for this user</p>
    <div class="priv-box">

   		<div class="choice edit">
        <span class="editnocheck"><i class="far fa-square fa-fw"></i></span>
        <span class="editcheck"><i class="far fa-check-square fa-fw"></i></span>
        <input id="edit" type="checkbox" class="es" name="edit" value="0"> 
        <label class="edit" for="edit">Add, edit or delete links in this project.</label>
      </div>

   		<div class="choice share">
        <span class="sharenocheck"><i class="far fa-square fa-fw"></i></span>
        <span class="sharecheck"><i class="far fa-check-square fa-fw"></i></span>
        <input id="share" type="checkbox" class="ts" name="share" value="0">
        <label class="share" for="share">Share project, and permissions (if any) you assign this user, with others.</label>
      </div>

    </div>
 		<div class="share-note">Only an owner of a project can rename or delete their project no matter what permissions are shared here. You do not have to assign permissions. The default is VIEW ONLY.</div>

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
	$result = mysqli_num_rows($is_it_shared); 
  /* did we find any shared results? if so... */

	if ($result > 0) { 

    $sharing = show_shared_with_info($user_id, $this_project); 
    $i = 0;
    while ($row = mysqli_fetch_assoc($sharing)) { 
      $names[]  = '<li><form class="edit-user" method="post">';
      $names[]  .= $row['first_name'] . ' ' . $row['last_name'] . ' | ' . $row['email'];
      $names[]  .= '<input type="hidden" id="'.$i.'_dsuser" name="delete-shared-user" value="' . $row['shared_with'] . '">';
      $names[]  .= '<input type="hidden" id="'.$i.'_project_id" name="project_id" value="' .  $row['project_id'] . '">';

      $names[]  .= '<input type="hidden" id="'.$i.'_edit" name="'.$i.'_edit" value="';
      if ($row['edit'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
      $names[]  .= '">';

      $names[]  .= '<input type="hidden" id="'.$i.'_share" name="'.$i.'_share" value="';
      if ($row['share'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
      $names[]  .= '">';

      $names[]  .= '<input type="hidden" id="'.$i.'_project_name" name="project_name" value="' . $project_name . '">';
      $names[]  .= '<input type="hidden" id="'.$i.'_username" name="username" value="' . $row['first_name'] . ' ' . $row['last_name'] . '">';
      // $names[]  .= '<a class="rsu removeshareduser">Remove</a>';
      $names[]  .= '<a data-id="'.$i.'" class="rsu editshareduser">Edit</a>';
      $names[]  .= '</form><span>Permissions: ';
      if ($row['share'] == 0 && $row['edit'] == 0) { $names[]  .= 'View only'; }
      if ($row['edit'] == 1) { $names[]  .= 'Can edit'; }
      if ($row['share'] == 1 && $row['edit'] == 1) { $names[]  .= ' + '; }
      if ($row['share'] == 1) { $names[]  .= 'Can share'; }
      $names[]  .= '</span></li>'; 
      $i++; 
    } 

		if (isset($names)) { ?>
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
	if ($row['share'] == "1") { /* (0106211755) */
?>
  <?php 
  $inner_nav_context = "shared_with";
  $layout_context = "share_project"; ?>
  <ul class="inner-nav" style="float:none;margin:0.75em 0em;">
    <?php require 'nav/inner_nav.php'; ?>
  </ul>
<?php show_session_variables(); ?>
  <p class="owner-txt" style="line-height:1.5em;">This project is being SHARED with you. You have been given permission to share with others.</p>

  <div id="message"> 
    <ul id="msg-ul"></ul>
  </div>

 	<form id="sharep" method="post">
 		<input type="hidden" name="project_name" value="<?= $row['project_name']; ?>">
    <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
 		
    <input id="user-email" type="email" name="user_email" placeholder="Email address of user with whom to share">

 		<p>Select the permissions for this user</p>
    <div class="priv-box">

 		<?php if ($row['edit'] == "1") { ?>
      <div class="choice">
        <input id="edit" type="checkbox" class="edit" name="edit" value="1"> 
        <label class="edit" for="edit">Add, edit or delete links in this project.</label>
      </div>
 		<?php } ?>

 		<?php if ($row['share'] == "1") { ?>
      <div class="choice">
        <input id="share" type="checkbox" class="share" name="share" value="1">
        <label class="share" for="share">Share project, and permissions (if any) you assign this user, with others.</label>
      </div>
 		<?php } ?>

    </div>
    <div class="share-note">Only an owner of a project can rename or delete their project no matter what permissions are shared here. You do not have to assign permissions. The default is VIEW ONLY.</div>

    <input type="hidden" name="sharer-share-submit" value="yo">

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
	$result = mysqli_num_rows($is_it_shared); 
  /* did we find any shared results? if so... */

	?>
	<li>
    <form class="edit-user remove-self" method="post"> 
      <div>Me</div>
      <input type="hidden" id="project_name" name="project_name" value="<?= $row['project_name']; ?>">
      <input type="hidden" id="project_id" name="project_id" value="<?= $row['project_id']; ?>">
      <input type="hidden" id="username" name="username" value="<?= $row['first_name'] . ' ' . $row['last_name']; ?>">
      <input type="hidden" id="remove_me" name="remove_me" value="<?= $user_id; ?>">
      <a class="rsu removeme">Leave</a>
    </form><span>Permissions: <?php
      if ($row['share'] == 0 && $row['edit'] == 0) { echo 'View only'; }
      if ($row['edit'] == 1) { echo 'Can edit'; }
      if ($row['share'] == 1 && $row['edit'] == 1) { echo ' + '; }
      if ($row['share'] == 1) { echo 'Can share'; }
    ?></span>
  </li>
	<?php
	if ($result > 1) {
		$sharing = show_shared_with_info($user_id, $this_project);
    $i = 0;
    while ($row = mysqli_fetch_assoc($sharing)) { 

      $names[]  = '<li><form class="edit-user" method="post">';
      $names[]  .= $row['first_name'] . ' ' . $row['last_name'] . ' | ' . $row['email'];
      $names[]  .= '<input type="hidden" id="'.$i.'_dsuser" name="delete-shared-user" value="' . $row['shared_with'] . '">';
      $names[]  .= '<input type="hidden" id="'.$i.'_project_id" name="project_id" value="' .  $row['project_id'] . '">';

      $names[]  .= '<input type="hidden" id="'.$i.'_edit" name="'.$i.'_edit" value="';
      if ($row['edit'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
      $names[]  .= '">';

      $names[]  .= '<input type="hidden" id="'.$i.'_share" name="'.$i.'_share" value="';
      if ($row['share'] == 1) { $names[]  .= '1'; } else { $names[] .= '0'; }
      $names[]  .= '">';

      $names[]  .= '<input type="hidden" id="'.$i.'_project_name" name="project_name" value="' . $project_name . '">';
      $names[]  .= '<input type="hidden" id="'.$i.'_username" name="username" value="' . $row['first_name'] . ' ' . $row['last_name'] . '">';
      // $names[]  .= '<a class="rsu removeshareduser">Remove</a>';
      $names[]  .= '<a data-id="'.$i.'" class="rsu editshareduser">Edit</a>';
      $names[]  .= '</form><span>Permissions: ';
      if ($row['share'] == 0 && $row['edit'] == 0) { $names[]  .= 'View only'; }
      if ($row['edit'] == 1) { $names[]  .= 'Can edit'; }
      if ($row['share'] == 1 && $row['edit'] == 1) { $names[]  .= ' + '; }
      if ($row['share'] == 1) { $names[]  .= 'Can share'; }
      $names[]  .= '</span></li>'; 
      $i++;
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
} else { /* (0106211755) */
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
<!-- Modal -->
<div id="theModal" class="esu modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div id="esu-content" class="modal-content">
      <div class="modal-header">
        <a class="static closefp"><i class="fas fa-times-circle"></i></a>
        <h4 id="smht" class="modal-title">Edit Permissions | Remove from Project</h4>
      </div>
      <div class="modal-body">

      <div id="esu-message"> 
        <ul id="esu-msg-ul"></ul>
      </div>

      <form id="esModal" class="sharemodal sharing" action="post">
        <input type="hidden" id="delete-shared-user" name="delete-shared-user">
        <input type="hidden" id="pro-id" name="project_id">
        <input type="hidden" id="username" name="username">
        <input type="hidden" id="project_name" name="project_name">

        <div class="priv-box">

          <div id="editperm" class="choice edit2">
            <span class="editnocheck2"><i class="far fa-square fa-fw"></i></span>
            <span class="editcheck2"><i class="far fa-check-square fa-fw"></i></span>
            <input id="edit2" type="checkbox" class="edit2" name="edit2" value="1"> 
            <label class="edit2" for="edit2">Add, edit or delete links in this project.</label>
          </div>

          <div id="shareperm" class="choice share2">
            <span class="sharenocheck2"><i class="far fa-square fa-fw"></i></span>
            <span class="sharecheck2"><i class="far fa-check-square fa-fw"></i></span>
            <input id="share2" type="checkbox" class="share2" name="share2" value="1">
            <label class="share2" for="share2">Share project, and permissions (if any) you assign this user, with others.</label>
          </div>

        </div>

        <div id="buttons">
          <a class="cancel delete removeshareduser">Remove user</a><a class="submit updateshareduser">Update</a>
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