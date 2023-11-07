<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '_functions/functions.php';
require_once 'vendor/autoload.php';
require_once 'config/constants.php';

	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$message = trim($_POST['comments']);

if (is_post_request()) {

	if($name && $email && $message) {

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


    $mail = new PHPMailer(true);

    try { 

        mail_config();

        //Recipients
        $mail->setFrom('donotreply@browsergadget.com', $name);
        $mail->addAddress('browsergadget@gmail.com', 'BrowserGadget Website Contact Form');     // Add a recipient
        $mail->addReplyTo($email, $name);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('robertmeans01@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email from BrowserGadget Website';
        $mail->Body    =  'Name: ' . $name . '<br>Email: ' . $email . '<br><hr><br>' . nl2br($message);

        $mail->send();
		    // echo 'Message has been sent';
		    $signal = 'ok';
		    $msg =  'Message sent successfully';
	    } catch (Exception $e) {
	        $signal = 'bad';
	        $msg = 'Mail Error: ' {$mail->ErrorInfo};
	    }

		} else {
		  $signal = 'bad';
		  $msg = 'Invalid email address. Please fix.';
		}

	} else {
		$signal = 'bad';
		$msg = 'Please fill in all the fields.';
	}

}
	$data = array(
		'signal' => $signal,
		'msg' => $msg
	);
	echo json_encode($data);

// stop

?>