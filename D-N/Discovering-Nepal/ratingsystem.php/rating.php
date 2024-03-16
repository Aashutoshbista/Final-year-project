<?php

include "database.php";
include('authentication.php');
include('header.php');

?>
<html>
    <head>
        <title>Places</title>

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
            <p style='color: red;'>Places Acoording to your preference.</p>
            <?php
                $userid = $_SESSION['auth_user']['user_id'] ;
                $query = "SELECT * FROM locations";
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