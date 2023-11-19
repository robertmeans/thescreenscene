<?php
require_once 'config/initialize.php';

$_SESSION['another-proj'] = 'anothern';
$signal = 'ok';

echo json_encode($signal);
