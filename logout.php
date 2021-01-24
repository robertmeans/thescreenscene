<?php
require_once 'config/initialize.php';

class Util {       
    public function clearAuthCookie() {
        if (isset($_COOKIE["token"])) {
            setcookie("token", "");
        }
    }
}

$util = new Util();

//Clear Session
$_SESSION['id'] = "";
$_SESSION['username'] = "";
$_SESSION['email'] = "";
$_SESSION['verified'] = "";
session_destroy();

// clear cookies
$util->clearAuthCookie();

header('Location:' . WWW_ROOT);
?>