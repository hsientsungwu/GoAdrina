<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

global $db;

$groups = getFacebookGroups();
$lastCronTime = $db->fetchCell("SELECT cron_time FROM log_crons ORDER BY id DESC LIMIT 0, 1");
$totalPosts = $db->fetchCell("SELECT count(id) FROM facebook_posts");
$totalUsers = $db->fetchCell("SELECT count(id) FROM facebook_accounts");

?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/admin/frontend/header.frontend.php'); ?>

<div class="row">
	<div class="large-12 columns">
		<div class="row">
			<div class="large-5 large-centered columns">
				<div class="panel">
					<ul class="no-bullet">
						<li><span class="radius label">Stats</span></li>
						<li><span class="radius secondary label">Last Cron Time:</span> <?php echo $lastCronTime; ?></li>
						<li><span class="radius secondary label">Total Posts Added:</span><?php echo $totalPosts; ?></li>
						<li><span class="radius secondary label">Total Users Added:</span><?php echo $totalUsers; ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<div class="row">
			<div class="large-5 large-centered columns">
				<div class="panel">
					<ul class="no-bullet">
						<li><span class="radius label">Facebook Groups Stats</span></li>
						<?php
							foreach ($groups as $group_id => $group) {
								$numPosts = $db->fetchCell("SELECT count(id) FROM facebook_posts WHERE source = ?", array($group_id));

								echo "<li><span class=\"radius secondary label\">{$group}:</span>{$numPosts}</li>";
							}
						?>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
		
<?php include($_SERVER['DOCUMENT_ROOT'] . '/admin/frontend/footer.frontend.php'); ?>