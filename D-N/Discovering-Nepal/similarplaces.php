
<div class="content mt-3">

<hr>
<h3 style="padding-left:20px;"><strong>Similar Places</strong></h3>
<hr>


<?php
include("include/database.php");
if (isset($_GET['place_id'])) {
    $placeid = $_GET['place_id'];
    $userid = $_SESSION['auth_user']['user_id'];

    // Get the place name from the locations table
    $query = "SELECT * FROM locations WHERE id='$placeid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $title = $row['place_name'];
   

    // Get the most similar places
    $query = "SELECT * FROM most_similar_places  WHERE Place='$title'";
    $result1 = mysqli_query($conn, $query);
    $similarplaces = array();

    // Fetch the recommendations for the user and store them in variables.
    while ($row1 = mysqli_fetch_array($result1)) {
        $recoo1 = $row1['similar_place_1'];
        $recoo2 = $row1['similar_place_2'];
        $recoo3 = $row1['similar_place_3'];
        $recoo4 = $row1['similar_place_4'];
        $recoo5 = $row1['similar_place_5'];

        // Add the recommendations to the visitedPlaceIds array.
        $similarplaces[] = $recoo1;
        $similarplaces[] = $recoo2;
        $similarplaces[] = $recoo3;
        $similarplaces[] = $recoo4;
        $similarplaces[] = $recoo5;
    }

    // Escape the place names to prevent SQL injection
    $escapedPlaceNames = array_map(function ($name) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $name) . "'";
    }, $similarplaces);

    // ...

// Create a comma-separated string of the escaped place names
$recoIdsString = implode(",", $escapedPlaceNames);

// If $recoIdsString is empty, set a default value that won't match any records
if (empty($recoIdsString)) {
    $recoIdsString = "0";
}

// Query the locations table using the recommendations in the WHERE clause.
$query = "SELECT * FROM locations WHERE place_name IN ($recoIdsString)";
$result = mysqli_query($conn, $query);

// ...


    // Display the recommended places
    while ($row = mysqli_fetch_array($result)) {
        $placeid = $row['id'];
        $title = $row['place_name'];
        $content = $row['discription'];
        $imgUrl = $row['imgUrl'];
        $placename = $row['place_name'];
        ?>


                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
<!--slider-->
<img src="<?php echo $imgUrl; ?>" alt="image" class="image-style" style="height:250px; width:250px;border: 2px solid #ccc;border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

                </div>
<!--slider-->
<div class="col-md-6">
                        <h2><a href="placeforrecommendation.php?place_id=<?php echo $placeid ?>"  class="text-decoration-none"value="<?php echo $placeid?>" style="color:black;"><?php echo $title; ?></a></h2>
                        <div class="post-text mt-3" style="height:200px;width:500px;">
                        <input type="hidden"  name="place_id">
                           <p> <?php echo $content; ?></p>
                        </div>
                       
                           
                           
                            </form>
                           
                            
                          
                        </div>
                    </div>
                    <hr>
              
                    </div>
                        </div>
    <?php
    }
}
?>
</div>