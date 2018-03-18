<?php 
$page_title = 'User Authentication - Password Reset';
include_once 'partials/header.php';
include_once 'partials/parsePasswordReset.php';
 ?>
<div class="container">
    <section class="col col-lg-7">
        <h2>Reset Password Form</h2><hr>
        <div>
        <?php if(isset($result)) echo $result;
			  if(!empty($form_errors)) {
					echo str_replace(
								array('new_password', 'confirm_password', 'email'),
								array('New Password', 'Confirm Password', 'Email'), 
								show_errors($form_errors)); 
				} ?> 
        </div>
        <form action="" method="post">
          <div class="form-group">
            <label for="emailField">Email</label>
            <input type="text" class="form-control" name="email" id="emailField" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label for="passwordField">New Password</label>
            <input type="password" class="form-control" name="new_password" id="passwordField" placeholder="Enter New Password">
          </div>
          <div class="form-group">
            <label for="passwordField">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="passwordField" placeholder="Confirm New Password">
          </div>
          <button name="passwordResetBtn" type="submit" class="btn btn-primary pull-right">Reset Password</button>
        </form>
    </section>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>