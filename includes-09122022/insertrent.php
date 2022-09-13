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

    $insertrent = $connection->query("INSERT INTO tbl_rents (booking_number, customer_id, driver_id, vehicle_id, package_amount, rent_days, total_amount, package_type, booking_date, pick_up_date, return_date, location, mode_of_payment) VALUES ('$booking_no','$customer_id','$driver_id','$vehicle_id','$package_amount','$rent_days','$total_amount', '$package_type', '$booking_date', '$pick_up_date', '$return_date', '$location', '$mode_of_payment')");
    
            
    if($insertrent === TRUE){
        
        $results["successs"] = "11";
        $results["message"] = "success";
           
        /* include '../functions/send-email.php';
        
        $select = $connection->query("SELECT * FROM user WHERE id = '$customer_id'");
		$select_row = $select->fetch_array();

        $email = $select_row['email'];
        $name = $select_row['firstname'].' '.$select_row['lastname'];

		$to = $email;
		$subject = 'Payment Confirmation';
		
		$body = 'Hi, '.ucwords($name).'!<br><br>
            Your reservation to Caravan is now Confirmed. Your balance is Php '.$balance.'. <br>Please pay your remaining balance in cash, thank you and have a nice day!
            <br><br><br><br><br>
            This is an automatically generated email. Please do not reply to this email';
            
            
            sendMail($to, $name,$subject,$body);*/
      
        echo json_encode($results);
    }
    else{
        $results["success"] = "0";
        $results["message"] = "Failed to book reservation";

        echo json_encode($results);
    }

}


?>