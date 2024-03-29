<?php 

require_once("../db/dbconnection.php");

if (empty($_POST['id'])) {

  $response = array(
    'status' => false,
    'error' => array(
      'code' => 101,
      'message' => 'User ID is required.'
    )
  );
  echo json_encode($response);
} else {

  $userId = $_POST['id'];

  $sql = "delete from users WHERE id = $userId";

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