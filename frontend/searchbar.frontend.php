<div class="top-search-bar">
	<form id="social-search" action="/search/" type="GET">
		<div class="row logo">
			<div class="small-6 large-centered columns">
				<a href="/"><img src="/img/goadrina_logo.png" /></a>
			</div>
		</div>

		<div class="row search">
			<div class="small-8 large-centered columns">
				<div class="row collapse">
			        <div class="small-10 columns">
			          	<input type="text" name="k" placeholder="Start the social shopping journey ... " value="<?php echo ($_GET['k'] ? $_GET['k'] : ''); ?>">
			        </div>
			        <div class="small-2 columns">
			          	<a href="#" class="button prefix submit">Search</a>
			        </div>
			    </div>
			</div>
			</div>
	</form>
</div>