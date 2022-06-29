<?php

    include 'send-email.php';

    $email = $_POST['email'];
    $to = $email;
    
    $firstname = 'Sample';
    $lastname = 'Sample';

    $name = $firstname.' '.$lastname;
    $subject = '[NFA]Welcome to NFA Binalonan!';
    $body = 'Hi '.$name.' and welcome to NFA Binalonan!!<br><br>
    Below are your account credentials:<br><br>

    Thank you!<br><br>

    *This is an automatically generated email. Please do not reply to this email.<br>';

    sendMail($to, $name, $subject, $body);

?>