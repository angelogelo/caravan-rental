<?php 

    $host = "localhost";
	$username = "u847377087_caravan_rental";
 	$password = "9*cq3>X64J:x";
	$database = "u847377087_caravan_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$contact_no = $_POST['contact_no'];
	
	$sqlupdatestatus = "UPDATE user SET user_status = '1' WHERE contact_no = '$contact_no'";
	
	$result = mysqli_query($connection, $sqlupdatestatus);
	
	if($result){
	  $message["success"] = "1";
      $message["message"] = "Account successfully verified";  
      
      echo json_encode($message);
	}
	
	else{
	  $message["success"] = "0";
      $message["message"] = "Account failed to verify";  
      
      echo json_encode($message); 
	}


?>