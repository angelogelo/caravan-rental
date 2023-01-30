<?php  
	
	include 'connection.php';

	$id = $_POST['id'];
	//$delete = $connection->query("DELETE FROM tbl_driver WHERE id = '$id'");
	
	$update = $connection->query("UPDATE tbl_driver SET
	    driver_status = 1
	WHERE id = '$id';
	");
    
	if ($update === TRUE) {
			echo "Deleted";
	} else {
		echo "Error";
	}

?>