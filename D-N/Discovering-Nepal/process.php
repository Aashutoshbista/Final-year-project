<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <style>
     body{
        background-image: url('Mount-Everest.webp');

    }
    .box{
        opacity: 0.65;
    }
    .names{
        font-weight:700;
    }
    .card {
  width: 350px;
  padding: 10px;
  border-radius: 20px;
  background: #fff;
  border: none;
  height: 350px;
  position: relative;
}

.container {
  height: 100vh;
  opacity: 0.9;
}



.mobile-text {
  color: #989696b8;
  font-size: 15px;
}

.form-control {
  margin-right: 12px;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #ff8880;
  outline: 0;
  box-shadow: none;
}

.cursor {
  cursor: pointer;
}
  </style>
</head>
<body>

	<?php
	session_start();
  
  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/PHPMailer/src/PHPMailer.php';
require 'path/PHPMailer/src/Exception.php';
require 'path/PHPMailer/src/SMTP.php';

 
		include('admin/config/dbcon.php');
        $emptyerror='';
        $validname= $validmail =$validpass=$validphone=$validage='';
        if(isset($_POST['submit'])){
           
         
            $name = $_POST['name'];
            $email = $_POST['email'];
           $age=$_POST['age'];
           $country=$_POST['nationality'];
            $pass1 = $_POST['pass'];
            $pass2 = $_POST['repass'];
            $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
           $phone=$_POST['phone'];
           $selectedTags=$_POST["Tags"];
           $tags=implode(",",$selectedTags);
         


                        $validpass = md5($pass1);
                        
                        
                            $querycheck="SELECT * FROM users WHERE email = '$email' ";
                            $querycheck_run=mysqli_query($conn,$querycheck);
                            if($querycheck_run){
                                $num_rows = mysqli_num_rows($querycheck_run);
                                if ($num_rows > 0) {
                                $_SESSION['status']="Account already present";
                                header("Location:signup.php");
                                }else{

                                    $otp=rand(1111,9999);
                                    $query="INSERT INTO users(name,email,password,role_as,phone,age,country,tags,otp) VALUES('$name','$email','$validpass','0','$phone','$age','$country','$tags','$otp')";
                                    $queryinsert_run=mysqli_query($conn,$query);
                                   
                                  
                                     ?>

                                    
                                <?php
                                                }
                                              }
                                    function sendOTP($email, $otp) {
                                      $mail = new PHPMailer(true);
                                      try {
                                          $mail->isSMTP();
                                          $mail->Host = 'smtp.gmail.com';
                                          $mail->SMTPAuth = true;
                                          $mail->Username = 'bistaaashutosh@gmail.com';
                                          $mail->Password = 'hkqjifcvxifvbwor';
                                          $mail->SMTPSecure = 'tls';
                                          $mail->Port = 587;

                                          $mail->setFrom('bistaaashutosh@gmail.com', 'Discovering-Nepal');
                                           $mail->addAddress($email);

                                            // Email content
                                              $mail->isHTML(true);
                                              $mail->Subject = 'OTP Verification';
                                              $mail->Body = 'Your OTP: ' . $otp;

                                              $mail->send();
                                              return true;
                                                } catch (Exception $e) {
                                                    return false;
                                                }

                                    }
                                    if (sendOTP($email, $otp)) {
                                      $_SESSION['status']=" Account created sucessfully Check Your email";
                                      header("Location:signup.php");
                                  } else {
                                    $_SESSION['status']=" Account created Unsucessfully";
                                    header("Location:signup.php");
                                  }

                                }
        
                                 
                                 
                                 
                                mysqli_close($conn);
       
                                ?>
                            
      
    </body>
                                 
                                 
                                 
                                  </html>                       
                                 
                                