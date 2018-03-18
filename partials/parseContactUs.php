<?php

require_once 'resource/database.php';
require_once 'resource/utilities.php';
require_once 'resource/session.php';

// if(!isset($_SESSION['username'])){
// 	redirect('index','You have to log in first');

// }

if (isset($_POST['submitBtn'])) {
	$form_errors = array();
	$required_fields = array('email', 'username', 'message');
	$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
	if (empty($form_errors)) {
		$form_errors = array_merge($form_errors, check_min_length(array('username' => 4, 'message' => 20)));
		$form_errors = array_merge($form_errors, check_email($_POST));
	}

	if (empty($form_errors)) {
		$sender_name = $_POST['username'];
		$sender_email = $_POST['email'];
		$sender_message = $_POST['message'];
		try {
			$sql = "INSERT INTO feedback (sender_name, sender_email, message, send_date) VALUES (:sender_name, :sender_email, :sender_message, now())";
			$statement = $db->prepare($sql);
			$statement->execute(array(':sender_name'=>$sender_name,
			 						  ':sender_email'=>$sender_email,
			 						  ':sender_message'=>$sender_message));
			if ($statement->rowCount()) {
				$result = "<script type=\"text/javascript\"> 
                                swal({
                                      title: \"Thank You\",
                                      text: \"Your message has been sent successfully\",
                                      type : 'success',
                                      confirmButtonText: 'OK'});
                           </script>";
			}else{
				echo 'error';
			}
		} catch (PDOException $e) {
			$result = flash_message(" An error occurred: ".$e->getMessage());
		}
	}else {
		 if(count($form_errors) == 1){
            $result = flash_message("There was 1 error in the form");
        }else{
            $result = flash_message(" There were " .count($form_errors). " errors in the form ");
        }
	}
}

?>