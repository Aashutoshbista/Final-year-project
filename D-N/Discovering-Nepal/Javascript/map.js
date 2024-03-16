
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
                userLocationMarker = addMarker(userLocation,null,true);
                fetchCoordinatesFromNumber(userLocation);

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

function fetchCoordinatesFromNumber(locationInput) {
// Check if locationInput is an object with lat and lng properties
if (typeof locationInput === 'object' && locationInput.hasOwnProperty('lat') && locationInput.hasOwnProperty('lng')) {
var latitude = parseFloat(locationInput.lat);
var longitude = parseFloat(locationInput.lng);

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
} else {
console.error("Invalid locationInput format. Expected an object with 'lat' and 'lng' properties.");
}
}


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


function clearMarkers() {
     for (var i = 0; i < markers.length; i++) {
// Check if the current marker is not the user location marker
if (markers[i] !== userLocationMarker) {
    markers[i].setMap(null); // Remove the marker from the map
}
}
markers = [userLocationMarker]; // Reset the markers array to only include the user location marker
}

function addMarker(location,imgUrl,isUserLocation = false) {
    var marker;
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
        displayLocationInfo(marker);
        displayLocationInfo1(marker,imgUrl);

    });
}

function fetchNearbyPlaces(userLocation) {
    // Clear any existing markers
     clearMarkersExceptUserLocation();

// Add the user's location marker
userLocationMarker = addMarker(userLocation, null, true);
    
    // AJAX request to fetch the top 5 places with the shortest distance
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_coordinates.php?latitude=' + userLocation.lat() + '&longitude=' + userLocation.lng(), true);

    xhr.onload = function() {
        console.log(xhr.responseText); 
        if (xhr.status === 200) {
            var places = JSON.parse(xhr.responseText);
            console.log(places);
            displayNearbyPlaces(places);
            displayNearbyPlaces1(places);
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
        var imageUrl = places[i].imageUrl; // Assuming the place data contains an 'imageUrl' field
        //console.log(imageUrl);
        addMarker(location, imageUrl);
        
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

function displayLocationInfo1(marker, imgUrl) {
var location = marker.getPosition();

var geocoder = new google.maps.Geocoder();
geocoder.geocode({ location: location }, function (results, status) {
if (status === google.maps.GeocoderStatus.OK) {
if (results[0]) {
var locationInfo = results[0].formatted_address;
var infoContent = '<div><strong>' + locationInfo + '</strong></div>';

if (imgUrl) {
  infoContent += '<div><img src="' + imgUrl + '" width="200" height="150" alt="Location Image"></div>';
}

// Set the content in the <div id="info">
document.getElementById('info').innerHTML = infoContent;
} else {
console.error("No results found for the location.");
}
} else {
console.error("Geocoder failed due to: " + status);
}
});
}


