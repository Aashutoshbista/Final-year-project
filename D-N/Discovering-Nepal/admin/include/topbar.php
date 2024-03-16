<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light sidebar-mini layout-fixed">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
   


    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <li class="nav-item">
       <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
               if(isset($_SESSION['auth'])){
              echo $_SESSION['auth_user']['user_name'] ;
              }
              else{
                echo "Not logged IN";
              }
               
               ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <form action="code.php"method="POST">
              <a class="dropdown-item" name="ChangePassword" href="change-password.php?users_id=<?php  echo $_SESSION['auth_user']['user_id'] ;  ?>">Change password</a>
            
             
                <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                    

              </form>
            
            </div>
          </div>

       </li> 


    
     
      
    </ul>
  </nav>
  <!-- /.navbar -->
