
<?php        
include('include/database.php');
session_start();



if(isset($_GET['submit'])){
  
    $placeid=$_GET['submit'];
    $user=$_SESSION['auth_user']['user_id'];
 
    $query="INSERT INTO visited(place_id,userid) 
    VALUES('$placeid','$user')";
$queryup_run=mysqli_query($conn,$query);

if($queryup_run){
   
    $_SESSION['status']="Updated   ";
    header("Location:Placesaccording.php");
    
}else{
    $_SESSION['status']=" UnSucessfully  ";
    header("Location:Placesaccording.php");
}


}


if(isset($_GET['submit2'])){
  
    $placeid=$_GET['submit2'];
    $user=$_SESSION['auth_user']['user_id'];
 
    $query="INSERT INTO visited(place_id,userid) 
    VALUES('$placeid','$user')";
$queryup_run=mysqli_query($conn,$query);

if($queryup_run){
   
    $_SESSION['status']="Updated   ";
    header("Location:specificrecomm.php");
    
}else{
    $_SESSION['status']=" UnSucessfully  ";
    header("Location:specificrecomm.php");
}


}







?>