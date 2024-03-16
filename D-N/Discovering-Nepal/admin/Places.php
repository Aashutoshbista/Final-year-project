<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include("config/dbcon.php");
?>

<!-- DeleteUser-->
<div class="modal fade" id="Deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Place</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="pcode.php" method="POST">
                          <div class="modal-body">
                                  <input type="hidden"name="deleteplace_id" class="delete_place_id">
                                                      <p>Are you sure you want to delete</p>

                          </div>
                          <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="Deleteplace" class="btn btn-primary">yes </button>
                          </div>
            
                        </form>
                </div>
              </div>
          </div>
<!--Delete user-->





<div class="content-wrapper pt-2">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        <?php           
                                    if(isset($_SESSION['status'])){
                                            echo"<h4>".$_SESSION['status']."</h4>";
                                            unset($_SESSION['status']);
                                    }
                              ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        All Places
                                       
                                    </h4>
                                </div>
                                <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                    <th>Name</th>
                                                    <th>Place_Id</th>
                                                    <th>Category</th>
                                                    <th>Longitude</th>
                                                    <th>Latitude</th>
                                                    <th>Image</th>
                                                   <!-- <th>Image</th>-->
                                                    
                                                    
                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php   
                                                            $query="SELECT * FROM locations";
                                                            $query_run= mysqli_query($conn,$query);
                                                            if(mysqli_num_rows($query_run) > 0)
                                                            {
                                                                        foreach($query_run as $row)
                                                                        {
                                                                            //echo $roe['name'];
                                                                            ?>
                                                                                 <tr>
                                                                                        <td><?php echo $row['place_name'];  ?></td>  
                                                                                        <td><?php echo $row['id'];  ?></td>       
                                                                                        <td><?php echo $row['Category_Ids'];  ?></td>
                                                                                        <td><?php echo $row['longitude'];  ?></td>
                                                                                        <td><?php echo $row['latitude']; ?></td>
                                                                                        <td><img src="<?php echo $row['imgUrl']; ?>" alt="" style="height:100px; width:100px;"></td>
                                                                                       <!-- <td>
                                                                                            <img src="<?php/* echo"images/". $row['p_image'];*/ ?>" alt="img" width="70px">
                                                                                        </td>-->
                                                                                       
                                                                                        <td>
                                                                                            
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
include("include/script.php");

?>
<script>
$(document).ready(function(){
    $('.deletebtn').click(function(e){
      e.preventDefault();
        var place_id=$(this).val();
       

        $('.delete_place_id').val(place_id);
        //pop of model
        $('#Deletemodel').modal('show');
       
    });


});


</script>