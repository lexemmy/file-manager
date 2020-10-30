<?php
require('functions/db_config.php');
if(isset($_GET['file']))
{
    $filename = $_GET['file'];
    
    $sql = "delete from file where name='$filename'"; //delete from database
    $res = $conn->query($sql);
    unlink("files/" . $filename); //delete file
    header("location: dashboard.php");
    exit();
}
else{
	header("location: index.php");
}