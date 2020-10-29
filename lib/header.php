<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
   .header {max-width: 900px;}
    </style>

</head>
<body style="background-color: #d8d8d8;">
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="index.php">File Manager</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-light" href="index.php">Home</a>
            <a class="p-2 text-light" href="dashboard.php">Dashboard</a>
            <a class="p-2 text-light" href="private.php">Private Files</a>
            <?php if(!isset($_SESSION['user_id'])){ ?>
        
                <a class="p-2 text-light" href="login.php">Login</a> 
                <a class="p-2 text-light" href="register.php">Register</a> 
                
            <?php }else{ ?> 
                <a class="p-2 text-light" href="logout.php">Logout</a>
            <?php } ?>
          
        </nav>
       
    </div>