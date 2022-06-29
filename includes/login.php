<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $usernames = $_POST['username'];
    $passwords = $_POST['password'];

    require_once 'connection.php';

    $sql = "SELECT * FROM user WHERE username='$usernames' ";

    $response = mysqli_query($connection, $sql);

    $result = array();
    $result['login'] = array();
    
    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);

        if ( password_verify($passwords, $row['password']) ) {
            
            $index['firstname'] = $row['firstname'];
            $index['lastname'] = $row['lastname'];
            $index['contact_no'] = $row['contact_no'];
            $index['email'] = $row['email'];
            $index['username'] = $row['username'];
            $index['password'] = $row['password'];
            $index['address'] = $row['address'];
            $index['user_status'] = $row['user_status'];
            $index['id'] = $row['id'];

            array_push($result['login'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            echo json_encode($result);

            mysqli_close($connection);

        } else {

            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);

            mysqli_close($connection);

        }

    }

}

?>