<?php if ($s[0] == null || $s[1] == null || $s[2] == null || $s[3] == null || $s[4] == null) {
    require '_includes/search_stack_bottom_static.php';
} else { ?>
<ul id="bottom-search" class="logged">
      <li id="<?= $s[4] ?>" class="ct <?php if ($s[4] == "1") {echo "google";} if ($s[4] == "2") {echo "url";} if ($s[4] == "3") {echo "bing";} if ($s[4] == "4") {echo "reference";} if ($s[4] == "5") {echo "youtube";} ?>"><?php 
        if ($s[4] == "1") {require '_includes/search_google.php';}
        if ($s[4] == "2") {require '_includes/search_url.php';}
        if ($s[4] == "3") {require '_includes/search_bing.php';}
        if ($s[4] == "4") {
        	if ($row['reference'] == "1") {
        	require '_includes/search_dictionary.php';
        	} else { require '_includes/search_thesaurus.php'; }
    	}
        if ($s[4] == "5") {require '_includes/search_youtube.php';} 

        ?></li>

<?php
$user_id = $_SESSION['id'];
$notes_for_project = find_project_notes($user_id, $current_project);
$notes = mysqli_num_rows($notes_for_project);

?>

<?php if ($notes <= 9) { ?>
        <li class="note-edit-pg"><a href="#" id="add-note" class="add-a-note static">Add a note</a></li>
<?php } else { ?>
        <li class="note-edit-pg"><a href="#" id="note-limit" class="add-a-note static">Add a note</a></li>
<?php } ?>

</ul>
<?php } ?>

<ul <?php if ($notes > 1) { echo "id=\"sortanote\""; } ?> class="project-notes">

<?php 
$modify_id = 0;
$str_length = 2;
$note_count = 0;

// find out if user has any projects they manage
if ($notes > 0) {
// they have notes so you can run a query to get largest number in sort column
global $db;
$result = mysqli_query($db, "SELECT MAX(sort) FROM notes WHERE user_id='$user_id' AND project_id='$current_project'");
$max_sort = mysqli_fetch_array($result);

while ($row = mysqli_fetch_assoc($notes_for_project)) {
$modify_id++;
$modify_id = substr("0{$modify_id}", -$str_length);
$note_count++;

if (($row['user_id'] == $_SESSION['id']) && ($row['project_id'] == $current_project)) { ?>

<li id="<?= $row['note_id']; ?>" sort="<?= $row['sort'] ?>"> 
    <div class="sec note-url <?php if ($notes > 1) { echo "move"; } ?>">

      <?php if ($notes > 1) { ?>
        <div class="reorder">
          <i class="fas fa-arrows-alt"></i>
        </div>
      <?php } ?>

        <div class="notename">
        <?php
        if ($row['url'] != "") { ?>
            <a href="<?= $row['url']; ?>" class="note-link" target="_blank"><?= $row['name']; ?></a>
        <?php } else { 
            echo $row['name'];
         } ?>   
        </div>

    </div>  
    <div class="sec note">
        <?php
        if ($row['clipboard'] == "1") {
          echo "<a href=\"#\" class=\"clipboard btn static\"><i class=\"far fa-copy fa-fw\"></i></a>";
        }
        if ($row['note'] != "" && $row['clipboard'] == "1") { 
            echo "<span class=\"input-copy\">" . $row['note'] . "</span>";
         } else {
            echo "<span class=\"norm-copy\">" . $row['note'] . "</span>";
         }
         ?>
    </div> 
    <div class="sec manage-note">
      <a href="#" id="<?= $modify_id; ?>_modify-note" class="modify-note static"><i class="far fa-edit"></i></a>

      <form action="delete_note.php?note=<?= $row['note_id']; ?>" method="post" onsubmit="return confirm('Confirm: Delete note')">
          <div><a href="#" class="deletenote static" onclick="$(this).closest('form').submit()"><i class="fas fa-minus-circle"></i></a></div>
      </form>
    </div> 

</li>

<?php
} } }
?>

</ul><?php // #project-notes ?>
<?php // this is THE ADD/CREATE A NOTE MODAL for under 20 notes // ?>
<div id="aan-modal" class="aan-modal">

<!-- Modal content -->
<div class="aan-modal-content">
  <div class="aan-modal-header">
    <span class="aan-close"><i class="fas fa-times-circle"></i></span>
    <h2>Add a note</h2>
  </div>

  <div class="aan-modal-wrap">
      <div class="aan-modal-body">

      <form action="add_note.php?id=<?= $current_project ?>" method="post" class="edit-link-form">
        <input type="hidden" name="sort" value="<?php if ($notes == 0) { echo "1"; } else { echo $max_sort[0] + 1; } ?>">
        <label>Name | Limit 30 characters
        <input name="name" class="edit-input link-name" type="text" maxlength="30"></label>

        <label>URL | Makes the name a hyperlink
        <input name="url" class="edit-input link-name" type="text" maxlength="2000" placeholder="http://"></label>

        <label>Note | Limit 200 characters
        <textarea name="note" class="edit-input link-url" maxlength="200" type="text"></textarea></label>

        <input type="hidden" name="clipboard" value="0">
        <label class="clipboard"><input type="checkbox" name="clipboard" value="1"> Add &quot;Copy to clipboard&quot; icon (Grabs note to clipboard)</label>
        <div class="submit-links">
          <a href="#" class="cancel-close static">Cancel</a>
          <input name="update-link" class="update" type="submit" value="Add note">
        </div><!-- #submit-links -->
      </form>

      </div><!-- .aan-modal-body -->

  </div><!-- .aan-modal-wrap -->
  <div class="aan-modal-footer">
    <!-- <h3>&nbsp;</h3> -->
    <?php 
    if ($notes == 4) { echo "<h3>You have 5 notes remaining.</h3>"; }
    if ($notes == 7) { echo "<h3>This is note #8. There is a 10 note limit.</h3>"; }
    if ($notes == 8) { echo "<h3>This is note #9. You're a note maniac.</h3>"; } 
    if ($notes == 9) { echo "<h3>Don't say I didn't warn you.</h3>"; } // this is last note -> #20
    ?>
  </div>

</div><!-- .aan-modal-content -->
</div><?php // #aan-modal ?>
<?php // limit reached modal // ?>
<div id="thats-all" class="aan-modal">

<div class="aan-modal-content">
  <div class="aan-modal-header">
    <span class="aan-close shutit"><i class="fas fa-times-circle"></i></span>
    <h2>Limit Reached</h2>
  </div>

  <div class="aan-modal-wrap">
      <div class="aan-modal-body">

      <p>There's a 10 note limit per project (for now).</p>

      </div><!-- .aan-modal-body -->

  </div><!-- .aan-modal-wrap -->
  <div class="aan-modal-footer">
    <h3>&nbsp;</h3>
  </div>

</div><!-- .aan-modal-content -->
</div><?php // #aan-modal ?>

<?php // Start a for loop that = $notes and get individual modals ready
      // equal to the number of notes 

?>

<?php
$and_again = find_project_notes($user_id, $current_project);
$modify_id = 0;
$str_length = 2;
$note_count = 0;

if ($notes > 0) {

while ($row = mysqli_fetch_assoc($and_again)) {
$modify_id++;
$modify_id = substr("0{$modify_id}", -$str_length);
$note_count++;
?>


<?php // this is the MODIFY NOTE MODAL // ?>
<div id="<?= $modify_id ?>_modify-modal" class="modify-modal">

<div class="modify-modal-content">
  <div class="modify-modal-header">
    <span class="modify-close closer"><i class="fas fa-times-circle"></i></span>
    <h2>Edit note</h2>
  </div>

  <div class="modify-modal-wrap">
      <div class="modify-modal-body">

      <form action="modify_a_note.php?id=<?= $row['note_id'] ?>" method="post" class="modify-note-form">
        
        <p>Name | Limit 30 characters</p>
        <input name="name" class="modify-input link-name" type="text" maxlength="30" value="<?php if (isset($row['name'])) { echo h($row['name']); } ?>">

        <p>URL</p>
        <input name="url" class="modify-input link-name" type="text" value="<?php if (isset($row['url'])) { echo h($row['url']); } ?>" maxlength="2000" placeholder="http://">

        <p>Note | Limit 200 characters</p>
        <textarea name="note" class="modify-input link-url" type="text" maxlength="200"><?php if (isset($row['note'])) { echo str_replace('\r\n', '', $row['note']); } ?></textarea></label>

        <input type="hidden" name="clipboard" value="0">
        <label class="clipboard"><input type="checkbox" name="clipboard" value="1" <?php if ($row['clipboard'] == 1) { echo 'checked'; } ?>> Add &quot;Copy to clipboard&quot; icon (Grabs note to clipboard)</label>

        <div class="submit-links">
          <a href="#" class="closer static">Cancel</a>
          <input name="modify-note" class="update" type="submit" value="Update">
        </div><!-- #submit-links -->
      </form>

      </div><!-- .modify-modal-body -->

  </div><!-- .modify-modal-wrap -->
  <div class="modify-modal-footer">
    <h3>&nbsp;</h3>
  </div>

</div><!-- .modify-modal-content -->
</div><?php // #modify-modal ?>

<?php } } ?>