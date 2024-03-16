<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include("config/dbcon.php");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- UserModal -->
                <div class="modal fade" id="AdduserModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="code.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name">

                                    </div>
                                    <div class="form-group">
                                    <label for="">Email</label>
                                    <span class="email_error"></span>
                                        <input type="email" name="email" class="form-control email_id" placeholder="Email">

                                    </div>
                                    <div class="form-group">
                                    <label for="">Phone Number</label>
                                        <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">

                                    </div>
                                    <div class="row">

                                      <div class="col-md-6">


                                            <div class="form-group">
                                                    <label for="">Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password">

                                          </div>

                                      </div>
                                      <div class="col-md-6">
                                          
                                          <div class="form-group">
                                          <label for="">Confirm Password</label>
                                              <input type="password" name="confirmpassword" class="form-control" placeholder="ConfirmPassword">

                                         </div>

                                      
                                      </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="addUser" class="btn btn-primary">Save </button>
                                </div>
                          </div>
                      
                            </form>
                      </div>
</div>
<!-- DeleteUser-->
<div class="modal fade" id="Deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">
                          <div class="modal-body">
                                  <input type="hidden"name="delete_id" class="delete_user_id">
                                                      <p>Are you sure you want to delete</p>

                          </div>
                          <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="DeleteUserbtn" class="btn btn-primary">yes </button>
                          </div>
                
                        </form>
                </div>
              </div>
          </div>
<!--Delete user-->





    <div class="container pt-2">
        <div class="row">
            <div class="col-md-12">
                    <?php           
                    if(isset($_SESSION['status'])){
                            echo"<h4>".$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                    }
                    ?>
           
                        <div class="card ">
                                <div class="card-header">
                                    <h3 class="card-title">Registered user</h3>
                                  
                                    <a href="" data-toggle="modal" data-target="#AdduserModel" class="btn btn-primary btn-sm float-right">Add User</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>Role</th>
                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php   
                                                            $query="SELECT * FROM users";
                                                            $query_run= mysqli_query($conn,$query);
                                                            if(mysqli_num_rows($query_run) > 0)
                                                            {
                                                                        foreach($query_run as $row)
                                                                        {
                                                                            //echo $roe['name'];
                                                                            ?>
                                                                                 <tr>
                                                                                        <td><?php echo $row['id'];  ?></td>
                                                                                        <td><?php echo $row['name'];  ?></td>
                                                                                        <td><?php echo $row['email'];  ?></td>
                                                                                        <td><?php echo $row['phone'];  ?></td>
                                                                                        <td><?php 
                                                                                                  if($row['role_as']=="0")
                                                                                                  {
                                                                                                    echo "User";
                                                                                                  } 
                                                                                                  elseif($row['role_as']=="1"){
                                                                                                    echo"Admin";
                                                                                                  }
                                                                                                  else{
                                                                                                    echo"Invalid users";
                                                                                                  }
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                  ?></td>
                                                                                        <td>
                                                                                            <a href="register-edit.php?user_id=<?php echo $row['id'];  ?>" class="btn btn-info">Edit</a>
                                                                                            <button type="button" value="<?php echo $row['id'];?>" class="btn btn-danger deletebtn">Delete</button>
                                                                                        </td>
                                                                                        
                                                                                    </tr>



                                                                            <?php
                                                                        }
                                                            }
                                                            else{
                                                                ?>
                                                                <tr>
                                                                    <td>No record found</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        
                                                        
                                                        ?>
                                                    </tbody>
                                            </table>
                                    </div>
                    </div>
            </div>
        </div>
    </div>



</div>
    <!-- /.content -->



<?php
include("include/script.php");?>


<script>
$(document).ready(function(){
    $('.deletebtn').click(function(e){
      e.preventDefault();
        var user_id=$(this).val();
        //console.log(user_id);

        $('.delete_user_id').val(user_id);
        //pop of model
        $('#Deletemodel').modal('show');
       
    });


});


</script>

