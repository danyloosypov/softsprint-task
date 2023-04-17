<?php 

require_once("../db/dbconnection.php");

$userId = $_POST['user_id'];

if (empty($userId)) {
  $response = array(
    'status' => false,
    'error' => array(
      'code' => 101,
      'message' => 'User ID is required.'
    )
  );
  echo json_encode($response);
} else {
    $sql = "delete from users WHERE user_id = $userId";

    $res = mysqli_query($connection, $sql);
 
    if($res) {
        $response = array(
            'status' => true,
            'error' => null
        );

        echo json_encode($response);
    } else {
        $response = array(
            'status' => false,
            'error' => array(
              'code' => 102,
              'message' => 'Error deleting user. Please try again.'
            )
          );
        echo json_encode($response);
    }
}

?>