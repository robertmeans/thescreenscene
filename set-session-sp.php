<?php
require_once 'config/initialize.php';

$_SESSION['share-project'] = 'anothern';

if (isset($_POST['change_project_id'])) {
  $_SESSION['share-project-id'] = $_POST['change_project_id'];
}

$signal = 'ok';

echo json_encode($signal);
