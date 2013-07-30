<div class="top-search-bar">
	<form id="social-search" action="/search/" type="GET">
		<div class="row logo">
			<div class="large-12 columns">
				<div class="row">
					<div class="large-6 large-centered text-center columns">
						<a href="/"><img src="/img/goadrina_logo.png" /></a>
					</div>
				</div>
			</div>
		</div>

		<div class="row search">
			<div class="large-12 large-centered columns">
				<div class="row collapse">
			        <div class="large-6 large-offset-2 columns">
			          	<input type="text" name="k" placeholder="Start the social shopping journey ... " value="<?php echo ($_GET['k'] ? $_GET['k'] : ''); ?>">
			        </div>
			        <div class="large-2 columns">
			          	<a href="#" class="button prefix submit">Search</a>
			        </div>
			        <div class="large-2 columns"></div>
			    </div>
			</div>
			</div>
	</form>
</div>