<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';
    $mail = new PHPMailer(true);



if (is_post_request()) {

  if (isset($_POST['comments'])) {


    try {
        $mail->Host       = 'localhost';
        $mail->SMTPAuth   = false;
        $mail->Username   = EMAIL;
        $mail->Password   = PASSWORD; 

        //Recipients
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress(EMAIL);     // Add a recipient
        $mail->addReplyTo($_POST['email']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('robert@evergreenwebdesign.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Message from BrowserGadget';
        $mail->Body    =    $_POST['comments'];

        $mail->send();

    } catch (Exception $e) {
        echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: bob@browsergadget.com -- Mailer Error: {$mail->ErrorInfo}";
    }

	}


  }