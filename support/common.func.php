<?php

function log_error($content) {
	global $db;

	$affected = $db->insert(array('content' => json_encode($content)), 'log_errors');

	$emailContent['subject'] = "Error on {$content['type']}";
	$emailContent['body'] = $content['message'];

	send_email($emailContent, 'admin');

	return ($affected) ? true : false;
}

function log_cron($stats = array(), $total_posts = 0) {
	global $db;

	$send_email_flag = false;

	foreach ($stats as $fb_group_id => $fb_group_data) {
		if ($fb_group_data['stat']['store_posts_count'] > 0 || $fb_group_data['stat']['store_users_count'] > 0) {
			$send_email_flag = true;

			$newCronLog = array(
				'total_cron_posts' => $fb_group_data['stat']['posts_count'], 
				'total_store_posts' => $fb_group_data['stat']['store_posts_count'], 
				'total_store_users' => $fb_group_data['stat']['store_users_count'],
				'cron_source' => $fb_group_id,
			);
			
			$affected = $db->insert($newCronLog, 'log_crons');

			$content['body'] .= "<p><ul>
									<li>Source: {$fb_group_data['group']}</li>
									<li>Total Cron Posts: {$fb_group_data['stat']['posts_count']}</li>
									<li>Total Stored Posts: {$fb_group_data['stat']['store_posts_count']}</li>
									<li>Total Stored Users: {$fb_group_data['stat']['store_users_count']}</li>
								</ul></p>";
		}
	}

	if ($send_email_flag) {
		$content['subject'] = '[Andrina Social Cron] Ran ' . $total_posts . ' posts on ' . date("Y-m-d H:i:s");
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