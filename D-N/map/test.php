<!DOCTYPE html>
<html>
<head>
    <title>Display Locations on Map</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <input type="text" id="Location_input" placeholder="Enter place name or latitude and longitude (e.g., New York or 27.69252500975539, 85.34784070050105)">
    <button onclick="displayLocationAndNearbyPlaces()">Show Location and Nearby Places</button>
    <div id="map"></div>

    <script>
        var map;
        var markers = [];
        var infoWindow;
        var userLocationMarker;

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
                        userLocationMarker = addMarker(userLocation);

                        // Center the map on the user's location
                        map.setCenter(userLocation);
                        //console.log(userLocation);

                    },
                    function(error) {
                        console.error('Error getting user location: ', error);
                    }
                );
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }

        function displayLocationAndNearbyPlaces() {
            var locationInput;
            locationInput = document.getElementById("Location_input").value;
            console.log(locationInput);

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
        
/*function fetchCoordinatesFromNumber(number) {
            var locationInput = number;
            //console.log(locationInput);
            //console.log(typeof locationInput);

            // Parse the latitude and longitude values from the input
            var coordinates = locationInput.split(",");

            var latitude = parseFloat(coordinates[0].trim());

            var longitude = parseFloat(coordinates[1].trim());

            // Check if the parsed latitude and longitude are valid numbers
            if (!isNaN(latitude) && !isNaN(longitude)) {
                // Create a LatLng object with the parsed coordinates
                var location = new google.maps.LatLng(latitude, longitude);

                // Clear any existing markers on the map
                clearMarkers();

                // Add a marker for the specified location
                addMarker(location);

                // Fetch the top 5 places with the shortest distance from the specified location
                fetchNearbyPlaces(location);
            } else {
                console.error("Invalid latitude and longitude number");
            }
            console.log("Latitude: " + latitude);
            console.log("Longitude: " + longitude);
        }*/

        // Function to fetch coordinates from the database based on the place name
      function fetchCoordinatesFromPlaceName(placeName) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_coordinates.php?placeName=' + encodeURIComponent(placeName), true);
    xhr.onload = function() {
        //console.log(xhr.responseText); 
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (Array.isArray(response)) {
                for (var i = 0; i < response.length; i++) {
                    var location = response[i];
                    var latitude = parseFloat(location.latitude);
                    var longitude = parseFloat(location.longitude);
                    var imgUrl = location.imageUrl;

                    //console.log("Location " + i + ": Latitude:", latitude);
                    //console.log("Location " + i + ": Longitude:", longitude);
                    //console.log("Location " + i + ": imgUrl:", imgUrl);

                    if (!isNaN(latitude) && !isNaN(longitude) ) {
                        var locationCoords = new google.maps.LatLng(latitude, longitude);
                        //console.log(locationCoords);
                        clearMarkers();
                        addMarker(locationCoords,imgUrl);
                        fetchNearbyPlaces(locationCoords); // Call fetchNearbyPlaces with the user's location
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
//start
function displayLocationInfo1(marker, imgUrl, name, description, id) {
  var location = marker.getPosition();

  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ location: location }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        var locationInfo = results[0].formatted_address;
        var infoContent = '<div class="container mt-3">' +
                          '<div class="row">' +
                          '<div class="col-md-6">' +
                          '<div class="text-center">' +
                          '<img src="' + imgUrl + '" class="img-fluid" alt="Location Image">' +
                          '</div>' +
                          '</div>' +
                          '<div class="col-md-6">' +
                          '<div class="p-3">' +
                          '<p class="h4">Location Information</p>' +
                          '<p>' + locationInfo + '</p>' +
                          '<h2>Name: ' + name + '</h2>' +
                          '<p>' + description + '</p>' +
                          '</div>' +
                          '</div>' +
                          '</div>' +
                          '</div>' + '<span id="closeButton" onclick="hideSecondDiv()">&times;</span>';

        // Set the content in the <div id="info">
        document.getElementById('info').innerHTML = infoContent;
      } else {
        console.error("No results found for the location.");
      }
    } else {
      console.error("Geocoder failed due to: " + status);
    }
//end










        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

        function addMarker(location,imgUrl) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
            marker.addListener('click', function() {
                displayLocationInfo(marker,imgUrl);
            });
        }

        function fetchNearbyPlaces(userLocation) {
            // Clear any existing markers
            clearMarkers();
            
            // Add the user's location marker
            userLocationMarker = addMarker(userLocation);
            
            // AJAX request to fetch the top 5 places with the shortest distance
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_coordinates.php?latitude=' + userLocation.lat() + '&longitude=' + userLocation.lng(), true);

            xhr.onload = function() {
                //console.log(xhr.responseText); 
                if (xhr.status === 200) {
                    var places = JSON.parse(xhr.responseText);
                    console.log(places);
                    displayNearbyPlaces(places);
                } else {
                    console.error("Error fetching nearby places");
                }
            };
            xhr.send();
        }

        function displayNearbyPlaces(places) {
            for (var i = 0; i < places.length; i++) {
                var location = new google.maps.LatLng(places[i].latitude, places[i].longitude);
                var imageUrl = places[i].imageUrl; // Assuming the place data contains an 'imageUrl' field
                //console.log(imageUrl);
                addMarker(location, imageUrl);
                
            }
        }

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
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0M-UwBtxishqPfQVym_g369dW3MQk3Ys&callback=initMap"></script>
</body>
</html>
