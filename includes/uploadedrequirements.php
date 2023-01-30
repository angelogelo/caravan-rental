<?php 

    $host = "localhost";
	$username = "u847377087_caravan_rental";
 	$password = "9*cq3>X64J:x";
	$database = "u847377087_caravan_rental";

	$connection = new mysqli($host, $username, $password, $database);
	

	$id = $_POST['customer_id'];
	
	$sqlupdatestatus = "SELECT count(*) FROM tbl_requirements_photo WHERE customer_id = '$id'";
	
	$result = mysqli_query($connection, $sqlupdatestatus);
	
	if($result){
	  $message["success"] = "1";
      $message["message"] = $result;  
      
      echo json_encode($message);
	}
	
	else{
	  $message["success"] = "0";
      $message["message"] = "0";  
      
      echo json_encode($message); 
	}


?>