<?php  
	
	include 'connection.php';

    $dateNow = date("Y-m-d h:i a");

    $update_id = $_POST['update_id'];
    // $driver_id = $_POST['driver_id'];
    // $vehicle_id = $_POST['vehicle_id'];
    $customer_id = $_POST['customer_id'];

 	$invoice_number = rand();

    $update = $connection->query("UPDATE tbl_rents SET invoice_number = '$invoice_number', rent_status = 1, approved_date = '$dateNow' WHERE id = '$update_id'");
// 	$driver = $connection->query("UPDATE tbl_driver SET driver_status = 2 WHERE id = '$driver_id'");
// 	$vehicle = $connection->query("UPDATE tbl_vehicle SET vehicle_status = 1 WHERE id = '$vehicle_id'");
	
	if ($update === TRUE) {

		$invoice = $connection->query("INSERT INTO tbl_invoice (invoice_number, created_at) VALUES ('$invoice_number', '$timeNow')");
		
		include '../functions/send-email.php';

		$select = $connection->query("SELECT * FROM user WHERE id = '$customer_id'");
		$select_row = $select->fetch_array();

        $email = $select_row['email'];
        $name = $select_row['firstname'].' '.$select_row['lastname'];

		$to = $email;
		$subject = 'Booking Confirmation';
		
		$body = 'Thank you for renting a vehicle, '.ucwords($name).'!<br><br>
            Your booking reservation with Caravan is now successfully comfirm! Thank you again! See you around and have a nice day!<br><br>

                If you need to get in touch, you can email or message us via in app..!
            <br><br><br><br><br>
            This is an automatically generated email. Please do not reply to this email';
		
		sendMail($to, $name, $subject, $body);
		
		echo "Approved";
	}else{
		echo "Failed";
	}

?>