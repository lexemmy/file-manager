<?php session_start();
require('functions/user.php');
require('functions/db_config.php'); 
    
$errorCount = 0;   //initiate error count

//get data from post request
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//Data validation
if (!preg_match("/^[a-zA-Z]*$/",$fullname) || (strlen($fullname) < 2 ) ) {      //fullname regex to match only letters
    $_SESSION['error'] = "*Name must be more than two characters and must contain only letters";
    $errorCount++;
    } else {
           $fullname = test_input($_POST["fullname"]);
           }

if (!preg_match("/^[a-zA-Z0-9\.]*@[a-z\.]{1,}[a-z]*$/",$email) || $email=='') {     //email regex check
    $_SESSION['error'] =  "*Enter a valid email"; 
    $errorCount++;
    } else {
           $email = test_input($_POST["email"]);
           }

if ($password != $confirm_password) {
    $_SESSION['error'] =  "*Password do not match"; 
    $errorCount++;
    } else if ( strlen($password) < 4) {
              $_SESSION['error'] =  "*Password must be at least 4 characters"; 
              $errorCount++;
              } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
              }


if($errorCount > 0){
    header("Location: register.php"); //if there is an error, redirect back to register page
} else {

    //Check if the user already exists.
    $userExists = find_user($email);

    if($userExists){
        $_SESSION["error"] = "Registration Failed, User already exits ";
        header("Location: register.php");
        exit();
    }
        
    //save in the database;
    if (save_user($fullname, $email, $password)) {
      $_SESSION["message"] = "Registration Successful, you can now login " . $first_name;
      header("Location: login.php");
      exit();
    } else {
      $_SESSION["error"] = "An error occured, please try again";
      header("Location: register.php");
    }


}

