<?php
include('include/database.php');
                                      if(isset($_POST['submitsearch'])){
                                        $search=mysqli_real_escape_string($conn,$_POST['searchinput']);
                                        $query="SELECT *  FROM places WHERE p_name LIKE '%$search%' OR p_prov LIKE '%$search%' OR p_catagory LIKE '%$search%' OR p_type LIKE '%$search%'";
                                        $result=mysqli_query($conn,$query);
                                        $queryResult=mysqli_num_rows($result);
                                        if($queryResult > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                            echo $row["p_longitude"];
                                        }
                                               

                                      }}
                                        /*
                                        
                                        $search=mysqli_real_escape_string($conn,$_POST['searchinput']);
                                        $query="SELECT p_longitude , p_latitude  FROM places WHERE p_name LIKE '%$search%' OR p_prov LIKE '%$search%'OR p_catagory LIKE '%$search% p_type LIKE '%$search%'";
                                        $result=mysqli_query($conn,$query);
                                        $queryResult=mysqli_num_rows($result);
                                        if($queryResult > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                              ?>
                                              
                                                    <?php

                                              }
                                            
                                            
                                            
                                            
                                            
                                            
                                                                                        }
                                                                                      }                                      
                                                                                          
                                                                                          ?>


<!--
                                          <script>
                                              $longitude=$row["p_longitude"];
                                              $latitude=$row["p_latitude"];
                                              function initMap(){
                                                    var location={$latitude,$longitude};
                                                    var map=new google.maps.Map(document.getElementById("map"){
                                                      zoom:10,
                                                      center:location
                                                    });
                                                    var marker=new google.maps.Marker({
                                                      position:location,
                                                      map:map
                                                    });
                                                  }
                                                    </script>
                                                    */

                                                    