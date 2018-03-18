<?php

$page_title = 'User Authentication - Homepage';
include_once 'partials/header.php';

 ?>

    <div class="container">

      <div class="flag">
        <h1>User Authentication System</h1>
        <p class="lead"></p>
        <?php if(!isset($_SESSION['username'])): ?>

		<P class="lead">You are currently not signed in <a href="login.php">Login</a> ,, Not yet a member? <a href="signup.php">Signup</a> </P>

		<?php else: ?>
		<p class="lead">You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a><br>
		<a href="contact.php">Contact Us</a><br>
		<a href="resetpassword.php">Change your password</a>
		 </p>
		<?php endif;
			if (!empty($_SESSION['message'])) {
				echo "<p class='lead'>".$_SESSION['message']."</p>";
				unset($_SESSION['message']);
			}
			?>
      </div>

    </div>

  <?php include_once 'partials/footer.php'; ?>

</body>
</html>