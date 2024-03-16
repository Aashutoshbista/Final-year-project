<?php
session_start();
if(!isset($_SESSION['auth']))
{
    $_SESSION['auth_status']="Login to Acess Dashboard";
    header("Location:admin/login.php");
    exit(0);
}
else{
    
    if( $_SESSION['auth']=="0"){
       

    }
    else{
       
        
        exit(0);
       
    }

}


?>