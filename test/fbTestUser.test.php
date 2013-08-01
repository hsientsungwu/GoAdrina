<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

echo $fb->getAccessToken();

// Get User ID
$user = $fb->getUser();

if ($user == '0') {
	$params = array(
    	'scope' => array('user_groups', 'read_stream', 'publish_stream')
  	);

  	$loginUrl = $fb->getLoginUrl($params);

	echo "User is undefined<br>";
	echo "<a href='{$loginUrl}'>Login</a><br>";
} else {
	echo "User is {$user}";
	$user_profile = $fb->api('/me');

	var_dump($user_profile);
}

