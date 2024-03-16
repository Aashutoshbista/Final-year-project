<?php        
include('include/database.php');
session_start();


if(isset($_POST['logout_btn'])){
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status']="Logged out sucessfully";
    header("Location:admin/login.php");
    exit(0);

}



   
   

    if(isset($_POST['submitnewsletter'])){
       echo"hello world";


    }



/*
*/
if (isset($_POST['ChangePassword'])) {
    $user = $_SESSION['auth_user']['user_id'];
    $new = $_POST['new_pass'];
    $old = $_POST['old_pass'];

    // Password validation pattern
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    // Check if the new password matches the validation pattern
    if (!preg_match($password_pattern, $new)) {
        $_SESSION['status'] = "Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character (@$!%*?&), and be at least 8 characters long.";
        header("Location: Changepassword.php");
        exit(); // Stop further execution of the code
    }

    $querypass = "SELECT password FROM users WHERE id=$user";
    $querypass_run = mysqli_query($conn, $querypass);

    if ($querypass_run) {
        foreach ($querypass_run as $row) {
            if ($row['password'] == $old) {
                if ($new == $old) {
                    $_SESSION['status'] = "Password cannot be the same as the previous one.";
                    header("Location:Changepassword.php");
                    exit(); // Stop further execution of the code
                } else {
                    $queryupdate = "UPDATE  users SET  password='$new' WHERE id='$user'";
                    $queryupdate_run = mysqli_query($conn, $queryupdate);

                    if ($queryupdate_run) {
                        $_SESSION['status'] = "Password updated successfully.";
                        header("Location: ChangePassword.php");
                    } else {
                        $_SESSION['status'] = "Password update failed.";
                        header("Location:ChangePassword.php");
                    }
                }
            } else {
                $_SESSION['status'] = "Old password did not match.";
                header("Location: ChangePassword.php");
            }
        }
    }
}

if(isset($_POST['updateuser'])){
$user_id=$_POST['user_id'];
$user_name=$_POST['user_name'];
$user_age=$_POST['user_age'];
$user_phone=$_POST['user_phone'];
$user_email=$_POST['user_email'];
$user_addr=$_POST['user_address'];


if($user_name!== ''  && $user_age!== ''  && $user_phone!== ''  && $user_email!== '' ){
$querypass="SELECT * FROM users WHERE id=$user_id";
$querypass_run=mysqli_query($conn,$querypass);

$queryup="UPDATE  users SET name='$user_name',age='$user_age',phone='$user_phone',email='$user_email',u_addr='$user_addr' WHERE id='$user_id' ";
$queryup_run=mysqli_query($conn,$queryup);

if($queryup_run){
   
    $_SESSION['status']="Updated Sucessfully  ";
    header("Location:Profile.php");
    
}else{
    $_SESSION['status']=" UnSucessfully  ";
    header("Location:EditProfile.php");
}
}
}else{
    $_SESSION['status']="The fields cannot be Empty  ";
    header("Location:EditProfile.php");
}






if(isset($_POST['submitplaces'])){
    $name=$_POST['p_name'];
    $p_prov=$_POST['provinces'];
 
    $p_description=$_POST['p_description'];
   
 
    
   



 $query="INSERT INTO u_places(p_name,p_discription,p_image,p_prov) 
 VALUES('$name','$p_description','$p_img','$p_prov')";
 $query_run=mysqli_query($conn,$query);
 if($query_run){
    $_SESSION['status']=" Sucessfully Added";
     header("Location: AddPlaces.php");
     }
     else
     {
     $_SESSION['status']=" failed";
     header("Location: AddPlaces.php");
     }
 
    }


    if(isset($_POST['submitProfile'])){
        $user_id=$_POST['user_id'];
        echo $user_id;
       /*
        $profile=$_FILES['p_img']['name'];
        $query="UPDATE users SET user_image='$profile'  WHERE id='$user_id' ";
        $query_run=mysqli_query($conn,$query);
        if($query_run){
            move_uploaded_file($_FILES["p_img"]["tmp_name"],"user_images/".$_FILES["p_img"]["name"]);
            $_SESSION['status']=" sucess";
            header("Location: Profile.php");
        }
        else{
            $_SESSION['status']=" Faile to upload Profile";
            header("Location: Profile.php");
        }
*/
    }




    
?>
