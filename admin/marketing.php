<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if (isset($_POST['postid']) && isset($_POST['postname']) && isset($_POST['groupid'])) {
	global $db;

	$newPostAds = array(
		'name' => htmlentities($_POST['postname']),
		'group' => htmlentities(($_POST['groupid'])),
		'entityId' => htmlentities($_POST['postid']),
		'entityType' => FacebookEntityType::POST,
		'category' => AdrinaCategory::FACEBOOKADS,
	);

	$affected = $db->insert($newPostAds, 'facebook_entity');

	if (!$affected) {
		$errors = "Unable to add post ads to database";
	} else {
		$success = "{$_POST['postname']} added successfully";
	}
} elseif ($_GET['delete']) {
	$affected = $db->delete('facebook_entity', "entityId = ?", array($_GET['delete']));

	if ($affected) {
		$success = "Ad Post deleted";
	} else {
		$errors = "Unable to delete Ad Post";
	}
}

$posts = getFacebookAdPosts();
$groups = getFacebookGroups();
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/admin/frontend/header.frontend.php'); ?>

<?php
if ($success) { ?>
	<div class="row">
		<div class="small-8 large-centered columns">
			<div data-alert class="alert-box success">
			  	<?php echo $success; ?>
				<a href="#" class="close">&times;</a>
			</div>
		</div>
	</div>
<?php }
?>

<?php
if ($errors) { ?>
	<div class="row">
		<div class="small-8 large-centered columns">
			<div data-alert class="alert-box alert">
			  	<?php echo $errors; ?>
				<a href="#" class="close">&times;</a>
			</div>
		</div>
	</div>
<?php }
?>

<div class="row">
	<div class="large-12 large-centered columns">
		<div class="row">
			<div class="large-8 large-centered columns">
				<form id="add-group" action="/admin/marketing.php" method="POST">
				  	<fieldset>
					    <legend>Add Facebook Ads</legend>

					    <div class="row">
					      	<div class="large-8 large-centered columns">
							    <select id="customDropdown" name="groupid">
								    <?php
								    	foreach ($groups as $group_id => $group_name) {
								    		echo "<option value='{$group_id}'>{$group_name}</option>";
								    	}
								    ?>
								</select>
							</div>
						</div>

					    <div class="row">
					      	<div class="large-8 large-centered columns">
					        	<input type="text" name="postid" placeholder="Enter Facebook POST ID here">
					      	</div>
					    </div>
					    
					    <div class="row">
					      	<div class="large-8 large-centered columns">
					        	<input type="text" name="postname" placeholder="Enter Facebook POST nickname here">
					      	</div>
					    </div>

					    <div class="row">
					      	<div class="large-3 right columns">
					        	<a href="#" id="add-group-button" class="button radius small">Add</a>
					      	</div>
					    </div>
				    </fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="small-12 large-centered columns">
		<div class="row">
			<div class="large-8 large-centered columns">
				<div class="panel">
					<ul class="no-bullet">
						<li><span class="radius label">Facebook Ads Post Stats</span></li>
						<?php 
							foreach ($posts as $post) {
								$link = "https://www.facebook.com/" . $post['group'] . '/posts/' . $post['entityId'];

								echo "<li><span class=\"label\">{$post['entityId']}</span> - {$post['name']} - 
								<a href=\"{$link}\" target=\"_blank\">LINK</a> | 
								<a href=\"/admin/marketing.php?delete={$post['entityId']}\">DELETE</a>
								</li>";
							}
						?>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/admin/frontend/footer.frontend.php'); ?>