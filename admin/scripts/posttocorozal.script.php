<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

global $fb, $db, $POST_USER;

$accessToken = $db->fetchCell("SELECT access_token FROM facebook_session WHERE user_id = ?", array($POST_USER));

$fb->setAccessToken($accessToken);

$user = $fb->getUser();

$posts = $db->fetchRows("SELECT id FROM facebook_posts WHERE message LIKE '%corozal%' ORDER BY created_time ASC", array());



foreach ($posts as $post) {
	$postData = $db->fetchRow("SELECT message, link FROM facebook_posts WHERE id = ?", array($post['id']));
	
	$data = array(
		'message' => '[Go Adrina! Automated Posting] ' . $postData['message'],
		'link' => $postData['link'],
	);

	try {
		$newPostData = $fb->api('/'. $corozalGroupId . "/feed", 'POST', $data);

		if (isset($newPostData['id'])) {
			print_r("{$post['id']} - Success <br>");
		} else {
			print_r("{$post['id']} - Failed <br>");
		}
	} catch (FacebookApiException $e) {
		$result = $e->getResult();
		echo "<pre>"; print_r($result); echo "<pre>";

		$content['message'] = $result['error']['type'] . ' - ' . $result['error']['message'];
		$content['type'] = "Facebook Post Ads: {$postId['entityId']}";

		log_error($content);
	}
}

function postToCorozal($postId) {
	global $fb, $db, $POST_USER, $COROZAL_GROUP;

	// facebook preparation
	$accessToken = $db->fetchCell("SELECT access_token FROM facebook_session WHERE user_id = ?", array($POST_USER));
	$fb->setAccessToken($accessToken);
	$user = $fb->getUser();

	$postData = $db->fetchRow("SELECT message, link FROM facebook_posts WHERE id = ?", array($postId));

	if ($postData['message']) {
		$data = array('message' => '[Go Adrina!] ' . $postData['message']);

		if ($postData['link']) {
			$data['link'] = $postData['link'];
		}

		try {
			$newPostData = $fb->api('/'. $COROZAL_GROUP . "/feed", 'POST', $data);

			if (isset($newPostData['id'])) {
				return true;
			} else {
				return false;
			}
		} catch (FacebookApiException $e) {
			$result = $e->getResult();
			echo "<pre>"; print_r($result); echo "<pre>";

			$content['message'] = $result['error']['type'] . ' - ' . $result['error']['message'];
			$content['type'] = "Facebook Post Ads: {$postId}";

			log_error($content);

			return false;
		}
	}
}