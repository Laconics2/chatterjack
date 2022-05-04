<?php
	include "gen_temp_pass.php";
	$n = 10;
	$temp = getRandomString($n);
	echo $temp;
	$hash_temp = password_hash($temp, PASSWORD_DEFAULT);
	echo "<br>";
	echo $hash_temp;

//	$to = "skh269@nau.edu";
//	$subject = "Subject";
//	$message = "here is the message $temp.";
//	$header = "From:saraharris2000@gmail.com \r\n";
//	$header .= "Cc:gbp25@nau.edu \r\n";
//	$header .= "MIME-Version: 1.0\r\n";
//	$header .= "Content-type: text/html\r\n";
//	$retval = mail($to, $subject, $message, $header);
	
	// this is from the package we're using
	// create the mail object
	//$mail = new PHPMailer();
	//$mail->isSMTP();
	//$mail->SMTPAuth = true;
	//$mail->SMTPSecure = 'ssl';
	//$mail->Host = 'smtp.gmail.com';
	//$mail->Port = '465';
	//$mail->isHTML();
	//// set the needed information for the email
	//$mail->Username = 'chatterjack2022@gmail.com';
	//$mail->Password = 'at$M3ueVVr2QKm';
	//$mail->SetFrom('no-reply@chatterjack.org');
	//$mail->Subject = 'Hello World';
	//$mail->Body = 'A test email.';
	//$mail->AddAddress('skh269@nau.edu');

	//$mail->Send();
	
	// require the stuff we need from the PHP mailer files 
	require 'PHPMailer/PHPMailerAutoload.php';

	// create the instance
	$mail = new PHPMailer;

	// set up what we need with SMTP 
	$mail->isSMTP();
	$mail->SMPTDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = 'chatterjack2022@gmail.com';
	$mail->Password = 'at$M3ueVVr2QKm';
	$mail->setFrom('noreply@chatterjack', 'Sara Harris');
	$mail->addAddress('skh269@nau.edu', 'Sara H');
	$mail->Subject = 'Test ChatterJack';
	$mail->AltBody = 'This is a plain text body';
	if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		    echo "Message sent!";
	}
?>
