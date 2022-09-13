<?php

function sendMail($to, $name, $subject, $body) {
	require '../assets/vendor/autoload.php';
	require_once '../assets/vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	
	$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
		->setUsername('caravanrental0001@gmail.com')
		->setPassword('dlvlyqstpshjhxiw');

	$mailer = new Swift_Mailer($transport);

	$message = (new Swift_Message($subject))
		->setFrom(['caravanrental0001@gmail.com' => 'Caravan Rental!'])
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