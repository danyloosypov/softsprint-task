<?php 

require_once("../db/dbconnection.php");

$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$active = $_POST['active'];
$role = $_POST['role'];

if(!empty($first_name) && !empty($last_name) && isset($active) && !empty($role)) {
    $sql = "Insert into users (firstname, lastname, role, status) values ('$first_name', '$last_name', '$role', '$active')";

    $res = mysqli_query($connection, $sql);
 
    if($res) {
        $user_id = mysqli_insert_id($connection);

        $response = array(
            'status' => true,
            'error' => null,
            'user' => array(
                'id' => $user_id,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'status' => $active,
                'role' => $role
            )
            
        );

        echo json_encode($response);
    } else {
        $response = array(
            'status' => false,
            'error' => array(
              'code' => 102,
              'message' => 'Error inserting user. Please try again.'
            )
          );
        echo json_encode($response);
    }
} else {
  $arr = Array();
  if(empty($first_name)) {
    array_push($arr, "firstname");
  }
  if(empty($last_name)) {
    array_push($arr, "lastname");
  }
  if(!isset($active)) {
    array_push($arr, "status");
  }
  if(empty($role)) {
    array_push($arr, "role");
  }

    $response = array(
        'status' => false,
        'error' => array(
          'code' => 101,
          'message' => 'Required fields are missing: ' . implode(', ', $arr)
        )
      );
      echo json_encode($response);
}

?>