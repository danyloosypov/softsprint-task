<?php 

require_once("../db/dbconnection.php");

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM users where user_id = $user_id";
$result = mysqli_query($connection, $sql);

// create empty array for storing user data
$users = array();

// loop through each row and add to users array
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// close database connection
mysqli_close($connection);

// return user data as JSON object
echo json_encode($users);

?>