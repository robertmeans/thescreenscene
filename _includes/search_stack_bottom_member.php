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
$notes_for_project = find_project_notes($user_id, $current_project);
$notes = mysqli_num_rows($notes_for_project);
global $db;
$result = mysqli_query($db, "SELECT MAX(sort) FROM notes WHERE user_id='$user_id' AND project_id='$current_project'");
$max_sort = mysqli_fetch_array($result);
$max_sort = $max_sort[0] + 1;

?>

  <input type="hidden" name="maxsort" data-role="maxsort" value="<?= $max_sort; ?>">
  <input type="hidden" id="cpid" value="<?= $current_project ?>">
  <!-- this is something -->
  <li class="note-edit-pg"><a id="add-note" data-role="notes" class="add-a-note static">Add a note</a></li>

</ul>
<?php } ?>

<div id="usersnotes">
<ul id="<?php if ($notes > 1) { echo 'sortanote'; } ?>" class="project-notes">

<?php 
$modify_id = 0;
$str_length = 2;

if ($notes > 0) {
/* they have notes so you can run a query to get largest number in sort column */

while ($row = mysqli_fetch_assoc($notes_for_project)) {
$modify_id++;
$modify_id = substr("0{$modify_id}", -$str_length);

if (($row['user_id'] == $_SESSION['id']) && ($row['project_id'] == $current_project)) { ?>

<li id="z_<?= $row['note_id']; ?>" sort="<?= $row['sort'] ?>"> 
    <div class="sec note-url<?php if ($notes > 1) { echo " move"; } if (strlen($row['note']) >= 200 && $row['truncate'] == '0') { echo " long"; } else { echo " short"; } ?>">

      <?php if ($notes > 1) { ?>
        <div class="reorder">
          <i class="fas fa-arrows-alt"></i>
        </div>
      <?php } ?>

        <div class="notename">
        <div style="display:none;" id="namet_<?= $row['note_id']; ?>" data-target="namet"><?= $row['name']; ?></div>
        <?php
        /* keep name to total of 21 chars including ellipses */
        $name = (strlen($row['name']) > 21) ? substr($row['name'],0,18).'...' : $row['name'];
        if ($row['url'] != "") { ?>
            <a href="<?= $row['url']; ?>" data-target="urln" class="note-link" target="_blank"><?= $name; ?></a>
        <?php } else { ?>
            <span data-target="urln" class="urlns"><?= $name; ?></span>
        <?php } ?>   
        </div>

    </div>
    <?php /* First pass - when page first loads - before any additions, modifications, sort, etc. */ ?>
    <?php /* For code that renders after modifications have been made to this section see in the  */ ?>
    <?php /* root dir: usernotes.php                                                              */ ?>
    <div class="sec note">

      <span><?php /* this begins the container so you can use justify-content: space-between and keep the '[more]' on the far right end */ ?>
      <div style="display:none;" id="cb_<?= $row['note_id']; ?>" data-target="cb"><?= $row['note']; ?></div>
      <?php
      if ($row['truncate'] == "1") { ?>
        <div style="display:none;"><a data-id="trunc_<?= $row['note_id']; ?>">truncate dis note</a></div>
      <?php } ?>

        <?php
        if ($row['clipboard'] == "1") { /* has clipboard */ ?>
          
          <a data-role="cb" data-id="<?= $row['note_id']; ?>" class="clipboard btn static<?php  
          if (strlen($row['note']) >= 200 && $row['truncate'] == '0') { 
            echo " long"; 
          } else { 
            echo " short"; 
          } 

          ?>"><i class="far fa-copy fa-fw"></i></a>
       <?php } 
        if ($row['note'] != "" && $row['clipboard'] == "1") { ?>
            <span class="cb-txt" id="cb_<?= $row['note_id']; ?>"><?php
            if ($row['truncate'] == '1' && strlen($row['note']) >= 35) {
              $note = (strlen($row['note']) > 34) ? substr($row['note'],0,32).'...' : $row['note'];
              echo $note . '</span></span><span class="more">[ more ]</span>';
              // echo substr(nl2br($row['note']), 0, 35) . '<span class="more">[ more... ]</span>'; 
            } else {
              if ($row['note'] == '') { echo '<span>&nbsp;</span>'; } else {
              echo '</span>' . nl2br($row['note']) . '</span>'; }
            } 
           ?>
        <?php } else { /* no clipboard */ ?>

            <span class="norm-copy"><?php
            if ($row['truncate'] == '1' && strlen($row['note']) >= 35) {
              $note = (strlen($row['note']) > 34) ? substr($row['note'],0,32).'...' : $row['note'];
              echo $note . '</span></span><span class="more">[ more ]</span>';
              // echo substr(nl2br($row['note']), 0, 35) . '<span class="more">[ more... ]</span>'; 
            } else {
              if ($row['note'] == '') { echo '<span>&nbsp;</span>'; } else {
              echo '</span>' . nl2br($row['note']) . '</span>'; }
            } 

           ?>
        <?php }
         ?>
    </div> 

    <div class="sec manage-note<?php  if (strlen($row['note']) >= 200 && $row['truncate'] == '0') { echo " long"; } else { echo " short"; } ?>">
      <a data-role="modify-note" data-id="z_<?= $row['note_id']; ?>" class="modify-note static"><i class="far fa-edit"></i></a>

      <form>
        <input type="hidden" name="maxsortz" data-role="maxsortz" value="<?= $max_sort; ?>">
        <input type="hidden" data-role="deletethis" value="<?= $row['note_id']; ?>">
        <input type="hidden" date-role="noteid" value="<?= $row['note_id']; ?>">
        <input type="hidden" data-role="notename" value="<?= $row['name']; ?>">
        <a data-role="deletenote" class="deletenote"><i class="fas fa-minus-circle"></i></a>
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
    <h2 id="header-msg">* Notes are not shared within project.</h2>
  </div>
  <div class="aan-modal-wrap">
    <div id="thatll-do" class="aan-modal-body">
    <form class="edit-link-form">
      <input type="hidden" name="cp" id="aancp" value="<?= $current_project; ?>">
      <input type="hidden" name="nid" id="nid">
      <label>Name | > 18 chars will be trimmed
      <input name="name" id="aanName" class="edit-input link-name" type="text" maxlength="200"></label>

      <label>URL | Makes the name a hyperlink
      <input name="url" id="aanUrl" class="edit-input link-name" type="text" maxlength="2000" placeholder="http://"></label>

      <label>Note | Limit 10,000 characters
      <textarea name="note" id="aanNote" class="edit-input link-url" maxlength="10000" type="text"></textarea></label>

      <label class="clipboard"><input type="checkbox" name="clipboard" id="aanClipboard"> Add &quot;Copy to clipboard&quot; icon (Grabs note to clipboard)</label>

      <label class="clipboard"><input type="checkbox" name="truncate" id="aanTruncate"> Truncate long note (only show first 32 characters)</label>

      <div class="submit-links">
        <a data-role="notesClose" class="cancel">Cancel</a>
        <a id="update-note" class="submit">Add note</a>
        <a id="modify-note" class="submit">Modify note</a>
      </div>

    </form>
    </div><!-- .aan-modal-body -->
  </div><!-- .aan-modal-wrap -->
  <div class="aan-modal-footer">
    <h3 id="im-watchin">Only you will see your notes.</h3>
  </div>
</div><!-- .aan-modal-content -->
</div><?php // #aan-modal ?>

<?php // limit reached modal // ?>
<div id="thats-all" class="aan-modal">
<div class="aan-modal-content">
  <div class="aan-modal-header">
    <span class="aan-close shutit" data-role="notesClose"><i class="fas fa-times-circle"></i></span>
    <h2>Limit Reached</h2>
  </div>
  <div class="aan-modal-wrap">
    <div class="aan-modal-body">
      <p>There's a 10 note limit per project (for now).</p>
    </div><!-- .aan-modal-body -->
  </div><!-- .aan-modal-wrap -->
  <div class="aan-modal-footer">
    <h3>That'll do, note piggy.</h3>
  </div>
</div><!-- .aan-modal-content -->
</div><?php // #aan-modal ?>