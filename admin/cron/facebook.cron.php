<?php

if ($_SERVER['DOCUMENT_ROOT'] == "") $_SERVER['DOCUMENT_ROOT'] = '/home/hwu1986/public_html/latteblog/tools/andres/htdocs/';

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$start = microtime(true);

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$fb_groups = array(
    'BBS' => '127267637407455',
    'BST' => '203507416440736',
);

$total_posts_count = 0;

foreach ($fb_groups as $fb_group_name => $fb_group_id) {

    $posts_count = $store_posts_count = $store_users_count = 0;

    $lastCronTime = getLastFacebookCronForSource($fb_group_id);

    if ($lastCronTime) {
        $timeParams = 'since=' . $lastCronTime;
        $fb_group_feeds = $fb->api('/' . $fb_group_id .'/feed?'. $timeParams, 'GET');
    } else {
        $fb_group_feeds = $fb->api('/' . $fb_group_id .'/feed', 'GET');
    }

    if (count($fb_group_feeds['data'])) {

        foreach ($fb_group_feeds['data'] as $post) {

            if (!isFacebookAccountStored($post['from']['id'])) {
                if (addFacebookAccount($post['from']['id'])) $store_users_count++;
            }

            if (!isFacebookPostStored($post['id'])) {
                if (addFacebookPost($post)) $store_posts_count++;

                print_r("<br><b>{$post['id']}</b><br>{$post['message']}<br>");
            }

            $posts_count++;
        }
    }

    $stats[$fb_group_id] = array(
    	'group' => $fb_group_name,
    	'stat' => array(
	    	'posts_count' => $posts_count,
	    	'store_posts_count' => $store_posts_count,
	    	'store_users_count' => $store_users_count,
	    )
    );

    $total_posts_count += $posts_count;
}

log_cron($stats, $total_posts_count);

$end = microtime(true);

$total = $end - $start;

print_r("<h3>Time spent to execute {$total_posts_count} posts: {$total} seconds");
