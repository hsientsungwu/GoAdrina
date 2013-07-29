<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if ($_GET) {
	$key = htmlentities($_GET['k']);
	$page = ($_GET['page'] ? $_GET['page'] : 1);

	$results = search($key, $page);

	if ($results['total'] < $results['limit'] || $results['total'] == 0) {
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
		<title>Go Adrina!</title>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/header.frontend.php'); ?>
	</head>
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/frontend/searchbar.frontend.php"); ?>

		<div class="results-container">
			<div class="row">
				<div class="small-12 large-centered columns">
			<?php

			if (count($results['data'])) {
				foreach ($results['data'] as $index => $result) { ?>
					<div class="panel">
						<?php 
							echo '<span class="label">' . date('M j', strtotime($result['created_time'])) . '</span>' . 
							' - <a href="' . $result['link'] . '" target="_blank"><medium>' . $result['message'] . '</medium></a> ' . 
							($result['thumbnail'] ? '<font color="green"><i>pic</i></font>' : ''); 
						?>
					</div>
				<?php }
			} else { ?>
					<p>No result found ... </p>
			<?php } ?>
					</div>
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

		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/footer.frontend.php'); ?>
	    <br>
	</body>
</html>