<?php
session_start();
require('functions/user.php');

if(ISSET($_POST['save'])){
	$file_category = $_POST['category'];
	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$file_temp = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'] / 1024 ; //convert from byte to kilobyte
	$location = "database/files/".$file_name;
	$date = date("y-m-d",time());

	$file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); //get file extension
	$allowed_extension = array('jpg','png','gif','jpeg','mp4','mpg','mpeg','mp3','doc','docx','pdf','txt');

	if (! in_array($file_extension, $allowed_extension)) { //check if the extension is in the array of allowed extension
		$_SESSION['error'] =  "File fomat not supported";
		header('location: dashboard.php');
		exit();

	} elseif ($file_size > 2000000) { //check if file size is greater than 2MB
		$_SESSION['error'] =  "File too large, MAX: 2MB";
		header('location: dashboard.php');
		exit();
	} elseif (file_exists('database/files/'.$file_name)) { //check if file already exist
		$_SESSION['error'] =  "File exist";
		header('location: dashboard.php');
		exit();
	}
		
	if(move_uploaded_file($file_temp, $location)){ //move file and create file object
			$file = [
			    'name'=>$file_name,
			    'size'=>(int)$file_size,
			    'category'=>$file_category,
			    'type'=>$file_type,
			    'uploaded_by'=>$_SESSION['fullname'],
			    'total_download'=>0,
			    'date_uploaded'=>$date,
			    'email'=>$_SESSION['email']
			];
			save_file($file); //save file to database
			$_SESSION['message'] =  "File Uploaded";
			header('location: dashboard.php');
		}
	}
?>