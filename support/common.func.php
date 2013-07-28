<?php

function log_error($content) {
	global $db;

	$affected = $db->insert(array('content' => json_encode($content)), 'log_errors');

	$emailContent['subject'] = "Error on {$content['type']}";
	$emailContent['body'] = $content['message'];

	send_email($emailContent, 'admin');

	return ($affected) ? true : false;
}

function send_email($content, $type = 'admin') {	
	// subject
	$subject = $content['subject'];

	// message
	$message = "
	<html>
	<head>
	  <title>An error just occured!</title>
	</head>
	<body>
	  <p>{$content['body']}</p>
	</body>
	</html>
	";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: Steve <hwu1986@gmail.com>' . "\r\n";
	$headers .= 'From: Go Andres! <no-reply@goandres.com>' . "\r\n";
	
	// Mail it
	mail($to, $subject, $message, $headers);
}