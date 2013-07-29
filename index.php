<html>
	<head>
		<title>Go Adrina! - Social Search Engine</title>
		<meta property="og:url" content="http://www.goadrina.com"/>
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
				    	<img src="/img/featured_frame.png" />
				    	<div class="orbit-caption">Email hwu1986@gmail.com for more information about featured ads</div>
				  	</li>
				  	<li>
				    	<img src="/img/featured_frame.png" />
				    	<div class="orbit-caption">Email hwu1986@gmail.com for more information about featured ads</div>
				  	</li>
				  	<li>
				    	<img src="/img/featured_frame.png" />
				    	<div class="orbit-caption">Email hwu1986@gmail.com for more information about featured ads</div>
				  	</li>
				</ul>
			</div>
		</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/frontend/footer.frontend.php'); ?>
		</br>
	    <script>
		  	$(document).foundation();
		</script>
	</body>
</html>