<?php

function renewFacebookAccessToken() {
	global $db, $fb;

	$newSession = array(
		'access_token' => $fb->getAccessToken()
	);

	$affected = $db->update($newSession, 'facebook_session', 'id = ?', array($fb->getUser()));

	return ($affected) ? true : false;
}

function isFacebookAccountStored($userId) {
	global $db;

	$user = $db->fetchRow("SELECT id FROM facebook_accounts WHERE id = ?", array($userId));

	return ($user) ? true : false;
}

function addFacebookAccount($userId) {
	global $db, $fb;

	$affected = 0;

	$postOwnerInfo = $fb->api('/' . $userId);

    if (!empty($postOwnerInfo)) { 
        $newUser = array(
            'id' =>         $postOwnerInfo['id'],
            'name' =>       $postOwnerInfo['name'],
            'first_name' => $postOwnerInfo['first_name'],
            'last_name' =>  $postOwnerInfo['last_name'],
            'link' =>       $postOwnerInfo['link'],
            'username' =>   $postOwnerInfo['username'],
            'gender' =>     ($postOwnerInfo['gender'] == 'male') ? 1 : 2
        );

        $affected = $db->insert($newUser, 'facebook_accounts');
    }

    return ($affected > 0) ? true : false;
}

function isFacebookPostStored($postId) {
	global $db;

	$post = $db->fetchRow("SELECT id FROM facebook_posts WHERE id = ?", array($postId));

	return ($post) ? true : false;
}

function addFacebookPost($post) {
	global $db, $fb;

	$affected = 0;
	$ids = explode('_', $post['id']);

	if (!$post['link'] && strpos($post['id'], '_')) {
        $post['link'] = 'http://www.facebook.com/' . $ids[0] . '/posts/' . $ids[1];
    }

    $newPost = array(
        'id' =>      $post['id'],
        'account' =>      $post['from']['id'],
        'message' =>              ($post['message']) ? $post['message'] : 'No Message',
        'thumbnail' =>            $post['picture'],
        'link' =>        $post['link'],
        'created_time' => $post['created_time'],
        'source' => $ids[0]
    );
    
    $affected = $db->insert($newPost, 'facebook_posts');

    return ($affected) ? true : false;
}

function getLastFacebookCronForSource($source) {
	global $db;

	$time = $db->fetchCell("SELECT cron_time FROM log_crons WHERE cron_source = ? ORDER BY cron_time DESC");

	return $time;

}

function getFacebookGroups() {
    global $db;

    $groups = $db->fetchKeyValue("SELECT id, name FROM facebook_groups ORDER BY id");

    return $groups;
}