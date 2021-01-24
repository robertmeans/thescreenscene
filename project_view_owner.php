<?php $layout_context = "project-view"; 

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


$user_id = $_SESSION['id'];
$current_project = $_SESSION['current_project'];


if (is_post_request()) {
  if (isset($_POST['tab1'])) {
    $page_number = $_POST['page_number'] ?? '';

    $result = update_page_number_owner($user_id, $current_project, $page_number);

      if($result === true) {
        header('location: ' . WWW_ROOT);

      } else { 
        $errors = $result;
      }
  }
  if (isset($_POST['tab2'])) {
    $page_number = $_POST['page_number'] ?? '';

    $result = update_page_number_owner($user_id, $current_project, $page_number);

      if($result === true) {
        header('location: ' . WWW_ROOT);

    
      } else { 
        $errors = $result;
      }
  }
   if (isset($_POST['tab3'])) {
    $page_number = $_POST['page_number'] ?? '';

    $result = update_page_number_owner($user_id, $current_project, $page_number);

      if($result === true) {
        header('location: ' . WWW_ROOT);

    
      } else { 
        $errors = $result;
      }
  } 

}

?>

<?php require '_includes/head.php'; ?>
<body>

<?php require '_includes/nav.php'; ?>

<div id="table-page">

  <div id="table-wrap">

<?php
    echo "<p class=\"query-tinkerer\" style=\"text-align:center;\">You're trying to be sneaky but I'm on to you.</p><p style=\"font-size:3em;text-align:center;\"><i class=\"far fa-frown\"></i></p>";
    
?>
  </div><!-- #table-wrap -->
</div><!-- #table-page -->
<?php require '_includes/footer.php'; ?>