 



<?php
include("authentication.php");
include("include/header.php");
include("include/topbar.php");
include("include/sidebar.php");
include("config/dbcon.php");
?>



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
                                    Edit SuggestedPlaces
                                        <a href="SuggestedPlace.php" data-toggle="modal" data-target="#category_modal" class="btn btn-danger btn-sm float-right">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                <?php           
                                    if(isset($_SESSION['status'])){
                                    echo"<h4>".$_SESSION['status']."</h4>";
                                    unset($_SESSION['status']);
                                    }
                                    if(isset($_GET['edit']))

{
    $p_id = $_GET['books_id'];
                                   

                                    $query="SELECT * FROM u_places WHERE p_id=$p_id";
                                    $query_run= mysqli_query($conn,$query);
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                                foreach($query_run as $row)
                                                {



?>

                                            <div class="admin-content-container">
                                                    <h2 class="admin-heading"></h2>
                                                    <form id="createProduct" action="pcode.php" class="add-post-form row" method="POST" enctype="multipart/form-data">
                                                        <div id="step1" style="display:block;">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <input type="text" class="form-control product_title" name="p_name" placeholder="Place Name" requried/>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col">
                                                                
                                                            
                                                            <div class="form-group provinece">
                                                                <label for="">Provinece</label>
                                                                <?php
                                                                      $query="SELECT * FROM provinces";
                                                                      $query_run= mysqli_query($conn,$query);
                                                                     
                                                                      ?>
                                                                       
                                                                      <select name="provinces" class="form-control " >
                                                                      <option value="" selected disabled>Select Provinece</option>
                                                                      <?php
                                                                      if(mysqli_num_rows($query_run) > 0)
                                                                      {
                                                                                  foreach($query_run as $provinces)
                                                                                  {
                                                                                    ?>
                                                                                    <option  name="specific_prov" value="<?php echo $provinces[ 'prov_name'];?>">
                                                                                    <?php echo $provinces['prov_name']; ?></option>
                    
                                                                                      <?php
                                                                                  }
                                                                      }
                                                                      else{
                                                                        echo "No provinces found";
                                                                      }
                                                                  ?>
                                                                   </select>

                                                            </div>
                                                            </div>
                                                            <div class="col">
                                                                      <!--Types-->
                                                                      <div class="form-group provinece">
                                                                                <label for="">Type</label>
                                                                                <Select name="type" class="form-control p_type" >
                                                                                         <option value="" selected disabled>Select Type</option>
                                                                                         <option  name="specific_type" value="Popular">Popular place</option>
                                                                                         <option  name="specific_type" value="UnPopular">UnPopular place</option>
                                                                    </Select>




                                                                    </div>


                                                            </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="">Place Description</label>
                                                                <textarea class="form-control place_description" name="p_description" rows="8" cols="80" requried></textarea>
                                                            </div>
                                                            <div class="show-error"></div>

                                                                        </div>
                                                                        <div class="button-container col">
                                                                        <button type="button" class="next-button btn btn-success float-right"  onclick="showStep('step2')">Next</button>
                                                                </div>

                                                                    </div>


                                                        <div id="step2" style="display:none;">
                                                        <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Images</label>
                                                                <input type="file" accept=".png ,.jpg,.jpng" class="Place_image" name="p_img">
                                                                <img id="image" src="" width="100px"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Longitude</label>
                                                                <input type="text" class="form-control place_longitude" name="p_longitude" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Latitude</label>
                                                                <input type="text" class="form-control place_latitude" name="p_latitude" >

                                                            </div>

                                                                    </div>

                                                           
                                                            
                                                                <div class="col-md-6 pl-4">
                                                                    
                                                                <label>Catagory:</label>
                                                                                                    <div class="checkboxes" required>
                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-4"> <label><input type="checkbox" name="catagory[]" value="Lakes" > Lakes</label></div>
                                                                                                                            <div class="col-md-4"> <label><input type="checkbox" name="catagory[]" value="Hillstations" > Hillstations</label></div>
                                                                                                                            <div class="col-md-4"> <label><input type="checkbox" name="catagory[]" value="Valleys" > Valleys</label></div>
                                                                                                    </div>
                                                                                                            <div class="row">
                                                                                                                 <div class="col-md-4"> <label><input type="checkbox" name="catagory[]" value="Religious Sites" > Religious Sites</label></div>
                                                                                                                <div class="col-md-4"><label><input type="checkbox" name="catagory[]" value="Wildlife and Natural Reserves" > Wildlife and Natural Reserves</label></div>
                                                                                                                <div class="col-md-4">  <label><input type="checkbox" name="catagory[]" value="Adventure and Trekking" > Adventure and Trekking</label></div>
                                                                                                    </div>
                                                                                                    <!--                                                                                                    <div class="row">
                                                                                                    <div class="col-md-4">  <label><input type="checkbox" name="catagory[]" value="G" > G</label></div>
                                                                                                    <div class="col-md-4"> <label><input type="checkbox" name="catagory[]" value="G" > G</label></div>
                                                                                                    <div class="col-md-4"> <label><input type="checkbox" name="catagory[]" value="G" > G</label></div>
                                                                                                    -->

                                                                                                    </div>   
                                                                                                </div>





                                                            <!--provinece to be done later                                                            <div class="form-group">
                                                                <label for="">Provinence</label>
                                                                <input type="" class="form-control place_provinence" name="p_provinence" >
                                                            </div>
                                                            -->

                                                            </div>
                                                           
                                                            
                                                    <div class="row col-12 " >
                                                                <div class="col-6">
                                                                                <button type="button" class="next-button btn btn-dark "  onclick="showStep('step1')">Previous</button>
                                                                </div>
                                                                <div class="col ">
                                                                <button type="submit" name="submit" class="btn btn-primary float-right" >Submit</button>
                                                                </div>                                            
                                                            </div>
                                                                    </div>
                                                                    
                                                            

                                                                    
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                           </div>
                                        </div>
                                  </div>
                             </div>
                        </div>
                    </div>
                </div>
            <?php
       } }}
        ?>
                <script>
                        function showStep(step) {
                        if (step === 'step1') {
                            document.getElementById('step1').style.display = 'block';
                            document.getElementById('step2').style.display = 'none';
                            
                        }else if(step === 'step2'){
                            document.getElementById('step1').style.display = 'none';
                            document.getElementById('step2').style.display = 'block';
                            
                          

                        } 
                    }
                    </script>
                
<?php
include("include/script.php");



?>