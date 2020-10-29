<?php
if(isset($_GET['file']))
{
    $filename = $_GET['file'];
    unlink("database/file_data/" . $filename . ".json");  //delete file data
    unlink("database/files/" . $filename); //delete file
    header("location: dashboard.php");
    exit();
}
else{
	header("location: index.php");
}