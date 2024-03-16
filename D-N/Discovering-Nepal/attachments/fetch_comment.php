<!DOCTYPE html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title></title>
</head>
<body>    
    <?php
include('authentication.php');
//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=discovering-nepal', 'root', '');

              if(isset($_SESSION['auth'])){
              echo $_SESSION['auth_user']['user_name'] ;
              }
              else{
                echo "Not logged IN";
              }
               








$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0' 
ORDER BY comment_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';


foreach($result as $row)
{
  $output .= '
    <div class="panel panel-default" style="width:30%;">

        <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
        <div class="panel-body">'.$row["comment"].'</div>';

    // Check if parent_comment_id is not equal to 0
    if ($row["parent_comment_id"] != 0) {
        $output .= '<div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>';
    }

    $output .= '
    </div>';
 $output .= get_reply_comment($connect, $row["comment_id"]);

}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px;width:30%;">
    ';

    // Check if parent_comment_id is not equal to 0
    if ($row["parent_comment_id"] != 0) {
        // Fetch the name of the parent comment
        $parentCommentName = get_parent_comment_name($connect, $row["parent_comment_id"]);
        $output .= '<div class="panel-heading"><b><i>(Replying to: '.$parentCommentName.')</i> By '.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i>


         ';
    }

    $output .= '</div>
    <div class="panel-body">'.$row["comment"].'</div>

    <div class="panel-footer" align="right" ><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'"  >Replyyy</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
  }
 }
 return $output;

}
function get_parent_comment_name($connect, $parent_id) {
  $query = "SELECT comment_sender_name FROM tbl_comment WHERE comment_id = '".$parent_id."'";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchColumn();
  return $result;
}
?>

</body>
</html>
