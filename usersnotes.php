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
    positions.push([$(this).attr('id'), $(this).attr('sort')]);
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
        <input type="hidden" name="notecountz" data-role="notecountz" value="<?= $notes; ?>">
        <input type="hidden" data-role="deletethis" value="<?= $row['note_id']; ?>">
        <input type="hidden" name="maxsortz" data-role="maxsortz" value="<?= $max_sort; ?>">
        <input type="hidden" data-role="notename" value="<?= $row['name']; ?>">
        <a href="#" data-role="deletenote" class="deletenote"><i class="fas fa-minus-circle"></i></a>
      </form>
    </div> 

</li>

<?php
} } }
?>

</ul><?php // #project-notes ?>