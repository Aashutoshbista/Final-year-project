<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include("config/dbcon.php");
?>
<!-- Modal -->
<div class="modal fade" id="provinces_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
      <div class="modal-body">

                <div class="form-group">
                    <label for="">Provinces Name</label>
                    <input type="text" name="name" class="fore-control">
                </div>
               


      </div>
      <div class="modal-footer">
    
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="addprovinces" class="btn btn-primary">Save </button>
                                
      </div>
      </form>
    </div>
  </div>
</div>

<!-- DeleteProvinces-->
<div class="modal fade" id="Deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Provinces</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">
                          <div class="modal-body">
                                  <input type="hidden"name="delete_id" class="delete_prov_id">
                                                      <p>Are you sure you want to delete</p>

                          </div>
                          <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="Deleteprovinces" class="btn btn-primary">yes </button>
                          </div>
            
                        </form>
                </div>
              </div>
          </div>





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
                                    Provinces
                                        <a href="#" data-toggle="modal" data-target="#provinces_modal" class="btn btn-primary float-right">Add Provinces</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                       
                                                        <th>Name</th>
                                                        
                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php   
                                                            $query="SELECT * FROM provinces";
                                                            $query_run= mysqli_query($conn,$query);
                                                            if(mysqli_num_rows($query_run) > 0)
                                                            {
                                                                        foreach($query_run as $row)
                                                                        {
                                                                            //echo $roe['name'];
                                                                            ?>
                                                                                 <tr>
                                                                                               
                                                                                        <td><?php echo $row['prov_name'];  ?></td>
                                                                                        
                                                                                        
                                                                                       
                                                                                        <td>
                                                                                           
                                                                                            <button type="button" value="<?php echo $row['prov_id'];?>" class="btn btn-danger deletebtn">Delete</button>
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
        var prov_id=$(this).val();
       

        $('.delete_prov_id').val(prov_id);
        //pop of model
        $('#Deletemodel').modal('show');
       
    });


});


</script>
