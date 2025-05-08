<?php $layout_context = "my_projects";

require_once 'config/initialize.php';
 
$user_id = $_SESSION['id'];

$current_project_name = $_SESSION['current_project_name'];
$current_project = $_SESSION['current_project'];
$last_project = $_SESSION['last_project'];
$last_project_name = $_SESSION['last_project_name'];

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
  <div class="project-greeting">
    <div class="search-field">
      <i class="fas fa-search fa-fw"></i><input id="mp_searchInput" type="text" placeholder="Search...">
    </div>
  </div>


<ul id="ewd-search" class="manage-my-projects">
<?php 
/* query whether user is affiliated with any projects */
$any_projects_for_user = find_users_projects($user_id);
$projects = mysqli_num_rows($any_projects_for_user);

if ($projects > 0) { 
/* 1206230855 | begin: this user is EITHER owner OR shared_with. this will skip everything and quickly send them back to WWW_ROOT if they clicked on the 'My Projects' link but don't have projects. */

  flash_message();

  $i = 0;
  while ($row = mysqli_fetch_assoc($any_projects_for_user)) { 
  /* 1206230900 - while this user has projects, list them. we'll distinguish between owner or shared_with role within this while loop. this is just every project they are connected with, in alphabetical order. one of the 2 if statements below will figure out if they're owner or shared_with and prepare the appropriate display. */

    $this_project = $row['project_id'];
    $sharing = show_shared_with_info($user_id, $this_project);
    
  if (($row['owner_id'] == $_SESSION['id']) || ($row['shared_with'] == $_SESSION['id'])) { 
  /* 1206230902 | begin: user is either owner or shared_with */ 

  $is_it_shared = is_this_project_shared($this_project);
  $result2 = mysqli_num_rows($is_it_shared); 
  /* did we find any shared results? if so... */

  if ($result2 > 0) { 
  /* 1206230905 | we're inside a while loop. looking at each project this user is affiliated with, alphabetically, this result is a shared project. show special set of details. */

  if (($row['owner_id'] == $user_id) && ($row['shared_with'] != $user_id)) { 
  /* 1206230918 | begin: owner content */ ?>
  <li class="sort-this">

    <div class="review-project my-projects">

      <div class="pro-left">
        <form class="hmp" method="post">
          <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project */ ?>
          <input type="hidden" name="last_project_name" value="<?= $current_project_name; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
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
      <li><?php /* dnhfs = do not hide from search */ ?>
        <form method="post">
          <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project */ ?>
          <input type="hidden" name="last_project_name" value="<?= $current_project_name; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
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

    <?php echo "Owner: You<br/>Sharing with: ";
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

<?php 
  /* 1206230918 | end: owner content */
  } else { 
  /* 1206230922 | begin: shared_with content */ ?>

  <li class="sort-this">
    <div class="review-project my-projects">

      <div class="pro-left">
        <form class="hmp" method="post">
          <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project */ ?>
          <input type="hidden" name="last_project_name" value="<?= $current_project_name; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
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
          <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project */ ?>
          <input type="hidden" name="last_project_name" value="<?= $current_project_name; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
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
        <form method="post"> <?php /* this page is the only one that uses a unique id to leave a project because it is inside a while loop and there could be a lot of them. the other places this is used (share_project.php and _form-processing.php both use an id prefix 'rmfp' instead of a unique number. 'rmfp' = remove me from project.)  */ ?>
          <input type="hidden" id="<?= $i ?>_project_name" name="project_name" value="<?= $row['project_name']; ?>">
          <input type="hidden" id="<?= $i ?>_project_id" name="project_id" value="<?= $row['project_id']; ?>">
          <input type="hidden" id="<?= $i ?>_username" name="username" value="<?= $row['first_name'] . ' ' . $row['last_name']; ?>">
          <input type="hidden" id="<?= $i ?>_leave_project" name="leave_project" value="<?= $user_id; ?>">
          <a class="removeme" data-id="<?= $i ?>"><div class="tooltip"><span class="tooltiptext">Leave Project</span><i class="fas fa-minus-circle fa-fw"></i></div></a>
        </form>
      </li>

    </ul>
    <?php /* below, need to show the current project owner's first & last name - and also shared_with's first and last name. these cannot be done in one function because both require u.fist_name & u.last_name. */ ?>
    <div class="shared-with">
    <?php echo "Project Owner: ";
    $owner = show_owner_info($this_project);
    $row4 = mysqli_fetch_assoc($owner); // this will return 1 name (first + last)
    echo $row4['first_name'] . " " . $row4['last_name']; // project owner's name
    /* mysqli_free_result($owner); */

    $this_project = $row['project_id'];
    $foo = show_shared_with_info($user_id, $this_project);
    $anything_here = mysqli_num_rows($foo);

    if ($anything_here > 0) {
      echo "<br />Shared with: you, ";
      while ($row3 = mysqli_fetch_assoc($foo)) { 
        $names[] = " " . $row3['first_name'] . " " . $row3['last_name'] . ", ";  
      } 
      echo rtrim(implode(array_unique($names)), ', ');
      unset($names);
      } else { echo "<br />Shared only with you."; } ?>
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

    <div class="my-perms">
      <p>My permissions: <?php
        if ($row['share'] == 0 && $row['edit'] == 0) { echo 'View only'; }
        if ($row['edit'] == 1) { echo 'Can edit'; }
        if ($row['share'] == 1 && $row['edit'] == 1) { echo ' + '; }
        if ($row['share'] == 1) { echo 'Can share'; }

      ?></p> 
    </div>

    </div><!-- .project-details -->
  </li>
<?php mysqli_free_result($owner); ?>
<?php   } ?>
<?php 
  /* 1206230922 | end: shared_with content */
  } else { 
  /* 1206230905 | still inside the while loop, still going alphabetically, but this project is not_shared. show special set of details. */ ?>         
  <li class="sort-this">
    <div class="review-project my-projects">

      <div class="pro-left">
        <form class="hmp" method="post">
          <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project */ ?>
          <input type="hidden" name="last_project_name" value="<?= $current_project_name; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
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
          <input type="hidden" name="go_to_homepage" value="foo"><?php /* key */ ?>
          <input type="hidden" name="user_id" value="<?= $user_id; ?>">
          <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project */ ?>
          <input type="hidden" name="last_project_name" value="<?= $current_project_name; ?>">
          <input type="hidden" name="current_project" value="<?= $row['id']; ?>">
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

    <?php echo "Owner: You<br/>Not shared";?>

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
<?php   } /* 1206230905 | end: not-shared content */
      } /* 1206230902 | end: user is either owner or shared_with */
    $i++;
    } /* 1206230900 | end while loop (while this user has projects, list them) */
    mysqli_free_result($any_projects_for_user); /* free results from while loop */
/* 1206230855 | end: this user is EITHER owner OR shared_with */  
} else { 
/* this user has no projects to show */
  header('location:' . WWW_ROOT );
  exit;
} ?>
  </ul><!-- .manage-my-projects -->
  </div><!-- #project-wrap -->
</div><!-- #table-page -->
<!-- Modal -->
<div id="theModal" class="esu modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <?php /* '#esu-content' = edit shared user content - i'm reusing theModal from share_project.php. cut me some slack for the non-sense-making id's. */ ?>
    <div id="esu-content" class="modal-content">
      <div class="modal-header">
        <a class="static closefp"><i class="fas fa-times-circle"></i></a>
        <h4 id="smht" class="modal-title">Edit Permissions | Remove from Project</h4>
      </div>
      <div class="modal-body">

      <div id="es-message"> 
        <ul id="es-msg-ul"></ul>
      </div>

      <?php /* '#esForm' = edit shared form */ ?>
      <form id="esForm" class="sharemodal sharing" action="post">
        <input type="hidden" id="pro-id" name="project_id">
        <input type="hidden" id="username" name="username">
        <input type="hidden" id="project_name" name="project_name">
        <input type="hidden" id="editpriv" name="editpriv">
        <input type="hidden" id="sharepriv" name="sharepriv">
        <input type="hidden" id="shared_key">

        <div id="priv-box" class="priv-box">

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

        <div id="remove-box"></div>

        <div id="esbuttons">
          <!-- 
            scripts.js is filling this with $('#esbuttons').html(esbuttons); 
            esbuttons is set directly under orverriding document.ready() container
          -->
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