<?php 

     $host = "localhost";
	$username = "u315516982_caravan_rental";
 	$password = "Vt9:iESO|sf";
	$database = "u315516982_caravan_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$Customer_ID = $_GET["customer_id"];
	$id = $_POST['id'];
	$reason = $_POST['reason'];
	$rent_status = $_POST['rent_status'];
	
	$sqlupdatestatus = "UPDATE tbl_rents SET reason = '$reason', rent_status = '$rent_status', cancelledBy = 'customer'   WHERE id = '$id'";
	
	$result = mysqli_query($connection, $sqlupdatestatus);
	
	if($result){
	  $message["success"] = "1";
      $message["message"] = "Rent cancelled";  
      
      echo json_encode($message);
	}
	
	else{
	  $message["success"] = "0";
      $message["message"] = "Fail to cancel";  
      
      echo json_encode($message); 
	}


?>