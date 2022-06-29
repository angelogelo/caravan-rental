<?php 

    $host = "localhost";
	$username = "id18669700_rental_cars";
 	$password = "N@<3+cD2>lhj=uKW";
	$database = "id18669700_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$Customer_ID = $_GET["customer_id"];
	$id = $_POST['id'];
	$reason = $_POST['reason'];
	$rent_status = $_POST['rent_status'];
	
	$sqlupdatestatus = "UPDATE tbl_rents SET reason = '$reason', rent_status = '$rent_status'   WHERE id = '$id'";
	
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