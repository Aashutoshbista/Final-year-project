
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
<img src="<?php echo $imgUrl; ?>" alt="image" class="image-style" style="height:200px; width:250px;border: 2px solid #ccc;border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

                </div>
<!--slider-->
<div class="col-md-6">
                        <h2><a href="placeforrecommendation.php?place_id=<?php echo $placeid ?>"  class="text-decoration-none" style="color:black;"><?php echo $title; ?></a></h2>
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
                        </div>
                        <?php
                }
            ?>