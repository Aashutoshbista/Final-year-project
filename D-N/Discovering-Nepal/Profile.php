<?php

include('include/database.php');
include('include/header.php');




?>
<main>
<?php
$user_id=$_SESSION['auth_user']['user_id'];
  $query="SELECT * FROM users WHERE id=$user_id";
  $query_run= mysqli_query($conn,$query);
  if(mysqli_num_rows($query_run) > 0)
  {
              foreach($query_run as $row)
              {



?>
<style>
  .round .cam{
    font-size:24px;
  }
.round{
  position: absolute;
  bottom:110px;
  right: 135px;
 
  width: 32px;
  height: 32px;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  overflow: hidden;
}
 .round input[type = "file"]{
  position: absolute;
  transform: scale(2);
  opacity: 0;
}
input[type=file]::-webkit-file-upload-button{
    cursor: pointer;
}

</style>
<div class="row">
        <div class="col-md-12">
          <?php
          include("include/message.php");
          ?>
        </div>
<div class="container pt-3">
    <div class="main-body">
          <div class="row gutters-sm ">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <form  class="form" id="form" action="" enctype="multipart/form-data" method="post">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo"user_images/". $row['user_image']; ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="round">
                    <li class="fa fa-camera cam " style="color:black;"></li>
                    <input type="file" accept=".png ,.jpg,.jpng" id="image" class="Profile_image" name="p_img">
                    <img id="image" src="" width="100px"/>
                    </div>
                    </form>
                    <div class="mt-3">
                      <h4><?php echo $row['name'];  ?></h4>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm"></p>
                    
                    </div>
                  </div>
                </div>
              </div>
</div>
              
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['name'];  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['email'];  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['phone'];  ?>
                    </div>
                  </div>
                  <hr>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['age'];  ?>
                    </div>
                  </div>
                  <hr>
                  
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['u_addr'];  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="__blank" href="EditProfile.php">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              


            </div>
          </div>

        </div>
    </div><?php 
     }}
    ?>
    <script type="text/javascript">
      document.getElementById("image").onchange=function(){
        document.getElementById('form').submit();
      }
    </script>
    <?php
    if(isset($_FILES["p_img"]["name"])){
      $user_id=$_SESSION['auth_user']['user_id'];
      $profile=$_FILES['p_img']['name'];
   

      

      // Image validation
      
      
      
      
       
       
        $query = "UPDATE users SET user_image = '$profile' WHERE id = $user_id";
        $query_run=mysqli_query($conn, $query);
        if($query_run){
          move_uploaded_file($_FILES["p_img"]["tmp_name"],"user_images/".$_FILES["p_img"]["name"]);
          $_SESSION['status']=" sucess";
          
        }
       else{
        $_SESSION['status']=" Fail";
        

       }
      }
    include('include/footer.php');
      

    ?>
             
    </main>