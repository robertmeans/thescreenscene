<?php
require_once 'config/initialize.php';

$_SESSION['view-proj-pg'] = 'anothern';
$signal = 'ok';

echo json_encode($signal);
