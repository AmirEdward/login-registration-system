<?php
//add our database connection script
require_once 'resource/Database.php';
require_once 'resource/utilities.php';

if (isset($_SESSION['username'])) {
    redirect('index','You are already a member');
}


//process the form
if(isset($_POST['signupBtn'])){
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form validation
    $required_fields = array('email', 'username', 'password');

    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('username' => 4, 'password' => 6);

    if(empty($form_errors)){
        //call the function to check minimum required length and merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        //email validation / merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_email($_POST));
    }

     //collect form data and store in variables
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (checkDuplicate('users','username', $username, $db)) {
        $result = flash_message('This username is already exist');
    }
    else if (checkDuplicate('users','email', $email, $db)) {
        $result = flash_message('This email is already exist');
    }
    //check if error array is empty, if yes process form data and insert record
    else if(empty($form_errors)){

        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try{

            //create SQL insert statement
            $sqlInsert = "INSERT INTO users (username, email, password, join_date)
              VALUES (:username, :email, :password, now())";

            //use PDO prepared to sanitize data
            $statement = $db->prepare($sqlInsert);

            //add the data into the database
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

            //check if one new row was created
            if($statement->rowCount() == 1){
                
                $result = "<script type=\"text/javascript\"> 
                                swal({
                                      title: \"Congratulations $username!\",
                                      text: \"Registration Successful\",
                                      type : 'success',
                                      showConfirmButton: false });

                                      setTimeout(function(){
                                        window.location.href = 'index.php';
                                      }, 3000);
                           </script>";
            }
        }catch (PDOException $ex){
            $result = flash_message('An error occurred: '.$ex->getMessage());
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = flash_message('There was 1 error in the form');
        }else{
            $result = flash_message("There were " .count($form_errors). " errors in the form") . '<br>';
        }
    }

}