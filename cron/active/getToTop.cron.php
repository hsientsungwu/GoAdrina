<?php

if ($_SERVER['DOCUMENT_ROOT'] == "") $_SERVER['DOCUMENT_ROOT'] = '/home/hwu1986/public_html/goadrina/htdocs/';

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

global $fb;

$postId = '330139017120315';

$postInfo = $fb->api($postId . '/comments', 'GET');

var_dump($postInfo);

if ($postInfo) {
	$data = array(
		'message' => ':)'
	);

	try {
		$newCommentData = $fb->api($postId . "/comments", 'POST', $data);
	} catch (FacebookApiException $e) {
		$result = $e->getResult();
	}

	sleep(5);

	if (isset($newCommentData['id'])) {
		$result = $fb->api($newCommentData['id'], 'DELETE');
	}
}

	

var_dump($result);