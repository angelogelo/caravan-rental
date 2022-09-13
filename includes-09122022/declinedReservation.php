<?php  
	
	include 'connection.php';
	
	$update_id = $_POST['update_id'];
    $reason = $_POST['reason'];

	$update = $connection->query("UPDATE tbl_rents SET rent_status = '2', reason = '$reason' WHERE id = '$update_id'");
	
	if ($update === TRUE) {
		echo "Declined";
	}else{
		echo "Failed";
	}

?>