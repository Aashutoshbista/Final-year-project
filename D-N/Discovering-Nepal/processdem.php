<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>

	<?php
	session_start();
		
		include('admin/config/dbcon.php');
        $emptyerror='';
        $validname= $validmail =$validpass=$validphone=$validage='';
        if(isset($_POST['submit'])){
           
         
            $name = $_POST['name'];
            $email = $_POST['email'];
           $age=$_POST['age'];
           $country=$_POST['nationality'];
            $pass1 = $_POST['password'];
            $pass2 = $_POST['password'];
            $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
           $phone=$_POST['phone'];
           $selectedTags=$_POST["Tags"];
           $tags=implode(",",$selectedTags);
          
       
/*
           echo $name;
           echo $email;
           echo $age;
           echo $country;
           echo $pass1;
           echo $pass2;
           echo $phone;
         if(isset($_POST['Tags'])){
        $selectedTags=$_POST["Tags"];
        foreach ($selectedTags as $tags) {
            echo "selected tags".$tags."<br>";
        }
       

    }
 */

if (empty($name)) {
                 $emptyerror= "1" ;
                $_SESSION['status']="<br>Name field can't be empty";
				 header("Location:signup.php");
                }elseif(!preg_match ("/^[a-zA-z]*$/", $name)){
                    $emptyerror= "1" ;
                    $_SESSION['status']="<br>Olny alphabet white space is allowed ";
                    header("Location:signup.php");
                }else{
                    $validname=$name;
                }
               
                if(empty($email)){
                    $emptyerror= "1" ;
                    $_SESSION['status']="<br>Email field can't be empty ";
                    header("Location:signup.php");
                    
                }elseif(!preg_match ($pattern, $email)){
                    $emptyerror= "1" ;
                    $_SESSION['status']="<br>Invalid Email ";
                    header("Location:signup.php");

                }else{
                    $validmail = $email;
                }
                if (!preg_match("/^[0-9]{10}$/", $phone)) {
                    $emptyerror= "1" ;
                    $_SESSION['status']="<br>Invalid phone number ";
                    header("Location:signup.php");
                    
                } else {
                    $validphone=$phone;
                }
                if(!is_numeric ($age)) {
                    $emptyerror= "1" ;
                    $_SESSION['status']="<br>Invalid age ";
                    header("Location:signup.php");
                    
                } else {
                    $validage=$age;
                }

                if(empty($pass1)){
                    $emptyerror= "1" ;
                     
                     $_SESSION['status']="<br>Password field can't be empty";
                     header("Location:signup.php");
                    }elseif(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/",$pass1)){#reg from stackoveflow
                        $emptyerror= 1 ;
                        $_SESSION['status']="<br>Password must include alphanumeric value one upperclass,one special charcter";
                         header("Location:signup.php");
                        }elseif (empty($pass2)) {
                        $emptyerror = 1;
                        $_SESSION['status']="<br>Confirm your password";
                        header("Location:signup.php");
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
                        
                            
                            
                            $query="INSERT INTO users(name,email,password,role_as,phone,age,country,tags) VALUES('$validname','$validmail','$validpass','0','$validphone','$validage','$country','$tags')";
                           
                           
                       
                        if (mysqli_query($conn,$query)) {
                            
                            $_SESSION['status']="ACCOUNT CREATED SUCESSFULLY";
                            header("Location:signup.php");
                        }else{
                            
                            $_SESSION['status']="FAIL TO CREATE ACCOUNT";
                            header("Location:signuo.php");
                        }
                   }
       
                }
       
        

        
        mysqli_close($conn);
       
    ?>
    </body>
</html>