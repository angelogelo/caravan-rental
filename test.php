<?php

    include 'includes/connection.php';

    $timeNow = date('Y-m-d');
    $dateNow = date("Y-m-d h:i a");

    echo $timeNow;

    $select = $connection->query("SELECT * FROM tbl_rents WHERE booking_date = '$timeNow' AND rent_status = 1");
    $selectRow = $select->fetch_array();
    // $invoice_number = rand();

    // echo $update_id = $selectRow['id'];

    // $update = $connection->query("UPDATE tbl_rents SET invoice_number = '$invoice_number', rent_status = 1, approved_date = '$dateNow' WHERE id = '$update_id'");

    echo '<br><br>';
    if($select->num_rows >= 1){

        
        echo $vehicle_id = $selectRow['vehicle_id'];
        echo $driver_id = $selectRow['driver_id'];
        
        $driver = $connection->query("UPDATE tbl_driver SET driver_status = 2 WHERE id = '$driver_id'");
        $vehicle = $connection->query("UPDATE tbl_vehicle SET vehicle_status = 1 WHERE id = '$vehicle_id'");
        
        echo '<br><br>';
        echo "Updated";

    }else{
        echo "Failed";
    }

    echo '<br><br>';

    echo $select->num_rows;

    echo '<br><br>';
    
?>