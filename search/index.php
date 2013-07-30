<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');
$start = microtime(true);

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

if ($_GET['view'] == 'grid') {
	$view = 'grid';
} else {
	$view = 'list';
}
?>

<html>
	<head>
		<title>Go Adrina! - Social Search Engine</title>
		<meta name="viewport" content="width=device-width" />
		<meta property="og:url" content="http://www.goadrina.com"/>
		<meta property="og:title" content="Go Adrina! - Social Search Engine"/>
		<meta property="og:site_name" content="Go Adrina! - Social Search Engine"/>
		<meta property="og:description" content="Adrina is a online social search engine that cron on Facebook posts from various 
		Belizean Buy & Sell groups which gives the users the ability to perform search and direct link to the Facebook page. Adrina is a free service 
		developed by @HsienTsungWu who is currently Software Engineer at Qgiv"/>
		<meta property="og:image" content="/img/goadrina_favicon.png"/>

		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/header.frontend.php'); ?>
	</head>
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/frontend/searchbar.frontend.php"); ?>

		<div class="results-container">
			<div class="row">
				<div class="large-12 large-centered columns">
					<dl class="sub-nav">
						<dt>Views:</dt>
						<dd class="<?php if ($view =='list') echo 'active'; ?>"><a href="/search/?k=<?php echo $key . '&page=' . $current . '&view=list'; ?>">List View</a></dd>
						<dd class="<?php if ($view =='grid') echo 'active'; ?>"><a href="/search/?k=<?php echo $key . '&page=' . $current . '&view=grid'; ?>">Grid View</a></dd>
					</dl>
				</div>
			</div>

			<div class="row time-result">
				<div class="large-4 large-centered columns">
				<?php
					if (count($results['total'])) {
						$total_time = microtime(true) - $start;
						$total_time = number_format($total_time, 5);
						echo "<i>About {$results['total']} results ({$total_time} seconds) </i>";
					}	
				?>
				</div>
			</div>

			<?php 
			if ($view == 'list') { ?>
				<div class="row">
					<div class="large-12 large-centered columns">
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
								<div class="panel">No result found ... </div>
						<?php } ?>
					</div>
				</div>
			<?php
			} else { ?>
				<div class="row">
					<div class="large-12 large-centered columns">
						<?php 
							if (count($results['data'])) {

								foreach ($results['data'] as $index => $result) {

									$thumbnail = (strlen($result['thumbnail']) > 1 ? $result['thumbnail'] : '/img/nophoto.jpg');

									echo "<div class=\"large-4 columns\"><a href=\"" . $result['link'] . "\"><div class=\"panel text-center post-box\">
										<span class=\"label\">" . substr($result['message'],0, 30) . "..." . "</span>
										<img src=\"" . $thumbnail . "\" /></div></a></div>";

								}
							}
						?>
					</div>
				</div>
			<?php
			} ?>
		</div>
		<div class="pagination-centered">
		  	<ul class="pagination">
		  		<li class="arrow <?php echo ($current <= 1 ? 'unavailable' : ''); ?>"><a href="/search/?k=<?php echo $key; ?>&page=<?php echo ($current-1 >= 1 ? $current-1 : $current) . '&view=' . $view; ?>">&laquo;</a></li>
		  		<?php
		  			for($i=1; $i <= $pages; $i++) {
		  				$class = ($i == $current ? 'current unavailable' : '');
		  				echo '<li class="' . $class . ' "><a href="/search/?k=' . $key . '&page=' . $i . '&view=' . $view . ' ">' . $i . '</a></li>';
		  			}
		  		?>
			    
			    <li class="arrow <?php echo ($current >= $page ? 'unavailable' : ''); ?>"><a href="/search/?k=<?php echo $key; ?>&page=<?php echo ($current+1 <= $pages ? $current+1 : $current). '&view=' . $view; ?>">&raquo;</a></li>
		  	</ul>
		</div>

		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/footer.frontend.php'); ?>
	    <br>
	</body>
</html>