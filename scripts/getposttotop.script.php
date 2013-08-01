<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

global $fb, $db;

$token = getAccessTokenForAdminUser();
$fb->setAccessToken($token);

$user = $fb->getUser();

$postIds = $db->fetchAll("SELECT entityId FROM facebook_entity WHERE entityType = ? AND category = ?", 
						array(FacebookEntityType::POST, AdrinaCategory::FACEBOOKADS));

$totalCount = count($postIds);
$successCount = 0;

foreach ($postIds as $postId) {
	$postInfo = $fb->api('/' . $postId['entityId'], 'GET');

	//echo "<pre>"; print_r($postInfo); echo "<pre>";

	if (count($postInfo) && $postInfo['id']) {

		$data = array(
			'message' => ':)'
		);

		try {
			$newCommentData = $fb->api('/'. $postId['entityId'] . "/comments", 'POST', $data);

			if (isset($newCommentData['id'])) {
				sleep(3);
				$result = $fb->api($newCommentData['id'], 'DELETE');
				$successCount++;
			}
		} catch (FacebookApiException $e) {
			echo "<pre>"; print_r($e->getResult()); echo "<pre>";

			$content['message'] = $e->getResult();
			$content['type'] = "Facebook Post Ads: {$postId['entityId']}";

			log_error($content);
		}
	}
}

$emailContent['subject'] = "[Go Adrina!] Facebook Post Ads Cron Result";
$emailContent['body'] = "Total Post Ads: {$totalCount} and Total SUCCESS: {$successCount}";
send_email($emailContent, 'admin');

echo $emailContent['body'];


?>