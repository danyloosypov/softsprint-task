<?php 

require_once("../db/dbconnection.php");

$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

// create empty array for storing user data
$users = array();

// loop through each row and add to users array
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// close database connection
mysqli_close($connection);

if (!empty($users)) {
    // Users data found
    // Set status to true, error to null, and users to users data
    $response = array(
        'status' => true,
        'error' => null,
        'users' => $users
    );
    echo json_encode($response);
} else {
    // No users data found
    // Set status to false, error to a custom error message, and users to null
    $response = array(
        'status' => false,
        'error' => array(
          'code' => 404,
          'message' => 'Users not found.'
        )
    );
    echo json_encode($response);
}

// return user data as JSON object
//echo json_encode($users);

?>