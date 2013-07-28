<html>
	<head>
		<title>Go Andrina!</title>
		<link rel="stylesheet" href="css/normalize.css" />
  		<link rel="stylesheet" href="css/foundation.css" />
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
  		<script src="/js/custom.modernizr.js"></script>
  		<script src="/js/home.js"></script>
  		<script src="/js/foundation/foundation.js"></script>
  		<script src="/js/foundation/foundation.orbit.js"></script>
	</head>
	<body>
		<br><br>
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/frontend/searchbar.frontend.php"); ?>
		<div class="orbit row">
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
		<div class="row"><hr>
			<div class="small-3 large-centered columns">
	            ©2013 Copyright Go Adrina!
	        </div>
	    </div>
	    <script>
		  	$(document).foundation();
		</script>
	</body>
</html>