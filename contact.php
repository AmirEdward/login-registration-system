<?php
$page_title = 'User Authentication - Contact Us Page';
include_once 'partials/header.php';
include_once 'partials/parseContactUs.php';
 ?>

<div class="container">
    <section class="col col-lg-7">
        <h2>Contact Form</h2><hr>
        <div>
            <?php if(isset($result)) echo $result; ?>
            <?php if(!empty($form_errors)) echo show_errors($form_errors); ?> 
        </div>
        <div class="clearfix"></div>
        <form action="" method="post">
        <div class="form-group">
            <label for="usernameField">Full Name</label>
            <input type="text" class="form-control" name="username" id="usernameField" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label for="emailField">Email</label>
            <input type="text" class="form-control" name="email" id="emailField" placeholder="Enter Email">
        </div>
        <div class="form-group">
            <label for="messageField">Message</label>
            <textarea class="form-control" name="message" id="messageField" placeholder="Enter Your Message Here" cols="5" rows="10"></textarea>
        </div>
          <button name="submitBtn" type="submit" class="btn btn-primary pull-right">Send Message</button>
        </form>
    </section>
</div>

<?php include_once 'partials/footer.php';