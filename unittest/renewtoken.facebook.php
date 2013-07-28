<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if ($_GET['code']) {
	if (renewFacebookAccessToken()) {
		$body = 'Facebook Access Token renew successfully!';
	} else {
		$body = 'Facebook Access Token failed to renew!';
	}
} else {
	$params = array(
		'scope' => 'user_groups', 'read_stream'
	);

	$loginUrl = $fb->getLoginUrl($params);

	$body = 'Click <a href="<?php echo $loginUrl; ?>">here</a> to renew Access Token';
}
?>

<html>
	<head><title>Reconnect Facebook - Renew Access Token</title></head>
	<body>
		<p><?php echo $body; ?></p>
	</body>
</html>