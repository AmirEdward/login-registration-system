<?php 
require_once 'resource/Database.php';
require_once 'resource/utilities.php';

if (isset($_SESSION['username'])) {
	redirect('index','You are currently logged in as '.$_SESSION['username']);
}

if (isset($_POST['loginBtn'])) {
	// array to hold errors
	$form_errors = array();

	//validate inputs

	$required_fields = array('username', 'password');

	$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

	if (empty($form_errors)) {
		$user = $_POST['username'];
		$password = $_POST['password'];

		isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = '';

		// check if user exist in the database

		$sqlquery = 'SELECT * FROM users WHERE username = :username';
		$statement = $db->prepare($sqlquery);
		$statement->execute(array(':username' => $user));
		if($statement->rowCount()<1){
			$result = flash_message('Invalid username or password');
		}

		while ($row = $statement->fetch()) {
			$id = $row['id'];
			$username = $row['username'];
			$hashed_password = $row['password'];
			if (password_verify($password, $hashed_password)) {
				$_SESSION['id'] = $id;
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $row['email'];

				$fingerprint = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
				$_SESSION['last_active'] = time();
				$_SESSION['fingerprint'] = $fingerprint;

				if ($remember === "yes") {
					rememberMe($id);
				}

				$result = "<script type=\"text/javascript\"> 
								swal({
									  title: \"Welcome Back $username!\",
									  text: \"You are being logged in\",
									  type : 'success',
									  timer: 5500,
									  showConfirmButton: false });

									  setTimeout(function(){
									  	window.location.href = 'index.php';
									  }, 3000);

							</script>";
			} else {
				$result = "<script type=\"text/javascript\"> 
								swal({
									  title: \"OOPS!\",
									  text: \"Invalid username or password\",
									  type : 'error',
									  confirmButtonText: 'ok' });

							</script>";
			}
		}

	} else if(count($form_errors) == 1){
		$result = flash_message('There was 1 error in the form');
	}else {
		$result = flash_message('There were '.count($form_errors).' errors in the form');
	}

}
