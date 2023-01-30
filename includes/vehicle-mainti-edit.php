<?php

    include 'connection.php';

    $update_id = $_POST['update_id'];
    $make = $_POST['make'];
    $vehicle = $_POST['vehicle'];
    $body_type = $_POST['body_type'];

    if($make !== ""){
        
        $update = $connection->query("UPDATE tbl_vehicle_maintainability SET make = '$make', vehicle = '$vehicle', body_type = '$body_type' WHERE id = '$update_id'");
            
        if($update === TRUE){
            echo "Updated";
        }else{
            echo "Failed";
        }

    }
?>