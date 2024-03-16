<div class="content">
<h2 class="bounce">
    <span class="ten">Specific</span>
    <span class="space"></span>
    <span class="ten">Recommendation</span>
</h2>

    <?php
    $username = $_SESSION['auth_user']['user_name'];
    $userid= $_SESSION['auth_user']['user_id'];
    $query1 = "SELECT * FROM user_recommendations WHERE user_name='$username'";
    $result1 = mysqli_query($conn, $query1);
    $visitedPlaceIds = array();
    
    // Fetch the recommendations for the user and store them in variables.
    while ($row1 = mysqli_fetch_array($result1)) {
        $recoo1 = $row1['recommendation_1'];
        $recoo2 = $row1['recommendation_2'];
        $recoo3 = $row1['recommendation_3'];
        $recoo4 = $row1['recommendation_4'];
        $recoo5 = $row1['recommendation_5'];
    
        // Add the recommendations to the visitedPlaceIds array.
        $visitedPlaceIds[] = $recoo1;
        $visitedPlaceIds[] = $recoo2;
        $visitedPlaceIds[] = $recoo3;
        $visitedPlaceIds[] = $recoo4;
        $visitedPlaceIds[] = $recoo5;
    }
    
    // Create a comma-separated string of the recommendations to use in the SQL query.
    $recoIdsString = implode(",", $visitedPlaceIds);
    
    $escapedPlaceNames = array_map(function($name) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $name) . "'";
    }, $visitedPlaceIds);
    
    // Create a comma-separated string of the escaped place names
    $recoIdsString = implode(",", $escapedPlaceNames);
    // Query the locations table using the recommendations in the WHERE clause.
    $query = "SELECT * FROM locations WHERE place_name IN ($recoIdsString)";
    $result = mysqli_query($conn, $query);
    
    while ($row = mysqli_fetch_array($result)) {
        $placeid = $row['id'];
        $title = $row['place_name'];
        $content = $row['discription'];
        $imgUrl = $row['imgUrl'];
        $placename=$row['place_name'];
        // Rest of your code here...
        ?>
        <div class="post">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <!--slider-->
                    <img src="<?php echo $imgUrl; ?>" alt="image" class="image-style" style="height:200px; width:250px;border: 2px solid #ccc;border-radius: 5px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                </div>
                <!--slider-->
                <div class="col-md-6">
                    <h2><?php echo $title; ?></h2>
                    <div class="post-text mt-3">
                        <input type="hidden" value="<?php echo $placeid; ?>" name="place_id">
                        <input type="hidden" value="<?php echo $placename; ?>" name="placename">
                        <?php echo $content; ?>
                        <?php
                        $query = "SELECT * FROM post_rating WHERE placeid=" . $placeid . " AND userid=" . $userid;
                        $userresult = mysqli_query($conn, $query) or die(mysqli_error());
                        if (mysqli_num_rows($userresult) > 0) {
                            // Rating is available 
                            $fetchRating = mysqli_fetch_array($userresult);
                            $rating = $fetchRating['rating'];
                        } else {
                            // No rating found 
                            $rating = null; 
                        }
                        $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE placeid=" . $placeid;
                        $avgresult = mysqli_query($conn, $query) or die(mysqli_error());
                        $fetchAverage = mysqli_fetch_array($avgresult);
                        $averageRating = $fetchAverage['averageRating'];
                        if($averageRating <= 0){
                            $averageRating = "No rating yet.";
                        }

                        
                        ?>
                        <div class="post-action mt-2">
                            <!-- Rating -->
                            <select class='rating mt-2' id='rating_<?php echo $placeid; ?>' data-id='rating_<?php echo $placeid; ?>'>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                            </select>
                            <div style='clear: both;'></div>
                            <div class="">
                            Average Rating : <span id='avgrating_<?php echo $placeid; ?>'><?php echo $averageRating; ?></span>
                            
                    </div>
                    <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#rating_<?php echo $placeid; ?>').barrating('set',<?php echo $rating; ?>);
                            });
                            
                            </script>

                </div>
            </div>
            <hr>
        </div>
        <?php
    }
    ?>
</div>

