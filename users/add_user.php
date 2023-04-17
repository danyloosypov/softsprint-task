<?php 

require_once("../db/dbconnection.php");

$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$active = $_POST['active'];
$role = $_POST['role'];

if(!empty($first_name) && !empty($last_name) && !empty($active) && !empty($role)) {
    $sql = "Insert into users (user_firstname, user_lastname, user_role, user_status) values ('$first_name', '$last_name', '$role', '$active')";

    $res = mysqli_query($connection, $sql);
 
    if($res) {
        $user_id = mysqli_insert_id($connection);

        $response = array(
            'status' => true,
            'error' => null,
            'user' => array(
                'id' => $user_id,
                'user_firstname' => $first_name,
                'user_lastname' => $last_name,
                'user_active' => $active,
                'user_role' => $role
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
    $response = array(
        'status' => false,
        'error' => array(
          'code' => 101,
          'message' => 'Required fields are missing.'
        )
      );
      echo json_encode($response);
}

?>