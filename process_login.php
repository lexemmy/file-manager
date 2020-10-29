<?php
session_start();
require('functions/alert.php');
require('functions/user.php');

$errorCount = 0;  //initiate error count

$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++; //check if email is empty
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++; //check if password is empty

if($errorCount > 0){
    $_SESSION['error'] =  "You have an error in your form"; 
    header("Location: login.php");
} else {
        $currentUser = find_user($email); //check if user exist
        if($currentUser){
          //check the user password.
            $userString = file_get_contents("database/users/".$currentUser->email . ".json");
            $userObject = json_decode($userString);
            $passwordFromDB = $userObject->password;

            $passwordFromUser = password_verify($password, $passwordFromDB);
            
            //check if password match
            if($passwordFromDB == $passwordFromUser){
                //set sessions and redicrect to dashboard
                
                $_SESSION['email'] = $userObject->email;
                $_SESSION['fullname'] = $userObject->fullname;
                $_SESSION['user_id'] = $userObject->id;
                
                header('location: dashboard.php');
                exit();
            }
          
        }        
        
    $_SESSION['error'] =  "Invalid username or password";
    header("location: login.php");
    exit();
}
