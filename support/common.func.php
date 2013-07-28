<?php

function log_error($content) {
	global $db;

	$affected = $db->insert(array('content' => json_encode($content)), 'log_errors');

	$emailContent['subject'] = "Error on {$content['type']}";
	$emailContent['body'] = $content['message'];

	send_email($emailContent, 'admin');

	return ($affected) ? true : false;
}

function log_cron($posts_count, $store_posts_count, $store_users_count, $source) {
	global $db;

	if ($store_posts_count > 0 || $store_users_count > 0) {
		$newCronLog = array(
			'total_cron_posts' => $posts_count, 
			'total_store_posts' => $store_posts_count, 
			'total_store_users' => $store_users_count,
			'cron_source' => $source,
		);

		$affected = $db->insert($newCronLog, 'log_crons');

		$content['subject'] = 'Cron job run at : ' . date("Y-m-d H:i:s");
		$content['body'] = "<ul>
								<li>Source: {$source}</li>
								<li>Total Cron Posts: {$posts_count}</li>
								<li>Total Stored Posts: {$store_posts_count}</li>
								<li>Total Stored Users: {$store_users_count}</li>
							</ul>";
		send_email($content, 'admin');
	}
		
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
	$headers .= 'From: Go Andrina! <no-reply@goandrina.com>' . "\r\n";
	
	// Mail it
	mail($to, $subject, $message, $headers);
}