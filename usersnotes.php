<?php
require_once 'config/initialize.php';

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];

$notes_for_project = find_project_notes($user_id, $current_project);
$notes = mysqli_num_rows($notes_for_project);
// $max_sort = $notes + 1;
?>
<script>
  
$(document).ready(function () {
  $('#sortanote').sortable({
    update: function (event, ui) {
      $(this).children().each(function (index) {
        if ($(this).attr('sort') != (index+1)) {
          $(this).attr('sort', (index+1)).addClass('updated');
        }
      });

      save_new_positions();
    }
  });
});
// ajax background save for sorting add a note
function save_new_positions() {
  var positions = [];
  $('.updated').each(function () {
    var thisida = $(this).attr('id');
    var thisid = thisida.substring(2);
    positions.push([thisid, $(this).attr('sort')]);
    $(this).removeClass('updated');
  });

  $.ajax({
    url: 'sort_note.php',
    method: 'POST',
    dataType: 'text',
    data: {
      update: 1,
      positions: positions
    }, success: function (response) {
      console.log(response);
    }
  });
}

</script>

<ul <?php if ($notes > 1) { echo "id=\"sortanote\""; } ?> class="project-notes">

<?php 
$modify_id = 0;
$str_length = 2;

if ($notes > 0) {
// they have notes so you can run a query to get largest number in sort column
global $db;
$result = mysqli_query($db, "SELECT MAX(sort) FROM notes WHERE user_id='$user_id' AND project_id='$current_project'");
$max_sort = mysqli_fetch_array($result);
$max_sort = $max_sort[0] + 1;

while ($row = mysqli_fetch_assoc($notes_for_project)) {
$modify_id++;
$modify_id = substr("0{$modify_id}", -$str_length);

if (($row['user_id'] == $_SESSION['id']) && ($row['project_id'] == $current_project)) { ?>

<li id="z_<?= $row['note_id']; ?>" sort="<?= $row['sort'] ?>">
    <div class="sec note-url <?php if ($notes > 1) { echo "move"; } if (strlen($row['note']) >= 200 && $row['truncate'] == '0') { echo " long"; } else { echo " short"; } ?>">

      <?php if ($notes > 1) { ?>
        <div class="reorder">
          <i class="fas fa-arrows-alt"></i>
        </div>
      <?php } ?>

        <div class="notename">
        <div style="display:none;" id="namet_<?= $row['note_id']; ?>" data-target="namet"><?= $row['name']; ?></div>
        <?php
        $name = (strlen($row['name']) > 21) ? substr($row['name'],0,18).'...' : $row['name'];
        if ($row['url'] != "") { ?>
            <a href="<?= $row['url']; ?>" data-target="urln" class="note-link" target="_blank"><?= $name; ?></a>
        <?php } else { ?>
            <span data-target="urln" class="urlns"><?= $name; ?></span>
        <?php } ?>   
        </div>

    </div>  
    <div class="sec note">
      <span><?php /* this begins the container so you can use justify-content: space-between and keep the '[more]' on the far right end */ ?>
      <div style="display:none;" id="cb_<?= $row['note_id']; ?>" data-target="cb"><?= $row['note']; ?></div>
      <?php
      if ($row['truncate'] == "1") { ?>
        <div style="display:none;"><a data-id="trunc_<?= $row['note_id']; ?>">truncate dis note</a></div>
      <?php } ?>
        <?php /* After any modifications to notes have been made - this is what will render the notes */ ?>
        <?php /* section. For first pass see: _includes/search_stack_bottom_member.php */ ?>
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
            if ($row['truncate'] == '1' && strlen($row['note']) >= 36) {
              $note = (strlen($row['note']) > 35) ? substr($row['note'],0,33).'...' : $row['note'];
              echo $note . '</span></span><span class="more">[ more ]</span>';
              // echo substr(nl2br($row['note']), 0, 35) . '<span class="more">[ more... ]</span>'; 
            } else {
              echo '</span>' . nl2br($row['note']) . '</span>';
            }
           ?>
        <?php } else { ?>
            <span class="norm-copy"><?php
            if ($row['truncate'] == '1' && strlen($row['note']) >= 36) {
              $note = (strlen($row['note']) > 35) ? substr($row['note'],0,33).'...' : $row['note'];
              echo $note . '</span></span><span class="more">[ more ]</span>';
            } else {
              echo '</span>' . nl2br($row['note']) . '</span>';
            } 
           ?>
        <?php }
         ?>
    </div> 
    <div class="sec manage-note<?php  if (strlen($row['note']) >= 200 && $row['truncate'] == '0') { echo " long"; } else { echo " short"; } ?>">
      <a data-role="modify-note" data-id="z_<?= $row['note_id']; ?>" class="modify-note static"><i class="far fa-edit"></i></a>

      <form>
        <input type="hidden" name="notecountz" data-role="notecountz" value="<?= $notes; ?>">
        <input type="hidden" data-role="deletethis" value="<?= $row['note_id']; ?>">
        <input type="hidden" name="maxsortz" data-role="maxsortz" value="<?= $max_sort; ?>">
        <input type="hidden" data-role="notename" value="<?= $row['name']; ?>">
        <a data-role="deletenote" class="deletenote"><i class="fas fa-minus-circle"></i></a>
      </form>
    </div> 

</li>

<?php
} } }
?>

</ul><?php // #project-notes ?>