<?php  
	
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;

		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';

	class email
	{

		public static function sendmail($to,$subject,$message,$cc = null)
		{
		$mail = new PHPMailer();
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// SMTP::DEBUG_OFF = off (for production use)
		// SMTP::DEBUG_CLIENT = client messages
		// SMTP::DEBUG_SERVER = client and server messages
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption mechanism to use - STARTTLS or SMTPS
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = 'learningmanagementsystemhist@gmail.com';
		//Password to use for SMTP authentication
		$mail->Password = 'Shawal@80';
		//Set who the message is to be sent from
		$mail->setFrom('learningmanagementsystemhist@gmail.com');
		//Set an alternative reply-to address
		// $mail->addReplyTo($replyto);
		//Set who the message is to be sent to
		$mail->isHTML(true);
		$mail->addAddress($to);
		$mail->addCC($cc);
		// $mail->addBCC($bcc);

		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body
		$mail->msgHTML( $message );
		//Attach an image file (optional)
		// $mail->addAttachment($file);
		//send the message, check for errors
		if (!$mail->send()) {
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    //echo 'Account Activated and Email is Sent To User';
		}		
		}	

		}
	



?>