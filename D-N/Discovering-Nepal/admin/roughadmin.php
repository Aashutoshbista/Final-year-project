<?php
session_start();
include('config/dbcon.php');
if(isset($_POST['login_btn'])){
$email=$_POST['email'];
$password=$_POST['password'];

$log_query="SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
$log_query_run=mysqli_query($conn,$log_query);

if(mysqli_num_rows($log_query_run)>0){
            foreach($log_query_run as $row){
                $user_id=$row['id'];
                $user_email=$row['email'];
                $user_name=$row['name'];
                $user_phone=$row['phone'];
                $role_as=$row['role_as'];
                
            }
            $_SESSION['auth']="$role_as";
            $_SESSION['auth_user']=[
                'user_id'=>$user_id,
                'user_email'=>$user_email,
                'user_name'=>$user_name,
                'user_phone'=>$user_phone

            ];
    $_SESSION['status']="login sucessful";
    header('Location: index.php');
   


}
else
{
    $_SESSION['status']="Invalid email or password";
header('Location: login.php');

}

}
else{
$_SESSION['status']="Acess denied";
header('Location: login.php');
}


