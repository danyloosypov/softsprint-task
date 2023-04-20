<?php 

require_once("../db/dbconnection.php");

    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstName']; 
    $lastname = $_POST['lastName']; 
    $active = $_POST['active']; 
    $role = $_POST['role']; 


    $sql = "update users set user_firstname = '$firstname', user_lastname = '$lastname', user_role = '$role', user_status = '$active' where user_id = $user_id";

    error_log($sql, 0);

    $res = mysqli_query($connection, $sql);
 
    if($res) {
        $response = array(
            'status' => true,
            'error' => null,
            'user' => array(
                'id' => $user_id,
                'user_firstname' => $firstname,
                'user_lastname' => $lastname,
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
              'message' => 'Error updating user. Please try again.'
            )
          );
        echo json_encode($response);
    }
?>