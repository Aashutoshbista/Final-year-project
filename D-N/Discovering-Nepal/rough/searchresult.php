<?php
    include('header1.php');


?>

<div class="container-fluid p-0">
        <div class="row">
            
                        
                        <!--Section: Block Content-->
            <section class="text-center">
 
                <!-- Grid row -->
                <div class="row m-1 w-100 ">
                <?php
                    if(isset($_POST['submitsearch'])){
                        
                        $search=mysqli_real_escape_string($conn,$_POST['searchinput']);
                        $query="SELECT * FROM items WHERE name LIKE '%$search%' OR price LIKE '%$search%'OR item_cat LIKE '%$search%'";
                        $result=mysqli_query($conn,$query);
                        $queryResult=mysqli_num_rows($result);
                        if($queryResult > 0){
                            while($row=mysqli_fetch_assoc($result)){
                                ?>
                                        <!-- Grid column -->
                                            <div class="  col-sm-6 col-md-4 col-lg-3 mb-3 shadow p-3 bg-light rounded ">
                                                                    <!-- Card -->
                                                <div  class=" col-sm-12 col-md-12 col-lg-12 mb-3 shadow p-3 bg-light rounded" >
                                                    <div>
                                                    <div class=' z-depth-2 rounded'>
                                                    <form method="POST" action="index.php">
                                                        <div class="mask">
                                                            
                                                       
                                                            <img class="img-fluid w-100 image-size" src="<?php echo"admin/images/". $row['image']; ?>"  alt="img" width="100" >
                                                            <div class="mask rgba-black-slight"></div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center pt-4">
                                                            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
                                                            <h5><?php echo $row["name"]; ?></h5>
                                                            <input type="hidden" name="quantity" class="form-control" value="1">

                                                        <input type="hidden" name="hidden_cat" value="<?php echo $row["item_cat"]; ?>">
                                                                <p class="mb-2 text-muted text-uppercase small"><?php echo $row['item_cat'];?></p>

                                                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                                                <h6 class="mb-3"> $<?php echo  $row["price"]; ?></h6>

                                                                <input type="hidden" name="i_id" value="<?php echo $row["item_id"]; ?>">

                                                            
                                                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-primary"
                                                                    value=" Add to Cart">

                                                        
                                                        
                                                        <form action="code.php" method="POST">
                                                        <a href="productdetail.php?books_id=<?php echo $row['books_id'];  ?>" class="btn btn-danger"><i class="fas fa-info-circle pr-2"  ></i>Detail</a>
                                                        </form>

                                                    </div>
                            </form>

                                            </div>
                                             <!-- Card -->
<?php

                            }

                        } 
                        else{
                            ?>
                          <h1><?php  echo "No result found";?></h1>
                          <?php
                        }                       
                    }

                    
                ?>                                                   
                      </div><!--row div-->
                                        <!-- Grid row -->
             
            </section>
                <!--Section: Block Content-->
        </div>
</div>                





<?php
include('footer.php');
?>