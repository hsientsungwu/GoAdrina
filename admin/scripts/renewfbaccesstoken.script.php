<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$user = $fb->getUser();

if ($user) {
	$loginStatus = true;
	$accessToken = $fb->getAccessToken();

	$existingUser = $db->fetchCell("SELECT user_id FROM facebook_session WHERE user_id = ?", array($user));

	$newFbSession = array(
		'access_token' => $fb->getAccessToken()
	);
	
	if ($existingUser) {
		$affected = $db->update($newFbSession, "facebook_session");
	} else {
		$newFbSession['user_id'] = $user;
		$affected = $db->insert($newFbSession, "facebook_session");
	}
} else {
	$loginStatus = false;
	$params = array(
    	'scope' => array('user_groups', 'read_stream', 'publish_stream')
  	);

  	$loginUrl = $fb->getLoginUrl($params);
}
?>

<html>
	<head>
		<title>Renew Facebook Admin Access Token</title>
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" href="/css/normalize.css" />
		<link rel="stylesheet" href="/css/foundation.css" />
	</head>
	<body>
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<div class="large-6 columns">
						<?php
						if (!$affected) {
						?>
							<h3>Login Status: <?php echo ($loginStatus ? "Logged In" : "Logged Out"); ?></h3>
							<h3>User: <?php echo $user; ?></h3>
							<?php 
								if (!$loginStatus) {
									echo "<h4>Get New Facebook Access Token: <a href=\"" . $loginUrl . "\">LOGIN</a></h4>";
								}
							?>
						<?php
						} else {
							if ($affected) {
								echo "<h3>Facebook Access Token RENEWED</h3>";
							} else {
								echo "<h3>Facebook Access Token FAILED to renew</h3>";
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>