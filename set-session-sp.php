<?php
require_once 'config/initialize.php';

$_SESSION['share-project'] = 'anothern';
$_SESSION['share-project-id'] = $_POST['project_id'];

$signal = 'ok';

echo json_encode($signal);
