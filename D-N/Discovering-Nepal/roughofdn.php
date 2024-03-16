<?php

include "database.php";
include('authentication.php');
include('header.php');

$userid = $_SESSION['auth_user']['user_id'] ;
$username = $_SESSION['auth_user']['user_name'] ;
$placeid = $_POST['placeid'];

$rating = $_POST['rating'];
$query = "SELECT place_name FROM locations WHERE id ='$placeid'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $placename=$row['place_name'];
}


// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM post_rating WHERE placeid=".$placeid." and userid=".$userid;

$result = mysqli_query($conn,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if($count == 0){
    $insertquery = "INSERT INTO post_rating(userid,placeid,rating,Name,Place) values(".$userid.",".$placeid.",".$rating.",".$username.",".$placename.")";
    mysqli_query($conn,$insertquery);
}else {
    $updatequery = "UPDATE post_rating SET rating=" . $rating . " where userid=" . $userid . " and placeid=" . $placeid;
    mysqli_query($conn,$updatequery);
}


// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE placeid=".$placeid;
$result = mysqli_query($conn,$query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);