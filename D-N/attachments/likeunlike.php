<?php
include('database.php');

$userid = 244;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$postid = $_POST['postid'];
$type = $_POST['type'];
$places = $_POST['places']; 

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM like_unlike WHERE postid=".$postid." and userid=".$userid;
$result = mysqli_query($conn,$query);
if (!$result) {
    die('Query execution error: ' . mysqli_error($conn));
}
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];


if($count == 0){
    $insertquery = "INSERT INTO like_unlike(userid,postid,type) values(".$userid.",".$postid.",".$type.")";
    mysqli_query($conn,$insertquery);
}else {
    $updatequery = "UPDATE like_unlike  SET type=" . $type . " where userid=" . $userid . " and postid=" . $postid;
    mysqli_query($conn,$updatequery);
}


// count numbers of like and unlike in post
$query = "SELECT COUNT(*) AS cntLike FROM like_unlike WHERE type=1 AND postid=".$postid;
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query execution error: ' . mysqli_error($conn));
}

$fetchlikes = mysqli_fetch_array($result);
$totalLikes = $fetchlikes['cntLike'];

$query = "SELECT COUNT(*) AS cntUnlike FROM like_unlike WHERE type=0 AND postid=".$postid;
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query execution error: ' . mysqli_error($conn));
}

$fetchunlikes = mysqli_fetch_array($result);
$totalUnlikes = $fetchunlikes['cntUnlike'];

// initalizing array
$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);
}
?>
