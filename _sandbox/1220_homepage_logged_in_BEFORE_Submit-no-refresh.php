<?php $layout_context = "home-private"; 

require_once 'config/initialize.php';

// off for local testing

if (!isset($_SESSION['id'])) {
	header('location: home.php');
	exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
	header('location: home.php');
	exit();
}

$id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];

?>

<?php require '_includes/head.php'; ?>
<body>
<?php
$any_links_for_user = find_user_hyperlinks($id, $current_project);
$result       = ($any_links_for_user);
$row        = mysqli_fetch_assoc($any_links_for_user);
$r = explode(",",$row['row_order']);
?>
<?php require '_includes/nav.php'; ?>


<!-- sortable ul from: https://jqueryui.com/sortable --> 
<div id="table-page">

 	<div id="table-wrap">


<div id="google" class="searches top">
  <form name="google" method="get" onSubmit="submitGoogle();" target="_blank">

  <p>Google</p>
    <input type="text" id="gsearch" name="q" value=""> <a onclick="reset_gsearch();"><i class="fas fa-backspace"></i></a>
     
    <label><input type="radio" name="googleRadio" id="googleImages"> Images</label>
    <label><input type="radio" name="googleRadio" id="googleMaps"> Maps</label>

    <span><input type="submit" value="Go"></span>

  </form>
</div><!-- end Google -->



<div id="url" class="searches mid">
<form name="urlField" onSubmit="return submitURLFieldForm();">
  
    <p>URL</p>
    <input type="text" id="addressfield" name="address" placeholder="http://"> <a onclick="reset_url();"><i class="fas fa-backspace"></i></a>

</form>
</div><!-- end URL -->



<div id="bing" class="searches mid">
<form name="bing" method="get" onSubmit="return submitBing();" target="_blank">

  <p>Bing</p>
    <input type="text" id="bsearch" name="q" value=""> <a onclick="reset_bing();"><i class="fas fa-backspace"></i></a>
    
    <label><input type="radio" name="bingRadio" id="bingImages"> Images</label>
    <label><input type="radio" name="bingRadio" id="bingMaps"> Maps</label>

    <span><input type="submit" value="Go"></span>

</form>
</div><!-- end Bing -->


<div id="dictionary" class="searches mid">
<form name="reference" method="get" onSubmit="OnSubmitForm();" target="_blank">
  <p>Thesaurus</p>
    <input type="hidden" name="thesaurus" value="1" checked="checked" />
    <input type="text" name="q" id="q"> <i class="fas fa-backspace"></i></a>
    
    <input type="radio" name="dictionary" id="dictionary" onMouseDown="this.__chk = this.checked" onClick="if (this.__chk) this.checked = false" /><label for="dictionary" onMouseDown="document.getElementById('dictionary').__chk = document.getElementById('dictionary').checked" onClick="if (document.getElementById('dictionary').__chk) document.getElementById('dictionary').checked = false">Dictionary</label>

    <span><input type="submit" name="submit" value="Go"></span>
</form>
</div>



<?php 
if ($_SESSION['current_project'] == "0") {
?>
<div class="tabs new-intro">
  <p>Welcome <?= $_SESSION['username']; ?>, You don't have any projects.</p>
    <form id="first-project" action="first_project_create.php" method="post">
      <p>Name your first project | Limit 30 characters</p>
      <input type="text" class="first-project-name" name="project_name" maxlength="30">
      <input type="submit" class="first-submit" name="first_project" value="Go!">

    </form>
</div><!-- .tabs .new-intro -->
<?php
} else { // begin projects page
?>

	<?php 
    // opened below body tag to let navigation use WWW_ROOT from edit pages back to home
		if ($result != null) {
		 ?>

<div class="tabs">

      <ul class="tab-links">

          <form id="page_number1" action="project_view.php" method="post">
          <input type="hidden" name="page_number" value="1">
          <li <?php if ($row['page_number'] == "1") { echo "class=\"active\""; }  ?> ><input type="submit" name="tab1" value="Page 1"></li>
          </form>

          <form id="page_number2" action="project_view.php" method="post">
          <input type="hidden" name="page_number" value="2">
          <li <?php if ($row['page_number'] == "2") { echo "class=\"active\""; }  ?> ><input type="submit" name="tab2" value="Page 2"></li>
          </form>

          <form id="page_number3" action="project_view.php" method="post">
          <input type="hidden" name="page_number" value="3">
          <li <?php if ($row['page_number'] == "3") { echo "class=\"active\""; }  ?> ><input type="submit" name="tab3" value="Page 3"></li>
          </form>

          <li><a href="edit_content.php?id=<?= h(u($row['id'])) ?>" class="static"><i class="far fa-edit"></i></a></li>

          <li><a href="edit_searches.php" class="static"><i class="fas fa-sort"></i></a></li>

          <li><a href="edit_order.php?id=<?= h(u($row['id'])) ?>" class="static"><i class="fas fa-arrows-alt"></i></a></li>

          <li><a href="my_projects.php" class="static"><i class="fas fa-list-ol"></i></a></li>

          <li class="project-name"><?php echo "<p>| Project: " . $row['project_name'] . "</p>"; ?></li>
      </ul>

<ul id="static-sort">

<div class="tab-content">

<!-- page 1 -->
<div id="tab1" class="tab <?php if ($row['page_number'] == "1") { echo "active"; }  ?>">
<?php
if ($row['page_number'] == "1") {
for ($row_count = 0; $row_count < 24; $row_count++){

$id_count = 1 + $row_count;
$str_length = 2;
$id_count = substr("0{$id_count}", -$str_length);
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo "<a href=\"" . h($row[$r[$row_count] . '_url']) . "\" class=\"project-links\" target=\"_blank\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 
      } else { 
            echo "<a href=\"#\" class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } } // end for loop page 1 ?>

</div><!-- #tab1 -->


<!-- page 2 -->
<div id="tab2" class="tab <?php if ($row['page_number'] == "2") { echo "active"; }  ?>">
<?php
if ($row['page_number'] == "2") {
for ($row_count = 24; $row_count < 48; $row_count++){

$id_count = 1 + $row_count;
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo "<a href=\"" . h($row[$r[$row_count] . '_url']) . "\" class=\"project-links\" target=\"_blank\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 
      } else { 
            echo "<a href=\"#\" class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } } // end for loop page 2 ?>

</div><!-- #tab2 -->

<!-- page 3 -->
<div id="tab3" class="tab <?php if ($row['page_number'] == "3") { echo "active"; }  ?>">
<?php
if ($row['page_number'] == "3") {
for ($row_count = 48; $row_count < 72; $row_count++){

$id_count = 1 + $row_count;
?>

<li id="<?= $id_count ?>" class="ui-state-default">           
<?php 
      if (h($row[$r[$row_count] . '_text']) != "") { 
            echo "<a href=\"" . h($row[$r[$row_count] . '_url']) . "\" class=\"project-links\" target=\"_blank\">" . h($row[$r[$row_count] . '_text']) . "</a>"; 
      } else { 
            echo "<a href=\"#\" class=\"project-links-empty shim\" target=\"_blank\"></a>";
} ?></li><?php } } // end for loop page 2 ?>

</div><!-- #tab3 -->
</div><!-- .tab-content -->

    </ul>

</div><!-- #tabs -->
<?php 
      } else {
            echo "You've got problems.";
		}
			
	?>


<?php } // end projects page ?>


<div id="youtube" class="searches bottom">
<form name="youtube" action="https://www.youtube.com/results" method="get" target="_blank">

  <p>YouTube</p>
    <input id="ytsearch" name="search_query" type="text"> <a onclick="reset_yt();"><i class="fas fa-backspace"></i></a>

    <span><input type="submit" value="Go"></span>
</form> 
</div><!-- end YouTube -->



  </div><!-- #table-wrap -->
</div><!-- #table-page -->



<?php require '_includes/footer.php'; ?>