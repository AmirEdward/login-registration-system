<?php
require_once 'resource/Database.php';
require_once 'resource/utilities.php';

if (isset($_SESSION['id']) /*|| isset($_GET['user_identity']) && !isset($_POST['updateProfileBtn'])*/) {
	if (isset($_GET['user_identity'])) {
		$url_encoded_id = $_GET['user_identity'];
		$decode_id = base64_decode($url_encoded_id);
		$user_id_array = explode('encodeuserid', $decode_id);
		@$id = $user_id_array[1];
	}else{
		$id = $_SESSION['id'];
	}

	$sql = 'SELECT * FROM users WHERE id = :id';
	$statement = $db->prepare($sql);
	$statement->execute(array(':id' => $id));

	if ($statement->rowCount()) {
		$row = $statement->fetch();
		$username = $row['username'];
		$email = $row['email'];
		$date_joined = strftime("%d %b , %Y", strtotime($row['join_date']));
	}

	@$user_pic = 'uploads/'.$username.'.jpg';
	$default = 'uploads/default.jpg';
	if (file_exists($user_pic)) {
		$profile_pic = $user_pic;
	}else {
		$profile_pic = $default;
	}

	$encode_id = base64_encode("encodeuserid{$id}");
	}
 	if(isset($_POST['updateProfileBtn'])){
		$form_errors = array();

		$required_fields = array('email', 'username');

		$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

		if(empty($form_errors)){
			$fields_to_check_length = array('username' => 4);
			$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
			$form_errors = array_merge($form_errors, check_email($_POST));
		}

		// validate if the image is valid extension

		isset($_FILES['avatar']['name']) ? $avatar = $_FILES['avatar']['name'] : $avatar = null;

		if ($avatar != null) {
			$form_errors = array_merge($form_errors, isValidImage($avatar));

		}

		$username = $_POST['username'];
		$email = $_POST['email'];
		$hidden_id = $_POST['hidden_id'];
		if (checkDuplicate('users', 'username', $username, $db) && $username !== $row['username']) {
			
			$result = flash_message('This username is already exist');
			
		}else if (checkDuplicate('users', 'email', $email, $db) && $email !== $row['email']) {
			
			$result = flash_message('This email is already exist');
			
		}
		else if (empty($form_errors)) {
			try {
				
				$sql = 'UPDATE users SET username = :username, email = :email WHERE id = :id';
				$statement = $db->prepare($sql);
				$statement->execute(array('username' => $username, ':email'=> $email, ':id' => $id));

				if ($statement->rowCount()) {
					$result = "<script type=\"text/javascript\"> 
									swal({
										  title: \"Updated\",
										  text: \"Your profile has been updated successfully\",
										  type : 'success',
										  confirmButtonText: 'ok' });

								</script>";
				}else {
					$result = "<script type=\"text/javascript\"> 
									swal({
										  title: \"Nothing Happened!\",
										  text: \"You have not made any changes\",
										  type : 'info',
										  confirmButtonText: 'ok' });

								</script>";
				}
			} catch (PDOException $e) {
				$result = flash_message('An Error Occurred : ' . $e->getMessage());
			}
		}else if (count($form_errors) == 1) {
			$result = flash_message('There was 1 error');
		}else {
			$result = flash_message('There were '.count($form_errors).' errors in');
		}
	}
?>