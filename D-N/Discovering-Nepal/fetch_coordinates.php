<?php
// Include your database connection here...
include('include/database.php');

if (isset($_GET['latitude']) && isset($_GET['longitude'])) {
    $latitude = floatval($_GET['latitude']);
    $longitude = floatval($_GET['longitude']);

    // Calculate distances using Haversine formula
    $query = "SELECT *, 
        (6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(latitude))))
        AS distance
        FROM locations
        ORDER BY distance ASC
        LIMIT 3";

    $result = mysqli_query($conn, $query);
    $places = array();
    error_log('Fetching coordinates for latitude: ' . $latitude . ', longitude: ' . $longitude);
error_log('Query: ' . $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $places[] = array(
                //'place_name' => $row['place_name'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'imageUrl' => $row['imgUrl'],
                'name'  => $row['place_name'],
                'post_id' => $row['id'],
                'discription'=>$row['discription']
                
                //'distance' => $row['distance']
            );
        }
        echo json_encode($places);
    } else {
        echo json_encode(array('success' => false, 'message' => 'No nearby places found'));
    }
} else if (isset($_GET['placeName'])) {
    $placeName = mysqli_real_escape_string($conn, $_GET['placeName']);

    $query = "SELECT latitude, longitude FROM locations WHERE place_name LIKE '%$placeName%' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];

        // Calculate distances using Haversine formula
        $query = "SELECT *, 
            (6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(latitude))))
            AS distance
            FROM locations
            ORDER BY distance ASC
            LIMIT 3";

        $result = mysqli_query($conn, $query);
        $places = array();

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $places[] = array(
                    //'place_name' => $row['place_name'],
                    'latitude' => $row['latitude'],
                    'longitude' => $row['longitude'],
                    'imageUrl' => $row['imgUrl'],
                    'name'      => $row['place_name'],
                    'post_id' => $row['id'],
                    'discription'=>$row['discription']
                    //'distance' => $row['distance']
                );
            }

            echo json_encode($places);
        } else {
            echo json_encode(array('success' => false, 'message' => 'No nearby places found'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Place not found'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}
?>
