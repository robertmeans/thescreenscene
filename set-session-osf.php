<?php
require_once 'config/initialize.php';

$_SESSION['organize'] = 'anothern';
$signal = 'ok';

echo json_encode($signal);
