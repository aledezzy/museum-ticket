<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Grazie per averci contattato. '
	);

    $name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'email@email.com';

    $body = 'Nome: ' . $name . "\n\n" . 'Cognome: ' . $email . "\n\n" . 'Oggetto: ' . $subject . "\n\n" . 'Messaggio: ' . $message;

    $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    echo json_encode($status);
    die;