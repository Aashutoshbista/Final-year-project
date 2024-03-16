<?php
//include('authentication.php');
include('database.php');

if (isset($_POST["place_name"])) {
    $place_name = $_POST["place_name"];
} else {
    // Handle the case when 'place_name' is not received
    echo "place_name not received in POST data.\n";
    exit;
}

$query = "SELECT * FROM " . $place_name . " WHERE parent_comment_id = '0' ORDER BY comment_id DESC";
$result = $conn->query($query);

if (!$result) {
    // Display the SQL error message for debugging
    echo "SQL Error: " . $conn->error . "\n";
    exit;
}

$output = '';

foreach ($result as $row) {
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
    $output .= get_reply_comment($conn, $place_name, $row["comment_id"]);
}

echo $output;

function get_reply_comment($conn, $place_name, $parent_id = 0, $marginleft = 0)
{
    $query = "SELECT * FROM " . $place_name . " WHERE parent_comment_id = '" . $parent_id . "' ORDER BY comment_id DESC";
    $output = '';

    $result = $conn->query($query);

    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 48;
    }

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '
            <div class="panel panel-default" style="margin-left:' . $marginleft . 'px;width:30%;">
            ';

            // Check if parent_comment_id is not equal to 0
            if ($row["parent_comment_id"] != 0) {
                // Fetch the name of the parent comment
                $parentCommentName = get_parent_comment_name($conn, $place_name, $row["parent_comment_id"]);
                $output .= '<div class="panel-heading"><b><i>(Replying to: ' . $parentCommentName . ')</i> By ' . $row["comment_sender_name"] . '</b> on <i>' . $row["date"] . '</i>';
            }

            $output .= '</div>
            <div class="panel-body">' . $row["comment"] . '</div>

            <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="' . $row["comment_id"] . '">Replyyy</button></div>
            </div>
            ';
            $output .= get_reply_comment($conn, $place_name, $row["comment_id"], $marginleft);
        }
    }

    return $output;
}




function get_parent_comment_name($conn, $place_name, $parent_id)
{
    $query = "SELECT comment_sender_name FROM " . $place_name . " WHERE comment_id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $parent_id);
    $statement->execute();
    $result = $statement->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["comment_sender_name"];
    } else {
        return "";
    }
}
?>
