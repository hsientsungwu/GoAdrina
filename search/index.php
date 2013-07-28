<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if ($_GET) {
	$key = htmlentities($_GET['k']);
	$page = ($_GET['page'] ? $_GET['page'] : 1);

	$results = search($key, $page);

	if ($results['total'] < $results['limit']) {
		$pages = 1;
	} else {
		$pages = ceil($results['total'] / $results['limit']);
	}
	
	if ($results['page'] == 0) {
		$current = 1;
	} else {
		$current = $results['page'];
	}
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

		<div class="results-container" style="min-height: 500px;">
			<div class="row">
				<div class="small-12 large-centered columns">
			<?php

			if (count($results['data'])) {
				foreach ($results['data'] as $index => $result) { ?>
					<p>
						<span>
							<?php 
								echo date('M j', strtotime($result['created_time'])) . 
								' - <a href="' . $result['link'] . '" target="_blank">' . $result['message'] . '</a> ' . 
								($result['thumbnail'] ? '<font color="green"><i>pic</i></font>' : ''); 
							?>
						</span>
					</p>
				<?php }
			} else { ?>
					<p>No result found ... </p>
			<?php } ?>
					</div>
			</div>

			<div class="pagination-centered">
			  	<ul class="pagination">
			  		<li class="arrow <?php echo ($current <= 1 ? 'unavailable' : ''); ?>"><a href="/search/?k='<?php echo $_GET['key']; ?>&page=<?php echo ($current-1 >= 1 ? $current-1 : $current); ?>">&laquo;</a></li>
			  		<?php
			  			for($i=1; $i <= $pages; $i++) {
			  				$class = ($i == $current ? 'current unavailable' : '');
			  				echo '<li class="' . $class . ' "><a href="/search/?k=' . $_GET['key'] . '&page=' . $i . ' ">' . $i . '</a></li>';
			  			}
			  		?>
				    
				    <li class="arrow <?php echo ($current >= $page ? 'unavailable' : ''); ?>"><a href="/search/?k=<?php echo $_GET['key']; ?>&page=<?php echo ($current+1 < $pages ? $current+1 : $current); ?>">&raquo;</a></li>
			  	</ul>
			</div>
		</div>
	</body>
</html>