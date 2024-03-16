<?php 
include('database.php');

function displayPosts($userid, $conn,$postid,$place)
{
    $output = '';
    $postid = $postid;
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
        $status_result = mysqli_query($conn, $status_query);
if (!$status_result) {
    die('Error in SQL query: ' . mysqli_error($conn));
}


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
        $output .= '<button class="btn btn-light bg-success"><input type="button" value="Like" id="like_'.$postid.'" class="like border-0 bg-success" style="'.($type == 1 ? "color: #ffa449;" : "").';border:none;" /> <i id= "like_'.$postid.'_icon" style="'.($type == 1 ? "color: #ffa449;" : "").'" class="fa">&#xf087;</i>&nbsp;(<span id="likes_'.$postid.'">'.$total_likes.'</span>)&nbsp;</button>';


        $output .= '<button class="btn btn-light bg-danger"><input type="button" value="Dislike" id="unlike_'.$postid.'" class="unlike border-0 bg-danger" style="'.($type == 0 ? "color: #ffa449;" : "").'" /><i id= "unlike_'.$postid.'_icon" style="'.($type == 1 ? "color: #ffa449;" : "").'" class="fa">&#xf165;</i>&nbsp;(<span id="unlikes_'.$postid.'">'.$total_unlikes.'</span>)</button>';
        $output .= '</div>';
        $output .= '</div>';
    //}
   
    return $output;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the AJAX POST request
    $userid = $_POST['userid'];
    $postid = $_POST['postid'];
    $place_name = $_POST['place_name'];

    // Call the displayPosts function and get the output
    $output = displayPosts($userid, $conn, $postid, $place_name);


    // Return the output as a JSON response
    echo json_encode(['output' => $output]);
}

?>