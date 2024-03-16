<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include("config/dbcon.php");

?>



<div class="content-wrapper">


    <div class="container pt-2">
        <div class="row">
            <div class="col-md-12">
                    
           
                        <div class="card ">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Product Detail</h3>
                                  
                                    <a href="product.php"  class="btn btn-danger btn-sm float-right">Back</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        

                                        <form action="pcode.php" method="POST">
                                            <div class="modal-body">
                                                  <div class="row">
                                            <div class="col-md-6">
                                                        <?php
                                                            if(isset($_GET['books_id'])){
                                                                $book_id = $_GET['books_id'];
                                                                $query="SELECT * FROM items WHERE item_id=$book_id";
                                                                $query_run=mysqli_query($conn,$query);
                                                                if(mysqli_num_rows($query_run)>0){
                                                                         foreach($query_run as $row){
                                                                          ?>          
                                              
                                                                                 <div class="form-group">
                                                                                        <input type="hidden" name="books_id" value="<?php echo $row['item_id']?>"></br>
                                                                                            <label for="">Book Title</label>
                                                                                            <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Name">

                                                                                     </div>
                                                                                 <div class="form-group category">
                                                                                    <label for="">Product Category</label>
                                                                                    <?php
                                                                                        $query="SELECT cat_name FROM catagories";
                                                                                        $query_run= mysqli_query($conn,$query);
                                                                                        ?>
                                                                                        
                                                                                        <select  class="form-control product_category" >
                                                                                        <option value="" selected disabled>Select Category</option>
                                                                                        <?php
                                                                                        if(mysqli_num_rows($query_run) > 0)
                                                                                        {
                                                                                            foreach($query_run as $category)
                                                                                            {
                                                                                                ?>
                                                                                                <option  name="product_cat" value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                                
                                                                                                <?php

                                                                                            }
                                                                                         }
                                                                                                 ?>
                                                                                    <div class="form-group">
                                                                                                <input type="hidden" name="books_id" value="<?php echo $row['books_id']?>"></br>
                                                                                                <label for="">Product Description</label>
                                                                                                <textarea class="form-control product_description" name="product_desc" rows="8" cols="80" >
                                                                                                <?php echo $row['describtion'] ?>
                                                                                                </textarea>
                                                                                    </div>
                                                                                    <div class="show-error"></div>
                                                                        </div>                                                                        
                                                                         
                                                                  
                                                                        <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                    
                                                                                        <label for="">Featured Image</label>
                                                                                        <input type="file" accept=".png ,.jpg,.jpng" class="product_image" name="product_img">
                                                                                        <img id="image" src="" width="100px"/>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                    <input type="hidden" name="books_id" value="<?php echo $row['books_id']?>"></br>
                                                                                        <label for="">Auther</label>
                                                                                        <input type="text" class="form-control product_auther" name="product_auther" value="<?php echo $row['Author'] ?>" >
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                    <input type="hidden" name="books_id" value="<?php echo $row['books_id']?>"></br>
                                                                                        <label for="">Product Price</label>
                                                                                        <input type="text" class="form-control product_price" name="product_price"value="<?php echo $row['price'] ?>" >
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                    <input type="hidden" name="books_id" value="<?php echo $row['books_id']?>"></br>

                                                                                        <label for="">Available Quantity</label>
                                                                                        <input type="number" class="form-control product_qty" name="product_qty" value="<?php echo $row['quantity'] ?>" >
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                <button type="submit" name="updateproduct" class="btn btn-primary">Update </button>
                                                                        </div>
                                                                         </div>
                                                                        
                                                                    
                                </div>
                                                            
                                    
                                    
                                    <?php


                                }
                            }
                            else{
                                echo"<h4>No record found<h4>";
                            }

                        }
                       
                    
                    ?>
                    </div>
                    </div>
            </form>




                                        </div>


                                </div>
                    </div>
            </div>
        </div>
    </div>









<?php

include("include/script.php");
include("include/footer.php");

?>
