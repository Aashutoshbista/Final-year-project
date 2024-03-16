 



<?php

include("include/header.php");

include("include/database.php");
?>



<div class="content-wrapper pt-2">
            <div class="content">
                <div class="container">
                <div class="row">
        <div class="col-md-12">
          <?php
          include("include/message.php");
          ?>
        </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                                                
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                    Add New Place
                                       
                                    </h4>
                                </div>
                                <div class="card-body">

                                            <div class="admin-content-container">
                                                    <h2 class="admin-heading"></h2>
                                                    <form id="createProduct" action="code.php" class="add-post-form row" method="POST" enctype="multipart/form-data">
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
                                                            
                                                            <!--Image-->
                                                            </div>
                                                            
                                                                    </div>
                                                            <!--End of image-->
                                                                    </div>
                                                            <!--Longitude and Latitude-->
                                                            <div class="row">
                                                            <div class="col">

                                                           
                                                                    </div>
                                                                    </div>
                                                            <!--End of long and lati-->

                                                            </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="">Place Description</label>
                                                                <textarea class="form-control place_description" name="p_description" placeholder="Enter The address if you dont know how to put Longitude and Latitude" rows="8" cols="80" requried></textarea>
                                                            </div>
                                                            <div class="show-error"></div>

                                                                        </div>
                                                                       


                                                                <div class="col mt-2 d-flex ">
                                                                <button type="submit" name="submitplaces" class="btn btn-primary float-right " >Submit</button>
                                                                </div>       

                                                                    </div>


                                                        <div id="step2" style="display:none;" style="height:50%;">
                                                        <div class="row"> 
                                                        <div class="col-md-6">
                                                            

                                                                   
                                                            

                                                           
                                                            
                                                              




                                                           

                                                            </div>
                                                           
                                                            
                                                    <div class="row col-12 pt-2" >
                                                                <div class="col-6">
                                                                                <button type="button" class="next-button btn btn-dark "  onclick="showStep('step1')">Previous</button>
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
include('include/footer.php');?>