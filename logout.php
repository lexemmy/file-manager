<?php 
session_start();

//clear all session
session_unset();
session_destroy();

header("Location: index.php"); //redirect to index page

?>

