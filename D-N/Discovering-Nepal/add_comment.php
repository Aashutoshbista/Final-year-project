<?php
include('include/database.php');
include('include/authentication.php');

// Assuming $_POST values are received from other files
if (isset($_POST["comment_id"])) {
    $comment_id = $_POST["comment_id"];
} else {
    // Handle the case when 'comment_id' is not received
    echo "comment_id not received in POST data.\n";
    exit;
}

if (isset($_POST["comment_content"])) {
    $comment_content = $_POST["comment_content"];
} else {
    // Handle the case when 'comment_content' is not received
    echo "comment_content not received in POST data.\n";
    exit;
}

$comment_name = $_SESSION['auth_user']['user_name'];

if (isset($_POST["place_name"])) {
    $place_name = $_POST["place_name"];
} else {
    // Handle the case when 'place_name' is not received
    echo "place_name not received in POST data.\n";
    exit;
}

// Create a data array to hold debug information
$data = array();

$query = "INSERT INTO `" . $place_name . "` (parent_comment_id, comment, comment_sender_name) VALUES (?, ?, ?)";


// Debug: Print the SQL query
$data['sql_query'] = $query;

$statement = $conn->prepare($query);
if ($statement) {
    // Bind parameters to the prepared statement
    $statement->bind_param("iss", $comment_id, $comment_content, $comment_name);

    // Execute the prepared statement
    if ($statement->execute()) {
        $data['success'] = true;
        $data['message'] = 'Comment Added';
    } else {
        // Debug: Print the error information
        $data['success'] = false;
        $data['error'] = 'Error executing the query: ' . $statement->error;
    }
} else {
    // Debug: Print the error information
    $data['success'] = false;
    $data['error'] = 'Error preparing the query: ' . $conn->error;
}

echo json_encode($data);
?>
