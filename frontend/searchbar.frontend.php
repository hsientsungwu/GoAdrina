<div class="top-search-bar">
	<form id="social-search" action="/search/" type="GET">
		<div class="row">
			<div class="small-6 large-centered columns">
				<h3>Go Adrina! <i>Social Search Engine</i></h3>
			</div>
		</div>
		<div class="row">
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