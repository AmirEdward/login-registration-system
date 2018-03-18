<?php 

$page_title = 'User Authentication - Login';
include_once 'partials/header.php';
include_once 'partials/parseLogin.php';
?>
<div class="container">
	<section class="col col-lg-7">
		<h2>Login Form</h2><hr>
		<div>
			<?php if(isset($result)) echo $result;
			if(!empty($form_errors)) echo show_errors($form_errors); ?> 
		</div>
		<div class="clearfix"></div>
		<form action="" method="post">
		  <div class="form-group">
		    <label for="usernameField">Username</label>
		    <input type="text" class="form-control" name="username" id="usernameField" placeholder="Enter Username">
		  </div>
		  <div class="form-group">
		    <label for="passwordField">Password</label>
		    <input type="password" class="form-control" name="password" id="passwordField" placeholder="Enter Password">
		  </div>
		  <div class="checkbox">
		    <label><input name="remember" value="yes" type="checkbox"> Remember Me </label>
		  </div>
		  <a href="resetpassword.php">Forgot Password?</a>
		  <button name="loginBtn" type="submit" class="btn btn-primary pull-right">Sign in</button>
		</form>
	</section>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>