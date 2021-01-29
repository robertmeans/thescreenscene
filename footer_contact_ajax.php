<?php

require_once 'config/initialize.php';

if (is_post_request()) {
  if (isset($_POST['comments'])) {
    $sendersname = $_POST['sendersname'];
    $email = $_POST['email'];
    $comments = nl2br($_POST['comments']);

    $to = 'browsergadget@gmail.com';
    $from = $email;
    $subject = 'Message From BrowserGadget Website';
    $message = '<b>Name:</b> '.$sendersname.'<br><b>Email:</b> '.$email.' <p>'.$comments.'</p>';
    $headers = "From: $from\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    if(mail($to, $subject, $message, $headers)) {
        echo "success";
      } else {
          echo "Something no bueno. Your message was not sent. Please try again later.";
      }
  }
}