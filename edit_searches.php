<?php $layout_context = "edit_searches"; 
/* also - moved $layout_context on 041423 to edit_search_order_shared.php (or _owner.php) bc it wasn't working here all by itself. ?! */
 
require_once 'config/initialize.php'; 

if (!isset($_SESSION['id'])) {
  header('location:' . WWW_ROOT);
  exit();
}
if ((isset($_SESSION['id'])) && (!$_SESSION['verified'])) {
  header('location:' . WWW_ROOT);
  exit();
}

$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];

?>
<?php
require '_includes/head.php';
?>
<body>
<?php preload_config($layout_context); ?>
<?php require '_includes/nav.php'; ?>

<div id="table-page">
  <div id="table-wrap">

<?php
$row = edit_search_order($user_id, $current_project); 

if (isset($row['shared_with']) && $row['shared_with'] == $user_id) {

  require '_logged_in/edit_search_order_shared_with.php';

  } else if (isset($row['owner_id']) && $row['owner_id'] == $user_id) {

    require '_logged_in/edit_search_order_owner.php';

  } else {
          echo "<p class=\"query-tinkerer\">Either you're trying to be sneaky or the Internet is angling to sabbotage your immaculate reputation. You need to do something different.</p>";
}   
?>
  </div><!-- #table-wrap -->
</div><!-- #table-page -->

<?php require '_includes/footer.php'; ?>