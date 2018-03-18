<?php

$page_title = 'User Authentication - Register Page';
include_once 'partials/header.php';
include_once 'partials/parseSignup.php';
 ?>
<div class="container">
    <section class="col col-lg-7">
        <h2>Registration Form</h2><hr>
        <div>
            <?php if(isset($result)) echo $result; ?>
            <?php if(!empty($form_errors)) echo show_errors($form_errors); ?> 
        </div>
        <div class="clearfix"></div>
        <form action="" method="post">
        <div class="form-group">
            <label for="emailField">Email</label>
            <input type="text" class="form-control" name="email" id="emailField" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label for="usernameField">Username</label>
            <input type="text" class="form-control" name="username" id="usernameField" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="passwordField">Password</label>
            <input type="password" class="form-control" name="password" id="passwordField" placeholder="Enter Password">
          </div>
          <button name="signupBtn" type="submit" class="btn btn-primary pull-right">Signup</button>
        </form>
    </section>
</div>
<?php include_once 'partials/footer.php'; ?>
