<html>
	<head>
		<title>Go Adrina! - Social Search Engine</title>
		<meta property="og:url" content="http://adrina.latteblog.com"/>
		<meta property="og:title" content="Go Adrina! - Social Search Engine"/>
		<meta property="og:site_name" content="Go Adrina! - Social Search Engine"/>
		<meta property="og:description" content="Adrina is a online social search engine that cron on Facebook posts from various 
		Belizean Buy & Sell groups which gives the users the ability to perform search and direct link to the Facebook page. Adrina is a free service 
		developed by @HsienTsungWu who is currently Software Engineer at Qgiv"/>
		<meta property="og:image" content="http://adrina.latteblog.com/img/goadrina_favicon.png"/>

		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/header.frontend.php'); ?>

  		<script src="/js/foundation/foundation.js"></script>
  		<script src="/js/foundation/foundation.orbit.js"></script>
	</head>
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/frontend/searchbar.frontend.php"); ?>
		<div class="orbit row" styles="min-height: 500px;">
			<div class="small-8 large-centered columns">
				<ul data-orbit id="featured">
				  	<li>
				    	<img src="https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-ash4/1001370_10200397335999031_940214363_n.jpg" />
				    	<div class="orbit-caption">...</div>
				  	</li>
				  	<li>
				    	<img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-prn1/s403x403/1016884_173318742847125_1520328722_n.jpg" />
				    	<div class="orbit-caption">...</div>
				  	</li>
				  	<li>
				    	<img src="https://sphotos-a-atl.xx.fbcdn.net/hphotos-ash3/36577_10200967641386020_2052646944_n.jpg" />
				    	<div class="orbit-caption">...</div>
				  	</li>
				</ul>
			</div>
		</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/footer.frontend.php'); ?>
		<br>
	    <script>
		  	$(document).foundation();
		</script>
	</body>
</html>