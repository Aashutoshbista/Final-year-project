<?php

include('include/database.php');
include('include/header.php');

?>
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

        <?php
         
       
       
       
     
        
        
        ?>




<div class="content mt-5">
<form action="visited.php">

</h2>
            <?php
               


               if (isset($_GET['place_id'])) {
                $placeid = $_GET['place_id'];
                          
            
                $userid = $_SESSION['auth_user']['user_id'] ;
    
                $query = "SELECT * FROM locations WHERE id='$placeid'";
                $result = mysqli_query($conn,$query);
                while($row = mysqli_fetch_array($result)){
                    
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


if (mysqli_num_rows($userresult) > 0) {
    // Rating is available 
    $fetchRating = mysqli_fetch_array($userresult);
    $rating = $fetchRating['rating'];
} else {
    // No rating found 
    $rating = null; 
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
<img src="<?php echo $imgUrl; ?>" alt="image" class="image-style" style="height:400px; width:400px;border: 2px solid #ccc;border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

                </div>
<!--slider-->
<div class="col-md-6">
                        <h2><a href="placeforrecommendation.php?place_id=<?php echo $placeid ?>"  class="text-decoration-none"value="<?php echo $placeid?>" style="color:black;"><?php echo $title; ?></a></h2>
                        <div class="post-text mt-3" style="height:200px;width:500px;">
                        <input type="hidden"  name="place_id">
                            <?php echo $content; ?>
                        </div>
                        <div class="post-action mt-5">
                            <!-- Rating -->
                            <select class='rating ' id='rating_<?php echo $placeid; ?>' data-id='rating_<?php echo $placeid; ?>'>
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
                           
                            </form>
                            <!-- Set rating -->
                            <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#rating_<?php echo $placeid; ?>').barrating('set',<?php echo $rating; ?>);
                            });
                            
                            </script>
                        </div>
                    </div>
              
                    </div>
                        </div>
                        <?php
                }}
                include('distance.php');
                include('similarplaces.php');
            ?>






<?php
include('include/footer.php');?>