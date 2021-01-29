<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// error_reporting(0);  // turns off all error reporting

error_reporting(-1); // reports all errors

// ini_set("display_errors", "1"); // shows all errors in browser
ini_set("display_errors", "0"); // hides errors from browser

ini_set("log_errors", 1);
// ini_set("error_log", "php-error.log"); // prints to file 'php-error.log'
ini_set("error_log", "_errors.txt"); // prints to file 'php-error.txt' so I can read it in browser. preceeding underscore is so it's at top of list and easy to find.