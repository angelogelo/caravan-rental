<?php

    include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $customer_id = $_POST['customer_id'];
    $driver_id = $_POST['driver_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $package_amount = $_POST['package_amount'];
    $rent_days = $_POST['rent_days'];    
    $total_amount = $_POST['total_amount'];
    $package_type = $_POST['package_type'];
    $pick_up_date = $_POST['pick_up_date'];
    $return_date = $_POST['return_date'];
    $location = $_POST['location'];
    $mode_of_payment = $_POST['mode_of_payment'];
    $booking_date = $_POST['booking_date'];
    
    $booking_no = rand();

    
    $insert = $connection->query("INSERT INTO tbl_rents (booking_number, customer_id, driver_id, vehicle_id, package_amount, rent_days, total_amount, package_type, booking_date, pick_up_date, return_date, location, mode_of_payment) VALUES ('$booking_no','$customer_id','$driver_id','$vehicle_id','$package_amount','$rent_days','$total_amount', '$package_type', '$booking_date', '$pick_up_date', '$return_date', '$location', '$mode_of_payment')");
    
    if($insert === TRUE){
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
    }
    else{
        $result["success"] = "0";
        $result["message"] = "Failed to book reservation";

        echo json_encode($result);
    }
}

?>