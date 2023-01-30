<?php 

    $host = "localhost";
	$username = "u847377087_caravan_rental";
 	$password = "9*cq3>X64J:x";
	$database = "u847377087_caravan_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$id = $_POST['id'];
	$vehicle_status = $_POST['vehicle_status'];
	
	$sqlupdatestatus = "UPDATE tbl_vehicle SET vehicle_status = '$vehicle_status' WHERE id = '$id'";
	
	$result = mysqli_query($connection, $sqlupdatestatus);
	
	if($result){
	  $message["success"] = "1";
      $message["message"] = "Vehicle status set to not available";  
      
      echo json_encode($message);
	}
	
	else{
	  $message["success"] = "0";
      $message["message"] = "Failed to set vehicle status";  
      
      echo json_encode($message); 
	}


?>