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
// $user_id = $_SESSION['id'];
$notes_for_project = find_project_notes($user_id, $current_project);
$notes = mysqli_num_rows($notes_for_project);
global $db;
$result = mysqli_query($db, "SELECT MAX(sort) FROM notes WHERE user_id='$user_id' AND project_id='$current_project'");
$max_sort = mysqli_fetch_array($result);
$max_sort = $max_sort[0] + 1;

?>

  <input type="hidden" name="maxsort" data-role="maxsort" value="<?= $max_sort; ?>">
  <input type="hidden" name="notecount" data-role="notecount" value="<?= $notes; ?>">
  <li class="note-edit-pg"><a href="#" id="add-note" data-role="notes" class="add-a-note static">Add a note</a></li>

</ul>
<?php } ?>


<div id="usersnotes">
<ul <?php if ($notes > 1) { echo "id=\"sortanote\""; } ?> class="project-notes">

<?php 
$modify_id = 0;
$str_length = 2;

if ($notes > 0) {
// they have notes so you can run a query to get largest number in sort column
global $db;
// $result = mysqli_query($db, "SELECT MAX(sort) FROM notes WHERE user_id='$user_id' AND project_id='$current_project'");
// $max_sort = mysqli_fetch_array($result);

while ($row = mysqli_fetch_assoc($notes_for_project)) {
$modify_id++;
$modify_id = substr("0{$modify_id}", -$str_length);

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
            <a href="<?= $row['url']; ?>" data-target="urln" class="note-link" target="_blank"><?= $row['name']; ?></a>
        <?php } else { ?>
            <span data-target="urln" class="urlns"><?= $row['name']; ?></span>
        <?php } ?>   
        </div>

    </div>  
    <div class="sec note">
        <?php
        if ($row['clipboard'] == "1") { ?>
          <a href="#" data-role="cb" data-id="<?= $row['note_id']; ?>" class="clipboard btn static"><i class="far fa-copy fa-fw"></i></a>
       <?php }
        if ($row['note'] != "" && $row['clipboard'] == "1") { ?>
            <p class="cb-txt" id="cb_<?= $row['note_id']; ?>" data-target="cb" ><?= $row['note']; ?></p>
        <?php } else { ?>
            <span class="norm-copy" data-target="cb"><?= $row['note']; ?></span>
        <?php }
         ?>
    </div> 
    <div class="sec manage-note">
      <a href="#" data-role="modify-note" data-id="z_<?= $row['note_id']; ?>" class="modify-note static"><i class="far fa-edit"></i></a>

      <form>
        <input type="hidden" name="maxsortz" data-role="maxsortz" value="<?= $max_sort; ?>">
        <input type="hidden" data-role="deletethis" value="<?= $row['note_id']; ?>">
        <input type="hidden" data-role="notename" value="<?= $row['name']; ?>">
        <a href="#" data-role="deletenote" class="deletenote"><i class="fas fa-minus-circle"></i></a>
      </form>
    </div> 

</li>

<?php
} } }
?>

</ul><?php // #project-notes ?>
</div><?php // #usersnotes  ?>


<?php // this is THE ADD/CREATE A NOTE MODAL for under 20 notes // ?>
<div id="aan-modal" class="aan-modal">

<!-- Modal content -->
<div class="aan-modal-content">
  <div class="aan-modal-header">
    <span class="aan-close" data-role="notesClose"><i class="fas fa-times-circle"></i></span>
    <h2 id="header-msg">Notes</h2>
  </div>

  <div class="aan-modal-wrap">
      <div id="thatll-do" class="aan-modal-body">

      <form class="edit-link-form">
        <input type="hidden" name="cp" id="cp" value="<?= $current_project; ?>">
        <input type="hidden" name="uid" id="uid" value="<?= $user_id; ?>">
        <input type="hidden" name="nid" id="nid">
        <label>Name | Limit 30 characters
        <input name="name" id="aanName" class="edit-input link-name" type="text" maxlength="30"></label>

        <label>URL | Makes the name a hyperlink
        <input name="url" id="aanUrl" class="edit-input link-name" type="text" maxlength="2000" placeholder="http://"></label>

        <label>Note | Limit 200 characters
        <textarea name="note" id="aanNote" class="edit-input link-url" maxlength="200" type="text"></textarea></label>

        <label class="clipboard"><input type="checkbox" name="clipboard" id="aanClipboard"> Add &quot;Copy to clipboard&quot; icon (Grabs note to clipboard)</label>
        <div class="submit-links">
          <a href="#" class="cancel-close static" data-role="notesClose">Cancel</a>
          <input name="update-note" id="update-note" class="update" value="Add note">
          <input name="modify-note" id="modify-note" class="update" value="Modify note">
        </div><!-- #submit-links -->
      </form>

      </div><!-- .aan-modal-body -->

  </div><!-- .aan-modal-wrap -->
  <div class="aan-modal-footer">
    <h3 id="im-watchin">&nbsp;</h3>
  </div>

</div><!-- .aan-modal-content -->
</div><?php // #aan-modal ?>