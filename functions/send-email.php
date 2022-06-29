<?php

function sendMail($to, $name, $subject, $body) {
	require '../vendor/autoload.php';
	require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	
	$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
		->setUsername('angelo.nyelo@gmail.com')
		->setPassword('angelonyelo082596');

	$mailer = new Swift_Mailer($transport);

	$message = (new Swift_Message($subject))
		->setFrom(['dev.angelogelo@gmail.com' => 'NFA!'])
		->setTo([$to => $name])
		->addPart($body, 'text/html');

	// Send the message
	$result = $mailer->send($message);

	if($result) {
		return true;
		echo "True";
	} else {
		return false;
	}

}

?>