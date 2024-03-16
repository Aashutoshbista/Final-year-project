<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include('config/dbcon.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
           
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">
        <div class="col-md-12">
          <?php
          include("message.php");
          ?>
        </div>
          
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
                      $query = "SELECT id FROM locations ";
                     $query_run= mysqli_query($conn,$query);
                     $row= mysqli_num_rows($query_run);
                     echo'<h3>'  .$row. '</h3>';
                     ?> 


                <p>Total Places</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="Places.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              
                    <?php
                      $query = "SELECT id FROM users ";
                     $query_run= mysqli_query($conn,$query);
                     $row= mysqli_num_rows($query_run);
                     echo'<h3>'  .$row. '</h3>';
                     ?> 


                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="register.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col --> 
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger bg-warning">
              <div class="inner">
              <?php
                      
                      $query = "SELECT cat_id FROM catagories ";
                     $query_run= mysqli_query($conn,$query);
                     $row= mysqli_num_rows($query_run);
                     echo'<h3>'  .$row. '</h3>';
                     
                     ?> 
                <p>Catagories</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
              
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
   
</div>
    <!-- /.content -->






<?php

include("include/script.php");


?>