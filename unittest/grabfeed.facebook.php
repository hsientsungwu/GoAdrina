<?php
$start = microtime(true);

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$fb_groups = array(
    'BBS' => '127267637407455'
);

$count = 0;

foreach ($fb_groups as $fb_group_name => $fb_group_id) {

	$fb_group_feeds = $fb->api('/' . $fb_group_id .'/feed' ,'GET');

	if (count($fb_group_feeds)) {

		foreach ($fb_group_feeds['data'] as $post) {

			if (!isFacebookAccountStored($post['from']['id'])) { 
                //addFacebookAccount($post['from']['id']);
            }

            if (!isFacebookPostStored($post['id'])) {
            	//addFacebookPost($post);
            }

            $count++;
		}
	}
}

$end = microtime(true);

$total = $end - $start;

print_r("<h3>Time spent to execute {$count} posts: {$total} seconds");


