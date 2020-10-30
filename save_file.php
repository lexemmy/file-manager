<?php
session_start();
require('functions/user.php');

if(ISSET($_POST['save'])){
	$file_category = $_POST['category'];
	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$file_temp = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'] / 1024 ; //convert from byte to kilobyte


	$file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); //get file extension
	$allowed_extension = array('jpg','png','gif','jpeg','mp4','mpg','mpeg','mp3','doc','docx','pdf','txt');

	if (! in_array($file_extension, $allowed_extension)) { //check if the extension is in the array of allowed extension
		$_SESSION['error'] =  "File fomat not supported";
		header('location: dashboard.php');
		exit();

	} elseif ($file_size > 3000) { //check if file size is greater than 3MB
		$_SESSION['error'] =  "File too large, maximum allowed size is 3MB";
		header('location: dashboard.php');
		exit();
	} elseif (file_exists('files/'.$file_name)) { //check if file already exist
		$_SESSION['error'] =  "File exist";
		header('location: dashboard.php');
		exit();
	}
		
	if(move_uploaded_file($file_temp, "files/".$file_name)){ //move file 

		$uploaded_by = $_SESSION['fullname'];
		$email = $_SESSION['email'];
		$total_download = 0;
		if (save_file($file_name, $file_size, $file_category, $file_type, $uploaded_by, $total_download, $email)) { //save to database
			$_SESSION['message'] =  "File Uploaded";
			header('location: dashboard.php');
		} else {
			$_SESSION['error'] =  "An error occured, pleasse try again";
			header('location: dashboard.php');
			}
			
		}
	}
?>