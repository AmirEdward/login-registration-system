<?php
require_once 'resource/database.php';
require_once 'resource/utilities.php';


if (isset($_POST['passwordResetBtn'])) {
	$form_errors = array();

	$required_fields = array('email', 'new_password', 'confirm_password');

	$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

	if(empty($form_errors)){
	$form_errors = array_merge($form_errors, check_min_length(array('new_password' => 6, 'confirm_password' => 6)));

	$form_errors = array_merge($form_errors, check_email($_POST));
	}


	if (empty($form_errors)) {
		$email = $_POST['email'];
		$password1 = $_POST['new_password'];
		$password2 = $_POST['confirm_password'];

		if ($password1 != $password2) {
			$result = flash_message('"New Password" and "Confirm Password" dosen\'t match');
		}else {
			
			try {
				$sql = "SELECT * FROM users WHERE email = :email";
				$statement = $db->prepare($sql);
				$statement->execute(array(':email' => $email));
				if ($statement->rowCount()) {
					$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

					$sql = "UPDATE users SET password = :password WHERE email = :email";
					$statement = $db->prepare($sql);
					$statement->execute(array(':password' => $hashed_password, ':email' => $email));
					
					$result = "<script type=\"text/javascript\"> 
                                swal({
                                      title: \"Updated!\",
                                      text: \"Your password has been successfully reset\",
                                      type : 'success',
                                      showConfirmButton: false });

                                      setTimeout(function(){
									  	window.location.href = 'index.php';
									  }, 3000);
                       		   </script>";
				}else{
					$result = "<script type=\"text/javascript\"> 
                                swal({
                                      title: \"Error!\",
                                      text: \"This Email is not exist in our database\",
                                      type : 'error',
                                      showConfirmButton: true });
                       		   </script>";
					
				}

			} catch (PDOException $e) {
				echo 'unable to reset password <br>'.$e->getMessage();
			}
		}
	}else if(count($form_errors) == 1){
		$result = flash_message('There was 1 error in the form');
	}else {
		$result = flash_message('There were '.count($form_errors).' errors in the form');
	}
}