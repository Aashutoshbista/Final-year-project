<?php

include "database.php";

include('header.php');

?>
<html>
    <head>
        <title>Places</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Play&display=swap');
            .bounce {
    font-size: 5rem;
    width: 100%;
    margin: 3rem auto;
    display: inline-flex;
    justify-content: center;
    -webkit-box-reflect: below -20px linear-gradient(transparent, #211e1e2e);
}

.bounce span {
    display: inline-flex;
    color: #738690;
    font-family: "Impact", sans-serif;
    animation: bounce 1s infinite;
    letter-spacing: 5px;
}
.space {
    margin-left: 20px; /* Adjust the value as needed */
}

@keyframes bounce {
    0%,
    50%,
    100% {
        transform: translateY(0);
    }
    25% {
        transform: translateY(-20px);
    }
}

.ten span:nth-of-type(1) {
    animation-delay: 0.1s;
}

.ten span:nth-of-type(2) {
    animation-delay: 0.2s;
}

.ten span:nth-of-type(3) {
    animation-delay: 0.3s;
}

.ten span:nth-of-type(4) {
    animation-delay: 0.4s;
}

.ten span:nth-of-type(5) {
    animation-delay: 0.5s;
}

.ten span:nth-of-type(6) {
    animation-delay: 0.6s;
}

        </style>

        <!-- CSS -->
        <!--<link href="ratingstyle.css" type="text/css" rel="stylesheet" />-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>

        
        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {
                        
                        var split_id = el_id.split("_");

                        var placeid= split_id[1];  // placeid

                        // AJAX Request
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {placeid:placeid,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_'+placeid).text(average);
                            }
                        });
                    }
                }
            });
        });
      
        </script>
    </head>
    <body>
        

    


        </div>

    </body>
</html>
<div class="content">
<h2 class="bounce">
    <span class="ten">Specific</span>
    <span class="space"></span>
    <span class="ten">Recommendation</span>
</h2>

    <?php
    $username = $_SESSION['auth_user']['user_name'];
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
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <?php
    }
    ?>
</div>




<div class="content">
<form action="visited.php">
<h2 class="bounce">
    <span class="ten">All</span>
    <span class="space"></span>
    <span class="ten">Places</span>
</h2>
            <?php
                $userid = $_SESSION['auth_user']['user_id'] ;
                $query1="SELECT place_id FROM visited WHERE userid='$userid'";
                $result1 = mysqli_query($conn,$query1);
                $visitedPlaceIds = array();
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $visitedPlaceIds[] = $row1['place_id'];
                                }

                                
                                $notInClause = "";
                                if (!empty($visitedPlaceIds)) {
                                    $notInClause = " AND id NOT IN (" . implode(",", $visitedPlaceIds) . ")";
                                }


                $query = "SELECT * FROM locations WHERE 1" . $notInClause;
                $result = mysqli_query($conn,$query);
                while($row = mysqli_fetch_array($result)){
                    $placeid = $row['id'];
                    $title = $row['place_name'];
                    $content = $row['discription'];
                    $imgUrl=$row['imgUrl'];

                   /*
                    $averagerating= (float) $row['Avg.Ratings'];
                    $totalraters=(int) $row['TotalRatings'];
                    $sum= $averagerating*$totalraters;
                    $sum=(int)$sum;
                    $newsum=$sum+3;*/


                    // User rating
                    // User rating
$query = "SELECT * FROM post_rating WHERE placeid=" . $placeid . " AND userid=" . $userid;
$userresult = mysqli_query($conn, $query) or die(mysqli_error());

// Check if any rows are returned
if (mysqli_num_rows($userresult) > 0) {
    // Rating is available for this user and place
    $fetchRating = mysqli_fetch_array($userresult);
    $rating = $fetchRating['rating'];
} else {
    // No rating found for this user and place
    $rating = null; // Set the user's rating to null
}

// get average

$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE placeid=" . $placeid;
$avgresult = mysqli_query($conn, $query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($avgresult);
$averageRating = $fetchAverage['averageRating'];



                    if($averageRating <= 0){
                        $averageRating = "No rating yet.";
                    }
            ?>
                    <div class="post">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
<!--slider-->
<img src="<?php echo $imgUrl; ?>" alt="image" class="image-style" style="height:200px; width:250px;border: 2px solid #ccc;border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

                </div>
<!--slider-->
<div class="col-md-6">
                        <h2><?php echo $title; ?></a></h2>
                        <div class="post-text mt-3">
                        <input type="hidden"  name="place_id">
                            <?php echo $content; ?>
                        </div>
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
                            <button class="btn btn-primary" type="submit" value="<?php echo $placeid ?>" name="submit" style="width: 100px; height: 30px;">Vistied</button>
                            </form>
                            <!-- Set rating -->
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
<?php
include('footer.php');
?>