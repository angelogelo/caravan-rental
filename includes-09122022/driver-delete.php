<?php  
	
	include 'connection.php';

	$id = $_POST['id'];
	$delete = $connection->query("DELETE FROM tbl_driver WHERE id = '$id'");
	if ($delete === TRUE) {
			echo "Deleted";
	} else {
		echo "Error";
	}

?>