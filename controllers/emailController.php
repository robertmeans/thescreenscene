<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

function sendVerificationEmail($firstname, $email, $token) {

    $mail = new PHPMailer(true);

    try {
        
        mail_config();

        //Recipients
        $mail->setFrom('donotreply@browsergadget.com', 'BrowserGadget');
        $mail->addAddress($email, $firstname);     // Add a recipient
        $mail->addReplyTo('browsergadget@gmail.com');
        // $mail->addCC('cc@example.com');
        $mail->addBCC('browsergadget@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'BrowserGadget Registration';
        $mail->Body    =    '<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Verify BrowserGadget Registration</title>
          <style>
            .wrapper {
              padding: 20px;
              color: #313131;
              font-family: Tahoma, Verdana, sans-serif;
            }
          </style>                
        </head>
        <body>
          <div class="wrapper">
            <p>Hello ' . $firstname . ',
            <p>Are you tired of using your browser like a Neanderthal? Are you ready to be more efficient, more organized taller and better looking?</p>
            <p><a href="https://browsergadget.com/index.php?token=' . $token . '">Click here</a> to verify your email address - or copy &amp; paste the link below into your browser address bar.</p>
            <p>Sincerely,<br>Evergreen Bob</p>
            <p>https://browsergadget.com/index.php?token=' . $token . '</p>
          </div>
        </body>
        </html>';
        $mail->AltBody = 'Hello ' . $firstname . ', Please copy and paste this verification link into your browser address bar to validate your BrowserGadget registration: https://browsergadget.com/index.php?token=' . $token;

        $mail->send();

    } catch (Exception $e) {
        echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: browsergadget@gmail.com -- Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendPasswordResetLink($email, $token) {

    $mail = new PHPMailer(true);

    try {
        
        mail_config(); 

        //Recipients
        $mail->setFrom('donotreply@browsergadget.com', 'BrowserGadget');
        $mail->addAddress($email);     // Add a recipient
        $mail->addReplyTo('donotreply@browsergadget.com');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('robert@evergreenwebdesign.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset Your BrowserGadget Password';
        $mail->Body = '<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Reset BrowserGadget Password</title>
          <style>
            .wrapper {
              padding: 20px;
              color: #313131;
              font-family: Tahoma, Verdana, sans-serif;
            }
          </style>                     
        </head>
        <body>
          <div class="wrapper">
            <p>Please click on the link below to reset your password.</p>
            <p><a href="https://browsergadget.com/index.php?password-token=' . $token . '">Click here</a> to reset your password - or copy &amp; paste the link below into your browser address bar.</p>
            <p>Sincerely,<br>Evergreen Bob</p>
            <p>https://browsergadget.com/index.php?password-token=' . $token . '</p>
          </div>
        </body>
        </html>';

    $mail->AltBody = 'Please copy and paste this link into your browser address bar to reset your password: https://browsergadget.com/index.php?token=' . $token;
    $mail->send();

    } catch (Exception $e) {
        echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: browsergadget@gmail.com -- Mailer Error: {$mail->ErrorInfo}";
    }
}