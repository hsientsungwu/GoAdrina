<?php

function search($key, $page = 1) {
	global $db;

	if ($key == '') return array('data' => array(), 'total' => 0);

	addSearchHistory($key);
	
	$limit = 20;
	$offset = ($page-1)*$limit;

	$totalCount = $db->fetchCell("SELECT COUNT(id) FROM facebook_posts WHERE message LIKE '%{$key}%'");

	$result = $db->fetchRows("SELECT message, thumbnail, link, created_time, source FROM facebook_posts WHERE message LIKE '%{$key}%' ORDER BY created_time DESC LIMIT {$offset}, {$limit}");

	$returnData = array(
		'data' => (count($result) ? $result : array()),
		'total' => $totalCount,
		'limit' => $limit,
		'page' => $page
	);

	return $returnData;
}

function addSearchHistory($key) {
	global $db, $fb;

	$user = $fb->getUser();

	$newHistory = array(
		'user' => ($user ? $user : '0'),
		'key' => $key
	);

	$affected = $db->insert($newHistory, 'search_history');

	return ($affected ? true : false);
}