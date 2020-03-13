<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

	    if (isset($_POST["qSub"])){
	    	header("Location: ../index.html?mail=unsuccessful");
	        $name = $_POST["qName"];
	        $email = $_POST["qMail"];
	        $msg = $_POST["qMsg"];
	        
			require 'vendor/autoload.php';

			$mail = new PHPMailer(true);
			try {
			    // Server settings
			    $mail->SMTPOptions = array(
				    'ssl' => array(
				        'verify_peer' => false,
				        'verify_peer_name' => false,
				        'allow_self_signed' => true
				    )
				);
			    $mail->SMTPDebug = 0;
			    $mail->isSMTP();
			    $mail->Host       = 'smtp.sendgrid.net';
			    $mail->SMTPAuth   = true;
			    $mail->Username   = 'apikey';
			    $mail->Password   = ''; // Add key
			    $mail->SMTPSecure = 'tls';
			    $mail->Port       = 587;

			    // Recipients
			    $mail->setFrom($email, $name);
			    $mail->addAddress(''); // Add recipient

			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Client - andersjorgensen.dev';
			    $mail->Body    = $msg;
			    $mail->AltBody = '';

			    $mail->send();
			    header("Location: ../index.html?mail=success");
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
	    } else {
	        header("Location: ../index.html?error=invalidSubmit");
	    }