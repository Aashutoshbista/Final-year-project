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

<div class="container pt-3">
    <div class="main-body">
          <div class="row gutters-sm ">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <img src="<?php echo"user_images/". $row['user_image']; ?>" alt="Admin" class="rounded-circle" width="150">
                   
                      
                  
                    <div class="mt-3">
                      <h4><?php echo $row['name'];  ?></h4>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">
                      <?php echo $row['u_addr'];
                      ?>
                      </p>
                    
                    </div>
                  </div>
                </div>
              </div>
</div>
            
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                <form action="code.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $row['id']?>"></br>
                  <div class="row">
                  
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="user_name" class="form-control"value="<?php echo $row['name']?>"></br>
                   
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="email" name="user_email" class="form-control"value="<?php echo $row['email']?>"></br>
                    
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="user_phone" class="form-control"value="<?php echo $row['phone']?>"></br>
                    
                    </div>
                  </div>
                  <hr>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="user_age" class="form-control"value="<?php echo $row['age']?>"></br>
                   
                    </div>
                  </div>
                  <hr>
                  
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="user_address" class="form-control"value="<?php echo $row['u_addr']?>"></br>
                    
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      
                      <button type="submit" name="updateuser" class="btn btn-primary">Update </button>
                    </div>
                  </div>
                </div>
              </div>

             


            </div>
            </form>
          </div>
          
        </div>
       
    </div>
    <script >

    </script>
    
    <?php 
     }}
     include('include/footer.php');
    ?>
             
    </main>
    