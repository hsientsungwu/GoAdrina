<?php

if ($_SERVER['DOCUMENT_ROOT'] == "") $_SERVER['DOCUMENT_ROOT'] = '/home/hwu1986/public_html/goadrina/htdocs/';

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$debug = ($_GET['debug']) ? true : false;

$start = microtime(true);

$fb_groups = getFacebookGroups();

$total_posts_count = 0;
$corozal_count = 0;

foreach ($fb_groups as $fb_group_id => $fb_group_name) {

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
                if (addFacebookPost($post)) {
                    if (strstr(strtolower($post['message']), 'corozal')) {
                        //postToCorozal($post['id']);
                        $corozal_count++;
                    }

                    $store_posts_count++;
                }

                if ($debug) print_r("<br><b>{$post['id']}</b><br>{$post['message']}<br>");
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
            'corozal_post_count' => $corozal_count,
	    )
    );

    $total_stored_posts_count += $store_posts_count;
    $total_posts_count += $posts_count;
}

log_cron($stats, $total_stored_posts_count);

$end = microtime(true);

$total = $end - $start;

print_r("<h3>Time spent to retrieve {$total_posts_count} posts and store {$total_stored_posts_count} posts: {$total} seconds</h3>");
print_r("<h4>Total Corozal Post Count: {$corozal_count}</h4>");
?>