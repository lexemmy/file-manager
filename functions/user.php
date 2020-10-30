<?php
require('db_config.php');


//filter input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//check the database if the user exsits
function find_user($email){
    global $conn;
    $user = "select * from users where email='$email'";
    $result = $conn->query($user);

    if (mysqli_num_rows($result) > 0){
        $row= mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $row;
    }
      return false;
      $conn->close();  
}

//save user to database
function save_user($fullname, $email, $password){
    global $conn;
    $sql = "insert into users(fullname,email,password) values('$fullname', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        return true;
        }
    return false;
    $conn->close();
    }

//save file to database
function save_file($file_name, $file_size, $file_category, $file_type, $uploaded_by, $total_download, $email){
    global $conn;
    $sql = "insert into file(name,size,category,type,uploaded_by,total_download,email) values('$file_name', '$file_size', '$file_category', '$file_type', '$uploaded_by', '$total_download', '$email')";
    if ($conn->query($sql) === TRUE) {
        return true;
        }
    return false;
    $conn->close();
    }

//get all public files
function get_public_files() {
    global $conn;
    $file_rows = '';
   
    $q="select name,size,type,total_download,uploaded_by,date_uploaded from file where category='public'";
    $result=$conn->query($q);
    while($row = mysqli_fetch_array($result)){
        $file_rows .= "
         <tr>
            <td>".$row['name']."</td>
            <td>".$row['size']."kb</td>
            <td>".$row['type']."</td>
            <td>".$row['uploaded_by']."</td>
            <td>".date_format(date_create($row['date_uploaded']), 'd/m/Y')."</td>
            <td>".$row['total_download']."</td>
        </tr>
        ";
    } 
    return $file_rows;
    $conn->close();
}

//get all private files
function get_private_files(){
   global $conn;
    $file_rows = '';
   
    $q="select name,size,type,total_download,uploaded_by,date_uploaded from file where category='private'";
    $result=$conn->query($q);
    while($row = mysqli_fetch_array($result)){
        $file_rows .= "
             <tr>
                <td>".$row['name']."</td>
                <td>".$row['size']."kb</td>
                <td>".$row['type']."</td>
                <td>".$row['uploaded_by']."</td>
                <td>".date_format(date_create($row['date_uploaded']), 'd/m/Y')."</td>
                <td>".$row['total_download']."</td>
            </tr>
            ";
        } 
     return $file_rows;
     $conn->close();
}

//get all user files
function get_user_files($email)
{

    global $conn;
    $file_rows = '';
   
    $q="select name,size,type,category,total_download,uploaded_by,date_uploaded from file where email='$email'";
    $result=$conn->query($q);
    while($row = mysqli_fetch_array($result)){
     $file_rows .= "
             <tr>
                <td>".$row['name']."</td>
                <td>".$row['size']."kb</td>
                <td>".$row['type']."</td>
                <td>".$row['uploaded_by']."</td>
                <td>".date_format(date_create($row['date_uploaded']), 'd/m/Y')."</td>
                <td>".$row['total_download']."</td>
                <td>".$row['category']."</td>
                <td>
                <a class='btn btn-success' href='download.php?file=".$row['name']."'>Download</a>
                <a class='btn btn-danger' href='delete.php?file=".$row['name']."'>Delete</a>
                </td>
            </tr>
            ";
        } 
     return $file_rows;
     $conn->close();
}


//update total number of downloads of a file
function update_download_count($filename){
    global $conn;
    $sql = "update file set total_download = total_download + 1 where name='$filename'";
    $res=$conn->query($sql);
    $conn->close();
}

