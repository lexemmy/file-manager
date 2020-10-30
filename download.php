<?php
require('functions/user.php');


if(isset($_GET['file']))
{
    $filename = $_GET['file'];
    $filePath = "files/".$filename;
   
    header("Content-Description: File Transfer");
    header("Content-Disposition:attachment; filename=$filename");
    header("Content-Type: " . mime_content_type($filename)); //get and send file type as header

    readfile($filePath);     //download file
    update_download_count($filename); //update number of downloads
    exit();
    
} else {
    header("location: index.php");
}