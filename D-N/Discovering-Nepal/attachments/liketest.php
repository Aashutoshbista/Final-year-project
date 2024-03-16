<?php
include "database.php";

function displayPosts($userid, $conn,$postiD,$place)
{
    $output = '';
    $postid = $postiD;
    $place = $place;
    //$query = "SELECT * FROM places";
    //$result = mysqli_query($conn, $query);

    //while ($row = mysqli_fetch_array($result)) {
        //$postid = $row['p_id'];
       // $title = $row['p_name'];
        //$content = $row['p_discription'];
        $type = -1;

        // Checking user status
        $status_query = "SELECT count(*) as cntStatus,type FROM like_unlike WHERE userid=".$userid." and postid=".$postid;
        $status_result = mysqli_query($conn, $status_query);
        $status_row = mysqli_fetch_array($status_result);
        $count_status = $status_row['cntStatus'];
        if ($count_status > 0) {
            $type = $status_row['type'];
        }

        // Count post total likes and unlikes
        $like_query = "SELECT COUNT(*) AS cntLikes FROM like_unlike WHERE type=1 and postid=".$postid;
        $like_result = mysqli_query($conn, $like_query);
        $like_row = mysqli_fetch_array($like_result);
        $total_likes = $like_row['cntLikes'];

        $unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM like_unlike WHERE type=0 and postid=".$postid;
        $unlike_result = mysqli_query($conn, $unlike_query);
        $unlike_row = mysqli_fetch_array($unlike_result);
        $total_unlikes = $unlike_row['cntUnlikes'];

        // Build HTML output
        /*$output .= '<div class="post">';
        $output .= '<h2>'.$title.'</h2>';
        $output .= '<div class="post-text">'.$content.'</div>';
        $output .= '<div class="post-action">';*/
        $output .= '<input type="button" value="Like" id="like_'.$postid.'" class="like" style="'.($type == 1 ? "color: #ffa449;" : "").'" /> <i id= "like_'.$postid.'_icon" style="'.($type == 1 ? "color: #ffa449;" : "").'" class="fa">&#xf087;</i>&nbsp;(<span id="likes_'.$postid.'">'.$total_likes.'</span>)&nbsp;';


        $output .= '<input type="button" value="Dislike" id="unlike_'.$postid.'" class="unlike" style="'.($type == 0 ? "color: #ffa449;" : "").'" /><i id=  "unlike_'.$postid.'_icon" style="'.($type == 1 ? "color: #ffa449;" : "").'" class="fa">&#xf165;</i>&nbsp;(<span id="unlikes_'.$postid.'">'.$total_unlikes.'</span>)';
        $output .= '</div>';
        $output .= '</div>';
    //}

    return $output;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title></title>
</head>
<body>
  <div class="content">
     <!--<i style="font-size:24px" class="fa">&#xf087;</i>-->
    

    <?php 
    $destination = 'like_unlike';
    echo displayPosts(212, $conn,7,$destination); 

    ?>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      // like and unlike click
      $(".like, .unlike").click(function(){
        // Rest of your JavaScript code
        // ...

        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var postid = split_id[1];  // postid

        var places = <?php echo json_encode($destination); ?>;

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: 'likeunlike.php',
            type: 'post',
            data: {postid:postid,type:type,places:places},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+postid).text(likes);        // setting likes
                $("#unlikes_"+postid).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+postid).css("color","#ffa449");
                    $("#unlike_"+postid).css("color","lightseagreen");
                    $("#like_"+postid+ "_icon").css("color","#ffa449");
                    $("#unlike_"+postid+ "_icon").css("color","lightseagreen");
                }

                if(type == 0){
                    $("#unlike_"+postid).css("color","#ffa449");
                    $("#like_"+postid).css("color","lightseagreen");
                    $("#unlike_"+postid+ "_icon").css("color","#ffa449");
                    $("#like_"+postid+ "_icon").css("color","lightseagreen");
                }


            }
            
        });
      });
    });
  </script>
</body>
</html>
