<?php
header('Access-Control-Allow-Origin: *');
require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if ($_GET) {
	$key = htmlentities($_GET['k']);
	$page = ($_GET['page'] ? $_GET['page'] : 1);

	$results = searchAll($key, Source::EXTENSION);
}

if (count($results)) {

	foreach ($results as $index => $result) {

		$thumbnail = (strlen($result['thumbnail']) > 1 ? $result['thumbnail'] : 'nophoto.jpg');

		echo "<div class=\"large-12 columns\"><a target=\"_blank\" href=\"" . $result['link'] . "\"><div class=\"panel text-center post-box\">
			<span class=\"label\">" . substr($result['message'],0, 30) . "..." . "</span>
			<img class=\"post-box-img\"src=\"" . $thumbnail . "\" /></div></a></div>";

	}
} else {
	echo '<div class="large-12 columns><div class="panel">No result found ... </div></div>';
}

