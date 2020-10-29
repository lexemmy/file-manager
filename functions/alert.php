<?php 

//for printing message or error;
function print_alert(){
    
    $types = ['message','info','error'];
    $colors = ['success','info','danger'];
      
    for($i = 0; $i < count($types); $i++){
        
        if( isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]]) ) {
            echo "<div class='alert alert-".$colors[$i]."' role='alert'>" . $_SESSION[$types[$i]] .
                    "</div>";
          
            unset($_SESSION['error']);
            unset($_SESSION['message']);
            unset($_SESSION['info']);
        }

    }

}

