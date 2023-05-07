<?php 

require_once("../db/dbconnection.php");

    $user_id = $_POST['id'];
    $firstname = $_POST['firstName']; 
    $lastname = $_POST['lastName']; 
    $active = $_POST['active']; 
    $role = $_POST['role']; 

    error_log($active . " sdfsdf", 0);

    if(!empty($user_id) && !empty($firstname) && !empty($lastname) && isset($active) && !empty($role)) {
        $sql = "update users set firstname = '$firstname', lastname = '$lastname', role = '$role', status = '$active' where id = $user_id";
    
        $res = mysqli_query($connection, $sql);
     
        if($res) {
            $response = array(
                'status' => true,
                'error' => null,
                'user' => array(
                    'id' => $user_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
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
                  'message' => 'Error updating user. Please try again.'
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