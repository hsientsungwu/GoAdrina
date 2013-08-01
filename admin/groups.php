<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if (isset($_POST['id']) && isset($_POST['name'])) {
	global $db;

	$newGroup = array(
		'id' => htmlentities($_POST['id']),
		'name' => htmlentities($_POST['name']),
	);

	$affected = $db->insert($newGroup, 'facebook_groups');

	if (!$affected) {
		$errors = "Unable to add group to database";
	} else {
		$success = "{$_POST['name']} added successfully";
	}
}

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
				<form id="add-group" action="/admin/groups.php" method="POST">
				  	<fieldset>
					    <legend>Add Facebook Group</legend>

					    <div class="row">
					      	<div class="large-8 large-centered columns">
					        	<input type="text" name="id" placeholder="Enter Facebook ID here">
					      	</div>
					    </div>
					    <div class="row">
					      	<div class="large-8 large-centered columns">
					        	<input type="text" name="name" placeholder="Enter Facebook name here">
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
	<div class="large-12 large-centered columns">
		<div class="row">
			<div class="large-8 large-centered columns">
				<div class="panel">
					<ul class="no-bullet">
						<li><span class="radius label">Facebook Groups Stats</span></li>
						<?php
							foreach ($groups as $group_id => $group) {
								echo "<li>
									<span class=\"radius secondary label\">{$group_id} - {$group}</span>
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