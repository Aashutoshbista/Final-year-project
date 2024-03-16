<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include('config/dbcon.php');

?>

<!-- Form 
<section class="content">
<div class="row">
<div class="col-lg-7 ">
        <form id="changePassword" class="add-post-form col-md-6" method="POST">
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="old_pass" class="form-control old_pass" placeholder="Old Password"  required/>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_pass" class="form-control new_pass" placeholder="New Password"  required/>
            </div>
            <input type="submit" name="save" class="btn add-new" value="Submit">
        </form>
      </div>  
    </div>
</section>
    -->
    <div class="container pt-2 " >
       
                              <div class="row">
                                    <div class="col-sm-5"></div>
                                        <?php           
                                                                        if(isset($_SESSION['status'])){
                                                                                echo"<h4>".$_SESSION['status']."</h4>";
                                                                                unset($_SESSION['status']);
                                                                        }
                                                                ?>
                                                                </div>
                               
                             <div class="row">
       
            
                                     <div class="col-sm-4"></div>
                                                <form action="code.php" class="add-post-form col-md-6" method="POST">
                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old_pass" class="form-control old_pass" placeholder="Old Password"  required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_pass" class="form-control new_pass" placeholder="New Password"  required/>
                                                    </div>
                                                    <input type="submit" name="ChangePassword" class="btn btn-primary changepassword" value="Submit">
                                                </form>

                                        </div>
                                 </div>
     </div>
                                





<?php

include("include/script.php");

?>