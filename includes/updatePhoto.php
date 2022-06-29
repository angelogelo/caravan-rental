<?php  
	
	include 'connection.php';

	$file_tmp = $_FILES['file']['tmp_name'];
	$file_name = $_FILES['file']['name'];
	$file = $file_name;

	$update_id = mysqli_real_escape_string($connection, $_POST['update_id']);

	if ($file_tmp !== "") {
		if (move_uploaded_file($file_tmp, '../vehicles-photo/'.$file)) {
			
			$update = $connection->query("UPDATE tbl_vehicle_photo SET vehicle_name = '$file' WHERE id = '$update_id'");

					if ($update === TRUE) {
						echo "Updated";
			}else {
				echo "Failed";
			}
		}else {
			echo "Failed";
		}

	}else {
		
		if ($update === TRUE) {
			echo "Updated";
		}else {
			$msg = $connection->error;
			echo "Failed";
		}
	}


?>