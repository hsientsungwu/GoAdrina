<?php

function search($key, $page = 0) {
	global $db;

	if ($key == '') return array('data' => array(), 'total' => 0);

	$limit = 20;

	$data = $db->fetchRows("SELECT message, thumbnail, link, created_time, source FROM facebook_posts WHERE message LIKE '%{$key}%' ORDER BY created_time DESC");

	if (count($data) > $limit) {
		$result = array_slice($data, $page*$limit, $limit);
	} else {
		$result = $data;
	}

	$returnData = array(
		'data' => (count($result) ? $result : array()),
		'total' => count($data),
		'limit' => $limit,
		'page' => $page
	);

	return $returnData;
}