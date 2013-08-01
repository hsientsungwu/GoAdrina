<?php

if ($_SERVER['DOCUMENT_ROOT'] == "") $_SERVER['DOCUMENT_ROOT'] = '/home/hwu1986/public_html/goadrina/htdocs/';

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

global $fb, $db;

$token = getAccessTokenForAdminUser();
$fb->setAccessToken($token);
print_r('11');
$postIds = $db->fetchAll("SELECT entityId FROM facebook_entity WHERE entityType = ? AND category = ?", array(FacebookEntityType::POST, AdrinaCategory::FACEBOOKADS));

$totalCount = count($postIds);
$successCount = 0;

foreach ($postIds as $postId) {
	print_r('18');
	$postInfo = $fb->api('/' . $postId['entityId'], 'GET');
	print_r('20');
	//echo "<pre>"; print_r($postInfo); echo "<pre>";

	if (count($postInfo) && $postInfo['id']) {

		$data = array(
			'message' => ':)'
		);

		try {
			print_r('30');
			$newCommentData = $fb->api('/'. $postId['entityId'] . "/comments", 'POST', $data);
			print_r('32');
			if (isset($newCommentData['id'])) {
				sleep(3);
				print_r('35');
				$result = $fb->api($newCommentData['id'], 'DELETE');
				$successCount++;
			}
		} catch (FacebookApiException $e) {
			print_r('40');
			echo "<pre>"; print_r($e->getResult()); echo "<pre>";

			$content['message'] = $e->getResult();
			$content['type'] = "Facebook Post Ads: {$postId['entityId']}";

			log_error($content);
		}
	}
}
print_r('50');
$emailContent['subject'] = "[Go Adrina!] Facebook Post Ads Cron Result";
$emailContent['body'] = "Total Post Ads: {$totalCount} and Total SUCCESS: {$successCount}";
send_email($emailContent, 'admin');

echo $emailContent['body'];


