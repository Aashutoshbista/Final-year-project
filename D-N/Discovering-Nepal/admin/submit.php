<?php
include('config/dbcon.php');
session_start();

if(isset($_POST['submitotp'])){
        $input=$_POST['otpInput'];
        $otp=$_POST['otp'];
        $email=$_POST['email'];
        $verified="verified";
        if($input==$otp){
          $query="UPDATE  users SET  status='$verified' WHERE email='$email'";
          $query_run=mysqli_query($conn,$query);
          if($query_run){
            $_SESSION['status']="Verified sucessfully";
            header("Location:login.php");

          }else{
            $_SESSION['status']="Verified Failed";
            header("Location:login.php");
          }

        }else{
          $_SESSION['status']="OTP did not matched";
          header("Location:login.php");
        }



}



        /*
        $query="SELECT otp FROM users WHERE email='$email'";
        $query_run=mysqli_query($conn,$query);
        if($query){
          foreach($query_run as $row){
         
          if($row['otp']==$otp){
            $queryupdate="UPDATE  users SET  status='$verified' WHERE email='$email'";
            $queryupdate_run = mysqli_query($conn,$queryupdate);
            if($queryupdate_run)
            {
                $_SESSION['status']=" Account created sucessfully";
                header("Location:signupdemo.php");
            }
            else{
                $_SESSION['status']="failed to create account";
                header("Location:signupdemo.php");
            }
           


          }
        else{
          $query="DELETE FROM users WHERE email='$email'"; 
          $query_run = mysqli_query($conn,$query);
          if($query_run){
                 $_SESSION['status']="otp did not match";
                header("Location:signupdemo.php");
        }else{
          $_SESSION['status']="Error";
          header("Location:signupdemo.php");
        }
      }}
          
      }


    }*/
    ?>