<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

function sendVerificationEmail($firstname, $lastname, $email, $token) {

  $mail = new PHPMailer(true);

  try {

      mail_config();   

      $mail->setFrom('donotreply@browsergadget.com', 'BrowserGadget');
      $mail->addAddress($email);     // Add a recipient
      $mail->addReplyTo('donotreply@browsergadget.com');
      // $mail->addCC('cc@example.com');
      $mail->addBCC('robert@evergreenwebdesign.com');

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Verify Your BrowserGadget Registration';
      $mail->Body    =    '<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Verify Your BrowserGadget Registration</title>
    <style>
      body {
        font-size: 16px;
        color: #313131;
        font-family: Verdana, Tahoma, Calbri, Arial, sans-serif;
      }
      .wrapper {
        padding: 1.5em;
        font-size: 1em;
      }
    </style>    
  </head>
  <body>
    <div class="wrapper">
      <p>Hello ' . $firstname . ' ' . $lastname . ',</p>

      <p>Are you tired of using your browser like a Neanderthal? Are you ready to be more efficient, more organized taller and better looking?</p>

      <p><a href="https://browsergadget.com/index.php?token=' . $token . '">Click here</a> to verify your email address - or copy &amp; paste the link below into your browser address bar.</p>

      <p>If you have any comments, questions or suggestions please use the contact form at the bottom of the website or email me at the address below.</p>

      <p>Sincerely,<br>
      Evergreen Bob<br>
      browsergadget@gmail.com</p>

      <p><u>Copy &amp; paste verification URL</u>:<br>
      https://browsergadget.com/index.php?token=' . $token . '</p>

    </div>
    
  </body>
  </html>';
      $mail->AltBody = 'Hello ' . $firstname . ' ' . $lastname . ', Please copy and paste this verification link into your browser address bar to validate your BrowserGadget registration: https://browsergadget.com/index.php?token=' . $token;

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

        <p>Sincerely,<br>
        Evergreen Bob<br>
        browsergadget@gmail.com</p>

        <p>https://browsergadget.com/index.php?password-token=' . $token . '</p>
      </div>
    </body>
    </html>';

  $mail->AltBody = 'Please copy and paste this link into your browser address bar to reset your password: https://browsergadget.com/index.php?password-token=' . $token;
  $mail->send();

  } catch (Exception $e) {
    echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: browsergadget@gmail.com -- Mailer Error: {$mail->ErrorInfo}";
  }
}


function emailBob($name, $email, $message) {

  $mail = new PHPMailer(true);

  try {
      
    mail_config(); 

    //Recipients
    $mail->setFrom('donotreply@browsergadget.com', 'BrowserGadget');
    $mail->addAddress('browsergadget@gmail.com');     // Add a recipient
    $mail->addReplyTo($email, $name);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('robert@evergreenwebdesign.com');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'BrowserGadget: comments | questions | suggestions';
    $mail->Body    =  'Name: ' . $name . '<br>Email: ' . $email . '<br><hr><br>' . nl2br($message);
    $mail->AltBody = 'Name: ' . $name . '<br>Email: ' . $email . '<br><hr><br>' . nl2br($message); 

  $mail->send();

  } catch (Exception $e) {
    echo "Email verification ran into a server error. This is no bueno and brings shame to my family. If you are so inclined, please copy and paste this message into an email to: browsergadget@gmail.com -- Mailer Error: {$mail->ErrorInfo}";
  }
}

