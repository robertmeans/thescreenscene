<?php
require_once 'config/initialize.php';

$_SESSION['organize'] = 'anothern';

if (isset($_POST['change_project_id'])) {
  $_SESSION['organize-this-project'] = $_POST['change_project_id'];
}

$signal = 'ok';

echo json_encode($signal);
