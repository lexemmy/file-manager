<?php include_once('alert.php');

//filter input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//check the database if the user exsits
function find_user($email = ""){

    $allUsers = scandir("database/users/"); //return array
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers ; $counter++) {
       
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
            $userString = file_get_contents("database/users/".$currentUser);
            $userObject = json_decode($userString);
                       
            return $userObject;
          
        }        
        
    }

    return false;
}

//save user to database
function save_user($userObject){
    file_put_contents("database/users/". $userObject['email'] . ".json", json_encode($userObject));
}

//save file to database
function save_file($file){
    file_put_contents("database/file_data/". $file['name'] . ".json", json_encode($file));
}

//get all public files
function get_public_files()
{
    $file_rows = '';
    $all_files = scandir('database/file_data/'); //return array
    $num = count($all_files); //return total number of files
    for ($counter = 2; $counter < $num; $counter++) { //start counter from 2, to ignore the first two elemet(.,..) in array
        
        $file = json_decode(file_get_contents('database/file_data/' . $all_files[$counter]));
        
        if (@$file->category == "public") {
            $file_rows .= "
             <tr>
                <td>$file->name</td>
                <td>$file->size</td>
                <td>$file->type</td>
                <td>$file->uploaded_by</td>
                <td>$file->date_uploaded</td>
                <td>$file->total_download</td>
                <td><a class='btn btn-success' href='download.php?file=$file->name'>Download</a></td>
            </tr>
            ";
        } 
    }

    return $file_rows;
}

//get all private files
function get_private_files()
{
    $file_rows = '';
    $all_files = scandir('database/file_data/'); //return array
    $num = count($all_files); //return total number of files
    for ($counter = 2; $counter < $num; $counter++) { //start counter from 2, to ignore the first two elemet(.,..) in array
        
        $file = json_decode(file_get_contents('database/file_data/' . $all_files[$counter]));
        
        if (@$file->category == "private") {
            $file_rows .= "
             <tr>
                <td>$file->name</td>
                <td>$file->size kb</td>
                <td>$file->type</td>
                <td>$file->uploaded_by</td>
                <td>$file->date_uploaded</td>
                <td>$file->total_download</td>
                <td><a class='btn btn-success' href='download.php?file=$file->name'>Download</a></td>
            </tr>
            ";
        } 
    }

    return $file_rows;
}

//get all user files
function get_user_files($email)
{

    $file_rows = '';
    $all_files = scandir('database/file_data/'); //return array
    $num = count($all_files); //return total number of files
    for ($counter = 2; $counter < $num; $counter++) { //start counter from 2, to ignore the first two elemet(.,..) in array
        
        $file = json_decode(file_get_contents('database/file_data/' . $all_files[$counter]));
        
        if (@$file->email == $email) {
            $file_rows .= "
             <tr>
                <td>$file->name</td>
                <td>$file->size kb</td>
                <td>$file->type</td>
                <td>$file->uploaded_by</td>
                <td>$file->date_uploaded</td>
                <td>$file->total_download</td>
                <td>$file->category</td>
                <td>
                <a class='btn btn-danger' href='delete.php?file=$file->name'>Delete</a>
                <a class='btn btn-success' href='download.php?file=$file->name'>Download</a>
                </td>
            </tr>
            ";
        } 
    }

    return $file_rows;
}

//update total number of downloads of a file
function update_download_count($filename){
    $file = json_decode(file_get_contents('database/file_data/' . $filename .".json"));
    $file->total_download = $file->total_download + 1; //increament download by 1
    file_put_contents("database/file_data/" . $filename .".json", json_encode($file));
}

