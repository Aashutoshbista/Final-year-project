<?php
session_start();
include('admin/config/dbcon.php');
$validname= $validmail =$validpass='';
$emptyerror='';




if (isset($_POST['submit'])){
            $name = $_POST['name'];
		 	$email = $_POST['email'];
			$age=$_POST['age'];
			$country=$_POST['nationality'];
		 	$pass1 = $_POST['password'];
		 	$pass2 = $_POST['password'];
		 	$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
			$phone=$_POST['phone'];


            if(empty($name)){
				
				
                $emptyerror ="<br>Name filed can't be empty";
                   //die('Password and Confirm password should match!');
            }elseif(!preg_match ("/^[a-zA-z]*$/", $name)){
                $emptyerror = $emptyerror ."<br> Olny alphabet white space is allowed ";
   
                
            }else{
                $validname = $name;

            } 

            if(empty($email)){
                $emptyerror =$emptyerror ."<br> Email field can't be empty";

            }elseif(!preg_match ($pattern, $email)){
                $emptyerror = $emptyerror ."<br> Invalid Email";
       
            }else{
                $validmail = $email;
            }

           //for age
           



            if(empty($pass1)){
                $emptyerror = $emptyerror ." <br>Password field can't be empty";
            
            }elseif(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/",$pass1)){#reg from stackoveflow
                $emptyerror= $emptyerror ."<br>Password must include alphanumeric value one upperclass,one special charcter";
                }elseif (empty($pass2)) {
                $emptyerror = $emptyerror."<br>Confirm your password";
            

            }elseif($pass1 == $pass2){
                //$validpass = mysqli_real_escape_string($pass1);
                $validpass = md5($pass1);
                //$validpass = $pass1;
                //$validpass = password_hash($pass1,PASSWORD_DEFAULT);
              //validpass = $pass1;
            }else{
               return true;
            }













            if($emptyerror==''){
            $query="INSERT INTO users(name,email,age,country,password,role_as,phone) VALUES('$name','$email','$age','$country','$pass','0','$phone')";
            $query_run=mysqli_query($conn,$query);
            if($query_run)
            {
                $_SESSION['status']="sucess";
                header("Location:admin/login.php");
            }else{
                $_SESSION['status']="fail";
                header("Location:signupdemo.php");
            }
        }else{
            echo $emptyerror;

            echo"<a href='signupdemo.php'><br>TRY AGAIN</a>";
        }

     }
     mysqli_close($conn);







/*if (isset($_POST['adduser'])){
		 	$name = $_POST['name'];
		 	$email = $_POST['email'];
			$age=$_POST['age'];
			$country=$_POST['country'];
		 	$pass1 = $_POST['password'];
		 	$pass2 = $_POST['password'];
		 	$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
			$phone=$_POST['phone'];*/
            ?>