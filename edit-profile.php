<?php
$page_title = 'User Authentication - Edit Profile';
include_once 'partials/header.php';
include_once 'partials/parseProfile.php';
?>

<div class="container">
	<section class="col col-lg-7">
		<h2>Edit Profile</h2>
		<div>
			<?php if(isset($result)) echo $result;
			if(!empty($form_errors)) echo show_errors($form_errors); ?>
		</div>

		<div class="clearfix"></div>

		<?php if(!isset($_SESSION['username'])): ?>
			<p class="lead">You are not authorized to view this page<br>
			Please <a href="login.php">Login</a> to continue<br> 
			Not yet a member? <a href="signup.php">Sign Up</a></p>
		<?php else: ?>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="form-group">
					<label for="emailField">Email</label>
					<input type="text" name="email" class="form-control" id="emailField" value="<?php if(isset($email)) echo $email; ?>">
				</div>
				<div class="form-group">
					<label for="usernameField">Username</label>
					<input type="text" name="username" class="form-control" id="usernameField" value="<?php if(isset($username)) echo $username; ?>">
				</div>
				<div class="form-group">
					<label for="fileField">Avatar</label>
					<input type="file" name="avatar" id="usernameField">
				</div>

				<input type="hidden" name="hidden_id" value="<?php if(isset($id)) echo $id; ?>">
				<button type="submit" name="updateProfileBtn" class="btn btn-primaru pull-right">Update Profile</button>
			</form>
		<?php endif; ?>
	</section>
</div>
<?php include_once 'partials/footer.php';