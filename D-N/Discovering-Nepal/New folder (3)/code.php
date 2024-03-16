<?php        
include('database.php');
session_start();


if(isset($_POST['logout_btn'])){
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status']="Logged out sucessfully";
    header("Location:admin/login.php");
    exit(0);

}



   
   





?>
