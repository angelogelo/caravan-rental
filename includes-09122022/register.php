<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $usernames = $_POST['username'];
    $passwordd = $_POST['password'];
    $type = $_POST['type'];
   
    $passwords = password_hash($passwordd, PASSWORD_DEFAULT);

    include 'connection.php';
    
    $dbc = mysqli_connect('localhost', 'u315516982_caravan_rental', 'Vt9:iESO|sf', 'u315516982_caravan_rental') or die('Error connecting to MySQL server');
    $check=mysqli_query($dbc,"select * from user where email='$email' or contact_no='$contact_no'");
    $checkrows=mysqli_num_rows($check);
    
       
       
       if($checkrows>0) {
           
       $result["success"] = "0";
        $result["message"] = "Email or phone number already taken";

        echo json_encode($result);
         } 
   else {  
     $insert = $connection->query("INSERT INTO user (firstname, lastname, contact_no, email, address, username, password, type, created_at) VALUES ('$firstname','$lastname','$contact_no','$email','$address', '$usernames','$passwords','$type','$timeNow')");
           
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
           
       }
    }
    
    /* $insert = $connection->query("INSERT IGNORE INTO user (firstname, lastname, phonenumber, email, username, password) VALUES ('$firstname','$lastname','$phonenumber','$email','$usernames','$passwords')");
           
        if($insert === TRUE){
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        }
     else{
        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
           
       } */


?>