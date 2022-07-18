<?php  
	
	include 'connection.php';
	
	$update_id = $_POST['update_id'];
    $reason = $_POST['reason'];
    $admin = 'Administrator';

	$update = $connection->query("UPDATE tbl_rents SET rent_status = '2', reason = '$reason', cancelledBy = '$admin'  WHERE id = '$update_id'");
	
	if ($update === TRUE) {
		echo "Declined";
	}else{
		echo "Failed";
	}

?>