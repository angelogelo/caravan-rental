<?php  
	
	include 'connection.php';

    $dateNow = date("Y-m-d h:i a");

    $update_id = $_POST['update_id'];
    $driver_id = $_POST['driver_id'];
    $vehicle_id = $_POST['vehicle_id'];

 	$invoice_number = rand();

    $update = $connection->query("UPDATE tbl_rents SET invoice_number = '$invoice_number', rent_status = 1, approved_date = '$dateNow' WHERE id = '$update_id'");
	$driver = $connection->query("UPDATE tbl_driver SET driver_status = 2 WHERE id = '$driver_id'");
	$vehicle = $connection->query("UPDATE tbl_vehicle SET vehicle_status = 1 WHERE id = '$vehicle_id'");
	
	if ($update === TRUE) {

		$invoice = $connection->query("INSERT INTO tbl_invoice (invoice_number, created_at) VALUES ('$invoice_number', '$timeNow')");
		
		echo "Approved";
	}else{
		echo "Failed";
	}

?>