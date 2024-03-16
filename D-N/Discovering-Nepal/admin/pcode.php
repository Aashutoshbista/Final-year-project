<?php
include('authentication.php');
include('config/dbcon.php');

/*here is code for to add  */
/*
 $query="INSERT INTO places(p_name,p_longitude,p_latitude,p_discription,p_image,p_catagory,p_prov,p_type) 
 VALUES('$name','$p_longitude','$p_latitude','$$p_description','$$dataofimg','$dataofcat','$p_prov','$p_type')";
 $query_run=mysqli_query($conn,$query);
 */
/*
if(isset($_POST['submit'])){
    $name=$_POST['p_name'];
    $p_prov=$_POST['provinces'];
    $p_longitude=$_POST['p_longitude'];
    $p_description=$_POST['p_description'];
    $p_latitude=$_POST['p_latitude'];
    $p_cat=$_POST['catagory'];
    $dataofcat=implode(",",$p_cat);
    $p_type=$_POST['type'];
    
    
    
    $fileCount=count($_FILES['p_img']['name']);
    $dataofimg=array();
    for ($i = 0; $i < $fileCount; $i++) {
        $p_img = $_FILES['p_img']['name'][$i];
        $dataofimg[] = $p_img;
    }
    $dataofimg = implode(",", $dataofimg);


for ($i = 0; $i < $fileCount; $i++) {
    $query = "INSERT INTO places (p_name, p_longitude, p_latitude, p_discription, p_image, p_catagory, p_prov, p_type) 
            VALUES ('$name', '$p_longitude', '$p_latitude', '$p_description', '$dataofimg[$i]', '$dataofcat', '$p_prov', '$p_type')";
 $query_run=mysqli_query($conn,$query);
 if($query_run){
  //   move_uploaded_file($_FILES["p_img"]["tmp_name"][$i],"images/".$_FILES["p_img"]["name"]);
    move_uploaded_file($_FILES["p_img"]["tmp_name"][$i],"images/".$dataofimg[$i]);
  $_SESSION['status']=" sucess";
     header("Location: AddPlace.php");
     }
     else
     {
     $_SESSION['status']=" failed";
     header("Location: AddPlace.php");
     }
 
    }
}*/
if (isset($_POST['submit'])) {
    // Retrieve other form data
    $name = $_POST['p_name'];
    $p_prov = $_POST['provinces'];
    $p_longitude = $_POST['p_longitude'];
    $p_description = $_POST['p_description'];
    $p_latitude = $_POST['p_latitude'];
    $p_cat = $_POST['catagory'];
    $dataofcat = implode(",", $p_cat);
    $p_type = $_POST['type'];

    // Perform database insert for place information first
    $query = "INSERT INTO places (p_name, p_longitude, p_latitude, p_discription, p_catagory, p_prov, p_type) 
            VALUES ('$name', '$p_longitude', '$p_latitude', '$p_description', '$dataofcat', '$p_prov', '$p_type')";

    if (mysqli_query($conn, $query)) {
        $placeId = mysqli_insert_id($conn); // Get the auto-generated ID of the last inserted place
    } else {
        $_SESSION['status'] = "failed";
        header("Location: AddPlace.php");
        exit();
    }

    // Retrieve the uploaded files
    $fileCount = count($_FILES['p_img']['name']);

    // Perform database insert for each file separately
    for ($i = 0; $i < $fileCount; $i++) {
        $p_img = $_FILES['p_img']['name'][$i];

        // Move the uploaded file to the destination folder
        $uploadDir = "images/";
        $destination = $uploadDir . $p_img;
        move_uploaded_file($_FILES["p_img"]["tmp_name"][$i], $destination);

        // Perform database insert for each image
        $query = "INSERT INTO images (place_id, image_name) VALUES ('$placeId', '$p_img')";

        if (!mysqli_query($conn, $query)) {
            $_SESSION['status'] = "failed";
            header("Location: AddPlace.php");
            exit();
        }
    }

    $_SESSION['status'] = "success";
    header("Location: AddPlace.php");
}


/*delete product code  */

if(isset($_POST['Deleteplace']))

{
    $placeid=$_POST['deleteplace_id'];
    $query="DELETE FROM places WHERE p_id='$placeid'"; 
    $query_run = mysqli_query($conn,$query);
    if($query_run){


            $_SESSION['status']="Place deleted sucessfully";
            header("Location: Places.php");
            }
            else
            {
            $_SESSION['status']="Place deleted fail";
            header("Location: Places.php");
            }

}

if(isset($_POST['UDeleteplace']))

{
    $placeid=$_POST['deleteplace_id'];
    $query="DELETE FROM u_places WHERE p_id='$placeid'"; 
    $query_run = mysqli_query($conn,$query);
    if($query_run){


            $_SESSION['status']="Place deleted sucessfully";
            header("Location:SuggestedPlace.php");
            }
            else
            {
            $_SESSION['status']="Place deleted fail";
            header("Location:SuggestedPlace.php");
            }

}




if(isset($_POST['submitSplace']))
{ 
    $p_prov=$_POST['provinces'];
  
   $id=$_POST['p_id'];

   
    $name=$_POST['p_name'];
    
    $p_longitude=$_POST['p_longitude'];
    $p_description=$_POST['p_description'];
    $p_latitude=$_POST['p_latitude'];
    $p_cat=$_POST['Tags'];
    $dataofcat=implode(",",$p_cat);
    $p_type=$_POST['type'];
    

    $query="INSERT INTO places(p_name,p_longitude,p_latitude,p_discription,p_catagory,p_prov,p_type) 
    VALUES('$name','$p_longitude','$p_latitude','$$p_description'
    ,'$dataofcat','$p_prov','$p_type')";
    $query_run=mysqli_query($conn,$query);

    if($query_run){
        $sql = "DELETE  FROM u_places WHERE p_id = $id";
        $sql_run=mysqli_query($conn,$sql);
        if($sql_run){
            $_SESSION['status']="Place Updated Sucessfully";
            header("Location:Places.php");
            }
            else
            {
            $_SESSION['status']="Updated Fail";
            header("Location: SuggestedPlace.php");
            }

        }else{
            $_SESSION['status']="Updated Fail";
            header("Location: SuggestedPlace.php");
        }


    
        

}

?>