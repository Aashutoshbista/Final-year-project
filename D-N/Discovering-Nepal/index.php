<?php
include("include/database.php");
include('include/header.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Locations on Map</title>
    <style>
        #map { 
         width: 100%;
    height: 700px;
    background-color: lightblue;
    display: block;
  }
 #closeButton {
  position: absolute;
  top: 5px;
  right: 20px;
  cursor: pointer;
  font-size: 24px;
  font-weight: bold;
  width: 30px;
  height: 30px;
  text-align: center;
  line-height: 30px;

}
  /* Styles for the second div (hidden initially) */
  #info {
    width: 0;
    height: 200px;
    background-color: ;
    display: none;
    overflow: hidden;
    transition: width 0.5s; /* Add smooth transition animation */
    position: relative;
    overflow-x: hidden;
  }


  /* Styles for the container div (to hold both divs in the same row) */
  #container {
    display: flex;
  }
.img-fluid {
  width: 100%;
  height: 300px;
}



    </style>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>







     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
          include("include/message.php");
          ?>
       
    
    <div id="container">
    
         
    
  
  <div id="map"  style="float: left;"></div>

  <div id="info" style="height: 700px; width: 40%; overflow-y: auto; display: none;">
    <!-- Container for the location information -->
    <div class="container mt-3">
      <div class="row">
        <div class="col-md-12">
          <div class="text-center">
            <!-- Image holder -->
            <img id="locationImage" src="" class="img-fluid" alt="Location Image">
          </div>
        </div>
        <div class="col-md-12">
          <div class="p-3">
            <!-- Location Information -->
            
            <!-- Name holder -->
            <h2 id="locationName"></h2>
            <p class="h4">Location Information</p>
            
            <p id="locationInfo"></p>
          </div>
        </div>
      </div>
    </div>
  <!-- Close button -->
  <span id="closeButton" onclick="hideSecondDiv()">&times;</span>
	<!--<button type="button"  class="button btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" style="position: absolute; top: ; right: 84px;">
      Comment
    </button>-->
    
    <div id="postsContainer"></div>
   <!-- Bootstrap Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle" style="text-align:center;">Comment</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Modal content goes here -->
            <form method="POST" id="comment_form">
              <!--<div class="form-group">
                <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
              </div>-->
              <div class="form-group">
                <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
              </div>
              <div class="form-group">
                <input type="hidden" name="place_name" id="place_name" value="" />
                <span id="result"></span>
               
                 
         
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
              </div>
            </form>
            <span id="comment_message"></span>
            <br />
            <div id="display_comment"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
        </div>
      </div>
    </div>
    <!-- End of Bootstrap Modal -->
</div>


        
</div>

    <div id="nerby">
        
    </div>

    <script>
     
        var map;
        var markers = [];
        var infoWindow;
        var userLocationMarker;
        //var userMarkerIcon = 'user_marker_icon.png';
        var userMarkerIcon;

        function initMap() {
            var center = { lat: 0, lng: 0 };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: center
            });
            infoWindow = new google.maps.InfoWindow();

            // Add a click event listener to the map
            map.addListener('click', function() {
                infoWindow.close();
            });
            userMarkerIcon = {
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: 'blue',
                fillOpacity: 1,
                strokeWeight: 0,
                scale: 8,
            };
      
            getUserLocation();
        }

        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        // Add a marker for the user's location

                        userLocationMarker = addMarker(userLocation,null,null,null,null,true);
                        fetchCoordinatesFromNumber(userLocation);

                        // Center the map on the user's location
                        map.setCenter(userLocation);
                        //console.log(userLocation);

                    },
                    function(error) {
                        console.error('Error getting user location: ', error);
                       }
                )       ;
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }

        function displayLocationAndNearbyPlaces() {
            var locationInput;
            locationInput = document.getElementById("Location_input").value;
           // console.log(locationInput);

            //fetchCoordinatesFromPlaceName(locationInput);
                // If both latitude and longitude are provided and valid, proceed with displaying nearby places
                //if (!isNaN(locationInput)) {
                   // var numericValue = parseFloat(locationInput);
                   // if (!isNaN(numericValue)) {
                    //        fetchCoordinatesFromNumber(numericValue);
                   // } else {
                    //         console.log("Invalid numeric input.");
                   // }
                    //fetchCoordinatesFromNumber(locationInput);

               // }else{
                    // If latitude and longitude are not provided or invalid, assume it's a place name
                    fetchCoordinatesFromPlaceName(locationInput);
                //} //else{
                //console.error("Please enter a valid place name or latitude and longitude.");
            //}
        }
        
function fetchCoordinatesFromNumber(locationInput) {
    // Check if locationInput is an object with lat and lng properties
    if (typeof locationInput === 'object' && locationInput.hasOwnProperty('lat') && locationInput.hasOwnProperty('lng')) {
        var latitude = parseFloat(locationInput.lat);
        var longitude = parseFloat(locationInput.lng);

        // Check if the parsed latitude and longitude are valid numbers
        if (!isNaN(latitude) && !isNaN(longitude)) {
            // Create a LatLng object with the parsed coordinates
            var location = new google.maps.LatLng(latitude, longitude);
            //console.log(location);

            // Clear any existing markers on the map
            clearMarkers();

            // Add a marker for the specified location
            addMarker(location);

            // Fetch the top 5 places with the shortest distance from the specified location
            fetchNearbyPlaces(location);
        } else {
            console.error("Invalid latitude and longitude number");
        }
        //console.log("Latitude: " + latitude);
        //console.log("Longitude: " + longitude);
    } else {
        console.error("Invalid locationInput format. Expected an object with 'lat' and 'lng' properties.");
    }
}


        // Function to fetch coordinates from the database based on the place name
      function fetchCoordinatesFromPlaceName(placeName) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_coordinates.php?placeName=' + encodeURIComponent(placeName), true);
    xhr.onload = function() {
        console.log(xhr.responseText); 
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (Array.isArray(response)) {
                for (var i = 0; i < response.length; i++) {
                    var location = response[i];
                    var latitude = parseFloat(location.latitude);
                    var longitude = parseFloat(location.longitude);
                    var imgUrl = location.imageUrl;
                    var name  = location.name;
                    var place_id  = location.post_id;
                    var discription=location.discription;

                    //console.log("Location " + i + ": Latitude:", latitude);
                    //console.log("Location " + i + ": Longitude:", longitude);
                    //console.log("Location " + i + ": imgUrl:", imgUrl);
                    console.log(discription);

                    if (!isNaN(latitude) && !isNaN(longitude) ) {
                        var locationCoords = new google.maps.LatLng(latitude, longitude);
                        //console.log(locationCoords);
                        clearMarkers();
                        addMarker(locationCoords,imgUrl,name,place_id,discription);
                        fetchNearbyPlaces(locationCoords,imgUrl,name,place_id,discription); // Call fetchNearbyPlaces with the user's location
                    } else {
                        console.error("Invalid latitude and longitude for Location " + i);
                    }
                }
            } else {
                console.error("Invalid response format: Expected an array");
            }
        } else {
            console.error("Error fetching place coordinates");
        }
    };
    xhr.send();
}


        function clearMarkers() {
             for (var i = 0; i < markers.length; i++) {
        // Check if the current marker is not the user location marker
        if (markers[i] !== userLocationMarker) {
            markers[i].setMap(null); // Remove the marker from the map
        }
    }
    markers = [userLocationMarker]; // Reset the markers array to only include the user location marker
}

        function addMarker(location,imgUrl,name,place_id,discription,isUserLocation = false) {
            var marker=[];
            console.log('isUserLocation:', isUserLocation);
            if (isUserLocation) {
                marker = new google.maps.Marker({
                position: location,
                map: map,
                icon: userMarkerIcon, // Use the custom blue circle icon for the user's location
            });
            } else {
                marker = new google.maps.Marker({
                position: location,
                map: map,
              
            //icon: imgUrl, // Use the respective image for other nearby places
            });
            }
            markers.push(marker);
            marker.addListener('click', function() {
                showSecondDiv();
                displayLocationInfo(marker);
                displayLocationInfo1(marker,imgUrl,name,place_id,discription);

            });
        }

      function fetchNearbyPlaces(userLocation,imgUrl,name,discription) {
            // Clear any existing markers
             clearMarkersExceptUserLocation();

    // Add the user's location marker
    userLocationMarker = addMarker(userLocation, null,null,null,null, true);
            
            // AJAX request to fetch the top 5 places with the shortest distance
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_coordinates.php?latitude=' + userLocation.lat() + '&longitude=' + userLocation.lng(), true);

            xhr.onload = function() {
                //console.log(xhr.responseText); 
                if (xhr.status === 200) {
                    var places = JSON.parse(xhr.responseText);
                   //console.log(places);
                    displayNearbyPlaces(places);
                   
                } else {
                    console.error("Error fetching nearby places");
                }
            };
            xhr.send();
        }

function clearMarkersExceptUserLocation() {
    for (var i = 0; i < markers.length; i++) {
        if (markers[i] !== userLocationMarker) {
            markers[i].setMap(null);
        }
    }
    markers = [userLocationMarker];
}

        function displayNearbyPlaces(places) {
            for (var i = 0; i < places.length; i++) {
                var location = new google.maps.LatLng(places[i].latitude, places[i].longitude);
                var imageUrl = places[i].imageUrl;
                var name = places[i].name; 
                var discription = places[i].discription;
                var post_id = places[i].post_id;// Assuming the place data contains an 'imageUrl' field
                //console.log(post_id);
                addMarker(location, imageUrl,name,post_id,discription);
                
            }
        }

        /*function displayNearbyPlaces1(places) {
  var infoContent = '';

  if (places.length === 0) {
    infoContent = '<div>No nearby places found.</div>';
  } else {
    for (var i = 0; i < places.length; i++) {
      var location = new google.maps.LatLng(places[i].latitude, places[i].longitude);
      var imageUrl = places[i].imageUrl;

      infoContent += '<div><strong>Place ' + (i + 1) + '</strong></div>';
      infoContent += '<div>Latitude: ' + places[i].latitude + '</div>';
      infoContent += '<div>Longitude: ' + places[i].longitude + '</div>';

      if (imageUrl) {
        infoContent += '<div><img src="' + imageUrl + '" width="200" height="150" alt="Location Image"></div>';
      }
    }
  }

  // Set the content in the <div id="info">
  document.getElementById('nerby').innerHTML = infoContent;
}*/




        function displayLocationInfo(marker,imgUrl) {
            // Fetch additional information about the location from your database or an external API
            var location = marker.getPosition();

            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: location }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var locationInfo = results[0].formatted_address;

                         // Create an HTML content string for the info window
                        var infoWindowContent = '<div><strong>' + locationInfo + '</strong></div>';

                // Add the image to the info window content
                        if (imgUrl) {
                            infoWindowContent += '<div><img src="' + imgUrl + '" width="200" height="150" alt="Location Image"></div>';
                        }

                        infoWindow.setContent(infoWindowContent);
                        infoWindow.open(map, marker);
                    } else {
                        console.error("No results found for the location.");
                    }
                } else {
                    console.error("Geocoder failed due to: " + status);
                }
            });
        }

  function displayLocationInfo1(marker, imgUrl, name,place_id,discription) {
  var location = marker.getPosition();
  console.log(discription);

  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ location: location }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        //var locationInfo = results[0].formatted_address;

        // Set the content of the elements
        document.getElementById('locationImage').src = imgUrl;
        document.getElementById('locationInfo').textContent = discription;
        document.getElementById('locationName').textContent = "Name: " + name;
     



        // Set the value of the hidden input field for place name
        var placeNameInput = document.getElementById('place_name');
        placeNameInput.value = name; // Assuming 'name' is the place name
        document.getElementById('result').textContent = placeNameInput.value;


          $.ajax({
              url: 'get_posts.php',
              type: 'POST',
              data: {
              userid: 123,
              postid: place_id,
              place_name: name,
              },
              dataType: 'json',
                  success: function (response) {
      // Update the UI with the received output from the server
                    var output = response.output;
                      //console.log('Response:', response);
                      //console.log('Output:', output);
                    //console.log(output);
                   
                    document.getElementById('postsContainer').innerHTML = output;
                     $(".like, .unlike").click(function(){
                     //$(document).on('click', '.like', function () {
                    var id = this.id;   // Getting Button id
                    var split_id = id.split("_");

                    var text = split_id[0];
                    var postid = split_id[1];
                    console.log(postid);
                    var type = 0;
                     if(text == "like"){
                         type = 1;
                      }else{
                      type = 0;
                      }

                      likeDislikePost(postid, type,name);

                    //var postid = this.id.replace('like_', ''); // Extract the post ID from the button's ID
                     //var tableName = name; 
                     //var action = 1; // Specify the action as 'like'
                      //likeDislikePost(postid, action);
                     console.log('Button clicked!');// Replace 'your_table_name' with the actual table name
                    //likePost(postid, tableName);
                 });

                    /*$(document).on('click', '.unlike', function () {
                   var postid = this.id.replace('unlike_', ''); // Extract the post ID from the button's ID
                    //var tableName = name;
                      var action = 0; // Specify the action as 'dislike'
                      //likeDislikePost(postid, action); // Replace 'your_table_name' with the actual table name
                    //dislikePost(postid, tableName);
                    //console.log(postid);
                   });*/
                },
                error: function (error) {
                console.error('Error:', error);
                },
              });



        // Show the <div id="info">
        document.getElementById('info').style.display = 'block';
      } else {
        console.error("No results found for the location.");
      }
    } else {
      console.error("Geocoder failed due to: " + status);
    }
  });
}

    function showSecondDiv() {
      var div2 = document.getElementById("info");
      div2.style.display = "block";
      div2.style.width = "40%";
    }

 function hideSecondDiv() {
      var div2 = document.getElementById("info");
      div2.style.display = "none";
      div2.style.width = "0";
    }
    // Function to display the modal
function showModal() {
  $('#exampleModalLong').modal('show');
}

// Function to hide the modal
function hideModal() {
  $('#exampleModalLong').modal('hide');
}







/*function likePost(postid, tableName) {
    $.ajax({
        url: 'likeunlike.php', // PHP script to handle like
        type: 'POST',
        data: {
            postid: postid,
            tableName: tableName // Pass the table name as a parameter
        },
        dataType: 'json',
        success: function (response) {
            // Update the UI with the updated like count
            $('#likes_' + postid).text(response.total_likes);
            $('#like_' + postid + '_icon').css("color", "#ffa449");
        },
        error: function (error) {
            console.error('Error:', error);
        },
    });
}

// AJAX function to handle dislike
function dislikePost(postid, tableName) {
    $.ajax({
        url: 'likeunlike.php', // PHP script to handle dislike
        type: 'POST',
        data: {
            postid: postid,
            tableName: tableName // Pass the table name as a parameter
        },
        dataType: 'json',
        success: function (response) {
            // Update the UI with the updated dislike count
            $('#unlikes_' + postid).text(response.total_unlikes);
            $('#unlike_' + postid + '_icon').css("color", "#ffa449");
        },
        error: function (error) {
            console.error('Error:', error);
        },
    });
}*/
// Function to handle the like and dislike action
// Function to handle the like and dislike action
function likeDislikePost(postid,type,name) {
  $.ajax({
            url: 'likeunlike.php',
            type: 'post',
            data: {
              postid:postid,
              type:type,
              places:name},
            dataType: 'json',
            success: function(data){
              console.log(data);
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+postid).text(likes);        // setting likes
                $("#unlikes_"+postid).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid).css("color","#ffa449");
                    $("#unlike_"+postid).css("color","lightseagreen");
                    $("#like_"+postid+ "_icon").css("color","#ffa449");
                    $("#unlike_"+postid+ "_icon").css("color","lightseagreen");
                }

                if(type == 0){
                    $("#unlike_"+postid).css("color","#ffa449");
                    $("#like_"+postid).css("color","lightseagreen");
                    $("#unlike_"+postid+ "_icon").css("color","#ffa449");
                    $("#like_"+postid+ "_icon").css("color","lightseagreen");
                }


            }
            
        });
}







  </script>


  <script>
$(document).ready(function(){
    var place_name = $('#place_name').val();
    //console.log(place_name);

     function load_comment(place_name) {
        $.ajax({
          url: "fetch_comment.php",
          method: "POST",
          data: { place_name: place_name },
          success: function (data) {
            $('#display_comment').html(data); // Display comments in the container
          }
        });
      }

      // Load comments initially on page load
      load_comment(place_name);

    $('#exampleModalLong').on('shown.bs.modal', function (e) {
    var place_name_modal = $('#place_name').val();
      load_comment(place_name_modal);
    });

 $('#comment_form').on('submit', function(event) {
  event.preventDefault();
  var place_name = $('#place_name').val();
  var form_data = $(this).serialize() + '&place_name=' + place_name;
  console.log('Hellos');
   console.log(form_data);

   

  $.ajax({
   url: "add_comment.php",
   method: "POST",
   data: form_data,
   dataType:"JSON",
   success: function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment(place_name);
    }

   }
  })
  //load_comment(place_name);
 });

 /*load_comment(place_name);

 function load_comment(place_name) {
  $.ajax({
    url: "fetch_comment.php",
    method: "POST",
    data: { place_name: place_name },
    success: function(data) {
      $('#display_comment').html(data);
    }
  });
}*/


 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
   var modalBody = $(this).closest('.modal-content').find('.modal-body');
  modalBody.animate({
    scrollTop: 0
  }, "slow");

  console.log("Reply button clicked!");
  


 });
 
});
</script>
<script>
    $(document).ready(function(){
      var places = $('#place_name').val();
       console.log(places);
       console.log('hello');

      // like and unlike click
      $(".like, .unlike").click(function(){
        // Rest of your JavaScript code
        // ...

        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }
        console.log('postid:', postid);
    console.log('type:', text);
    console.log('places:', places);
     console.log('Button clicked!');
        // AJAX Request
        $.ajax({
            url: 'likeunlike.php',
            type: 'POST',
            data: {postid:postid,type:type,places:places},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+postid).text(likes);        // setting likes
                $("#unlikes_"+postid).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid).css("color","#ffa449");
                    $("#unlike_"+postid).css("color","lightseagreen");
                    $("#like_"+postid+ "_icon").css("color","#ffa449");
                    $("#unlike_"+postid+ "_icon").css("color","lightseagreen");
                }

                if(type == 0){
                    $("#unlike_"+postid).css("color","#ffa449");
                    $("#like_"+postid).css("color","lightseagreen");
                    $("#unlike_"+postid+ "_icon").css("color","#ffa449");
                    $("#like_"+postid+ "_icon").css("color","lightseagreen");
                }


            }
            
        });
      });
    });
  </script>


 
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0M-UwBtxishqPfQVym_g369dW3MQk3Ys&callback=initMap"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



