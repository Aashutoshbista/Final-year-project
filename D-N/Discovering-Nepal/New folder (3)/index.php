<?php
include('authentication.php');
include('database.php');
include('header.php');




?>






<main>
    <div class="container-fluid p-0">
    <div class="nav pt-1">
      
    </div>
        <div class="row">
        <div class="col-md-12">
          <?php
          include("admin/message.php");
          ?>
        </div>
                        <!--Section: Block Content-->
          
                        <div class="container">
                               <div class="row" style="height: 700px;">
                              
                                <div class="col-12  " id="map" style="height:100%;width=100%" ></div>
          
                              <script >
                                  function initMap(){
                                    var x=navigator.geolocation;
                                    x.getCurrentPosition(sucess,failure);
                                    function sucess(position){
                                      var mylat=position.coords.latitude;
                                      var mylong=position.coords.longitude;
                                      var location=new google.maps.LatLng(mylat,mylong);

                                      var map=new google.maps.Map(document.getElementById("map")
                                      ,{
                                          zoom:10,
                                          center:location
                                        });
                                        

                                        var marker=new google.maps.Marker({
                                          position:location,
                                          map:map
                                        
                                        });
                                      }
                                    }
                                    function failure(){
                                      
                                    }
                                </script>
                                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtbzarTMw_16HlOy-duoMrIaB2DYqWzRQ&callback=initMap">

                                </script>
                                <!--
                                
                               <div class="col-4 bg-white">comments and review</div>
-->
                               


                              </div>
                        </div>


                       



</main>

<!--footer section-->
