<?php
	switch ($inner_nav_context) { /* start current_project_not_found.php navigation */
  case 'cp-not-found' : ?>

  <li>
    <form class="gth" method="post">
      <input type="hidden" name="viewprojectspage" value="yo">
      <a class="vpp-link"><div class="tooltip"><span class="tooltiptext">Projects Page</span><i class="fas fa-list-ol"></i></div></a>
    </form>  
  </li>
<?php  
  break; /* end current_project_not_found.php navigation | begin shared_with navigation */
	case 'shared_with' :

	if ($layout_context != 'homepage') { ?>

	<li>
    <a href="."><div class="tooltip"><span class="tooltiptext"><?php if ($layout_context != 'new_project') { ?>Homepage of this project<?php } else { ?>Homepage of last project<?php } ?></span><i class="fas fa-house-user fa-fw"></i></div></a>
  </li>

<?php } if ($layout_context == 'homepage') { ?>
  <li>
    <form id="et-form" action="" method="post">
      <input type="hidden" name="go_to_last_project" value="foo"><?php /* key */ ?>
      <input type="hidden" name="current_project" value="<?= $last_project; ?>"><?php /* ID of destination project */ ?>
      <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project, abt to be last */ ?>
      <input type="hidden" name="last_project_name" value="<?= $row['project_name']; ?>"><?php /* Current project name, abt to be last */ ?> 
      <input type="hidden" name="user_id" value="<?= $user_id; ?>">

        <?php if ($last_project != '0') { ?>
          <a class="gth-link"><div class="tooltip">
            <span class="tooltiptext">Last Project:<br><?= $last_project_name; ?></span>
            <i class="far fa-caret-square-left fa-fw"></i></div></a>
        <?php } else { ?>
          <a class="nope"><div class="tooltip">
            <span class="tooltiptext">No last project found</span>
            <i class="far fa-caret-square-left fa-fw"></i></div></a>
        <?php } ?>

    </form>
  </li>

<?php } if ($row['edit'] == "1" && $layout_context == 'homepage') { ?>

	<li>
		<form id="et-form" action="" method="post">
			<input type="hidden" id="ownShare" name="ownShare" value="0">
			<input type="hidden" id="curpro" name="current_project" value="<?= $current_project; ?>">
			<input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
			<input type="checkbox" id="et1" name="edit_toggle" value="1" <?php if ($row['edit_toggle'] == "1") { echo "checked"; }  ?>>
			<a id="edit-content" class="static <?php if ($row['edit_toggle'] == "1") { echo "active"; }  ?>"><div class="tooltip"><span class="tooltiptext">Edit bookmarks</span><i class="far fa-edit fa-fw"></i></div></a>
		</form>
	</li>

<?php } if ($layout_context != 'edit_searches' && $layout_context != 'new_project') { ?>

  <li>
    <form class="gth" method="post">
      <input type="hidden" name="organizesearchfields" value="1">
      <input type="hidden" name="current_project" value="<?= $current_project; ?>">
      <input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
      <a class="osf-link"><div class="tooltip"><span class="tooltiptext">Organize search fields</span><i class="fas fa-sort fa-fw"></i></div></a>
    </form>
  </li>

<?php } if ($row['share'] == "1" && $layout_context != 'share_project' && $layout_context != 'new_project') { ?>

	<li>
    <form method="post">
      <input type="hidden" name="shareproject" value="yo">
      <input type="hidden" name="current_project" value="<?= $current_project; ?>">
      <input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
      <a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
    </form>
  </li>

<?php } if ($layout_context != 'new_project') { ?>

  <li>
    <form class="gth" method="post">
      <input type="hidden" name="startanewproject" value="yo">
      <input type="hidden" name="inner_nav" value="yo">
      <a class="np-link my-nav"><div class="tooltip"><span class="tooltiptext">Start a new project</span><i class="far fa-plus-square fa-fw"></i></div></a>
    </form>  
  </li>

<?php } ?>

  <li>
    <form class="gth" method="post">
      <input type="hidden" name="viewprojectspage" value="yo">
      <a class="vpp-link"><div class="tooltip"><span class="tooltiptext">Projects Page</span><i class="fas fa-list-ol fa-fw"></i></div></a>
    </form>  
  </li>

  <?php if ($layout_context == 'homepage') { ?>

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

<?php } if ($layout_context == 'homepage') { ?> 
  
	<li class="project-name">| <a name="tab4" class="project-link tabs tab-links show-notes"><div class="tooltip"><span class="tooltiptext">Project notes</span><input type="submit" id="yotab4" name="tab4" value="<?= $row['project_name']; ?>"></div></a></li>

<?php } else if ($layout_context != 'new_project') { ?>

  <li class="project-name" style="cursor:default;">| <span style="margin-left:0.5em;cursor:default;"><?= $row['project_name']; ?></span></li>  

  <?php } 
	break; /* end shared_with navigation | begin owner navigation */
	case 'owner' :	
	if ($layout_context != 'homepage') { /* begin owner navigation */ ?>	

	<li>
    <a href="."><div class="tooltip"><span class="tooltiptext"><?php if ($layout_context != 'new_project') { ?>Homepage of this project<?php } else { ?>Homepage of last project<?php } ?></span><i class="fas fa-house-user fa-fw"></i></div></a>
  </li>

<?php } if ($layout_context == 'homepage') { ?>

  <li>
    <form id="et-form" action="" method="post">

        <?php /*
        ***************************** DON'T CHANGE A MOTHER FRICKIN' THING HERE! *****************************
        */ ?>

      <input type="hidden" name="go_to_last_project" value="foo"><?php /* key */ ?>
      <input type="hidden" name="current_project" value="<?= $last_project; ?>"><?php /* ID of destination project */ ?>
      <input type="hidden" name="last_project" value="<?= $current_project; ?>"><?php /* ID of current project, abt to be last */ ?>
      <input type="hidden" name="last_project_name" value="<?= $row['project_name']; ?>"><?php /* Current project name, abt to be last */ ?> 
      <input type="hidden" name="user_id" value="<?= $user_id; ?>">
      
        <?php /*
        ***************************** DON'T CHANGE A MOTHER FRICKIN' THING HERE! *****************************
        */ ?>

        <?php if ($last_project != '0') { ?>
          <a class="gth-link"><div class="tooltip">
            <span class="tooltiptext">Last Project:<br><?= $last_project_name; ?></span>
            <i class="far fa-caret-square-left fa-fw"></i></div></a>
        <?php } else { ?>
          <a class="nope"><div class="tooltip">
            <span class="tooltiptext">No last project found</span>
            <i class="far fa-caret-square-left fa-fw"></i></div></a>
        <?php } ?>

    </form>
  </li>
	<li>
		<form id="et-form" action="" method="post">
			<input type="hidden" id="ownShare" name="ownShare" value="1">
			<input type="hidden" id="curpro" name="current_project" value="<?= $current_project; ?>">
			<input type="hidden" id="userid" name="user_id" value="<?= $user_id; ?>">
			<input type="checkbox" id="et1" name="edit_toggle" value="1" <?php if ($row['edit_toggle'] == "1") { echo "checked"; }  ?>>
			<a id="edit-content" class="static <?php if ($row['edit_toggle'] == "1") { echo "active"; }  ?>"><div class="tooltip"><span class="tooltiptext">Edit bookmarks</span><i class="far fa-edit fa-fw"></i></div></a>
		</form>
	</li>

<?php } if ($layout_context != 'edit_searches' && $layout_context != 'new_project') { ?>
  
	<li>
    <form class="gth" method="post">
      <input type="hidden" name="organizesearchfields" value="1">
      <a class="osf-link"><div class="tooltip"><span class="tooltiptext">Organize search fields</span><i class="fas fa-sort fa-fw"></i></div></a>
    </form>
  </li>

<?php } if ($layout_context != 'edit_order' && $layout_context != 'new_project') { ?>

	<li>
    <form class="gth" method="post">
      <input type="hidden" name="rearrangebookmarks" value="1">
      <a class="eo-link"><div class="tooltip"><span class="tooltiptext">Rearrange bookmarks</span><i class="fas fa-arrows-alt fa-fw"></i></div></a>
    </form>
  </li>

<?php } if ($layout_context != 'share_project' && $layout_context != 'new_project') { ?>

  <li>
    <form method="post">
      <input type="hidden" name="shareproject" value="yo">
      <a class="sp-link"><div class="tooltip"><span class="tooltiptext">Share project</span><i class="fas fa-user-friends fa-fw"></i></div></a>
    </form>
  </li>

<?php } if ($layout_context != 'new_project') { ?>

  <li>
    <form class="gth" method="post">
      <input type="hidden" name="startanewproject" value="yo">
      <input type="hidden" name="inner_nav" value="yo">
      <a class="np-link my-nav"><div class="tooltip"><span class="tooltiptext">Start a new project</span><i class="far fa-plus-square fa-fw"></i></div></a>
    </form>    
  </li>

<?php } ?>

  <li>
    <form class="gth" method="post">
      <input type="hidden" name="viewprojectspage" value="yo">
      <a class="vpp-link"><div class="tooltip"><span class="tooltiptext">Projects Page</span><i class="fas fa-list-ol fa-fw"></i></div></a>
    </form>  
  </li>

<!-- 
  <li>
    <form class="gth" method="post">
      <input type="hidden" name="quicksearch" value="yo">
      <a class="quicksearch-link"><div class="tooltip"><span class="tooltiptext">Quick Search</span><i class="fas fa-search fa-fw"></i></div></a>
    </form>  
  </li>

 -->

<?php if ($layout_context == 'homepage') { ?>

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

<?php } if ($layout_context == 'edit_order') { ?>

	<li class="project-name">| <span class="attn">Drag &amp; Drop:</span> <a class="project-link" style="pointer-events:none;cursor:default;"><?= $row['project_name']; ?></a></li> 

<?php } else if ($layout_context == 'delete_project') { ?>

	<li class="project-name">| <span class="attn">DELETE:</span> <a class="project-link" style="pointer-events:none;cursor:default;"><?= $row['project_name']; ?></a></li> 

<?php } else if ($layout_context == 'homepage') { ?>

	<li class="project-name">| <a name="tab4" class="project-link tabs tab-links show-notes"><div class="tooltip"><span class="tooltiptext">Project notes</span><input type="submit" id="yotab4" name="tab4" value="<?= $row['project_name']; ?>"></div></a></li>
	
<?php } else if ($layout_context != 'new_project') { ?>

  <li class="project-name" style="cursor:default;">| <span style="margin-left:0.5em;cursor:default;"><?= $row['project_name']; ?></span></li> 

<?php } 

	break;
	default : break;
}

?>