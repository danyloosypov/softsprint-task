<?php 

require_once("../db/dbconnection.php");

if (!empty($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql = "SELECT * FROM users where id = $user_id";
    $result = mysqli_query($connection, $sql);
    
    $user = $row = mysqli_fetch_assoc($result);
    
    // close database connection
    mysqli_close($connection);

    if(!empty($user)) {
        $response = array(
            'status' => true,
            'error' => null,
            'user' => $user
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => false,
            'error' => array(
                'code' => 404,
                'message' => 'User not found.'
            )
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'status' => false,
        'error' => array(
            'code' => 101,
            'message' => 'User ID is required.'
        )
    );
    echo json_encode($response);
}



?>