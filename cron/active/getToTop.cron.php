<?php

if ($_SERVER['DOCUMENT_ROOT'] == "") $_SERVER['DOCUMENT_ROOT'] = '/home/hwu1986/public_html/goadrina/htdocs/';

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

global $fb;

$postId = '330139017120315';

$postInfo = $fb->api($postId . '/comments', 'GET');

var_dump($postInfo);

$data = array(
	'message' => ':)'
);

$newCommentData = $fb->api($postId . "/comments", 'POST', $data);

sleep(5);

$result = $fb->api($newCommentData['id'], 'DELETE');

var_dump($result);