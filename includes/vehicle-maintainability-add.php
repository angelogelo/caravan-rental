<?php

    include 'connection.php';
    //details
    $make = $_POST['make'];
    $vehicle = $_POST['vehicle'];
    $body_type = $_POST['body_type'];


    $select = $connection->query("SELECT * FROM tbl_vehicle_maintainability WHERE make = '".$make."' AND vehicle = '".$vehicle."'");
   
    if($select->num_rows < 1){

        $insert = $connection->query("INSERT INTO tbl_vehicle_maintainability (
            make,
            vehicle,
            body_type
        ) VALUES (
            '$make',
            '$vehicle',
            '$body_type'
        )");

        echo "Added";
    }else{
        echo "Exist";
    }
?>