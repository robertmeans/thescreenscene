<?php
require_once 'config/initialize.php';

$_SESSION['order'] = 'anothern';
$signal = 'ok';

echo json_encode($signal);
