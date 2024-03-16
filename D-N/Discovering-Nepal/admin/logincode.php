<!doctype html>
<html lang="en">
  <head>
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  
  </head>
<?php
session_start();
include('config/dbcon.php');
if(isset($_POST['login_btn'])){
$email=$_POST['email'];
$password=md5($_POST['password']);

$log_query="SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
$log_query_run=mysqli_query($conn,$log_query);



if(mysqli_num_rows($log_query_run)>0){
            foreach($log_query_run as $row){
                $user_id=$row['id'];
                $user_email=$row['email'];
                $user_name=$row['name'];
                $user_phone=$row['phone'];
                $role_as=$row['role_as'];
                $status=$row['status'];
                $otp=$row['otp'];
            } 
            if($status !='verified'){ 
                $log_query="SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
                $log_query_run=mysqli_query($conn,$log_query);
                if(mysqli_num_rows($log_query_run)>0){
                    foreach($log_query_run as $row){
                ?>
                <div class="d-flex justify-content-center align-items-center container">
                <div class="card py-5 px-3">
                  <form action="submit.php" method="POST">
                    <input type="hidden" name="otp" value="<?php echo $row['otp'];?>">

                    <input type="hidden" name="email"value="<?php echo $email=$row['email'];?>">

                     
                    <h5 class="m-0"> Email verification</h5><span class="mobile-text">Enter the code we just send on your Email <b class="text-danger"> </b>
                 
                  </span>
                    <div class="d-flex flex-row mt-5">
                    <input type="text" class="form-control" name="otpInput" maxlength="4" >
                     </div>
                     <div class="pt-3">
                     <button type="submit" class="btn btn-primary"name="submitotp" id="submitotp">Submit OTP</button></div>
                    
                    </form></div>
            </div>
            <?php
                            
          }}  }  else{
             
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

?>
</body>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  
    </body>
</html>