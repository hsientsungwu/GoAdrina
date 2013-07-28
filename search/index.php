<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if ($_GET) {
	$key = htmlentities($_GET['k']);

	$results = search($key);
}

?>

<html>
	<head>
		<title>Go Andrina!</title>
		<link rel="stylesheet" href="/css/normalize.css" />
  		<link rel="stylesheet" href="/css/foundation.css" />
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
  		<script src="/js/home.js"></script>
	</head>
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/frontend/searchbar.frontend.php"); ?>

		<?php

		if (count($results)) {

		} else { ?>
			<div class="row">
				<div class="small-8 large-centered columns">
					<p>No result found ... </p>
				</div>
			</div>	


		<?php } ?>
	</body>
</html>