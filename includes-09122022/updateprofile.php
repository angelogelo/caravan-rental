<?php 

    $host = "localhost";
	$username = "u315516982_caravan_rental";
 	$password = "Vt9:iESO|sf";
	$database = "u315516982_caravan_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['user_address'];
	
	$sqlupdatestatus = "UPDATE user SET firstname = '$firstname', lastname = '$lastname', user_address = '$address'  WHERE id = '$id'";
	
	$result = mysqli_query($connection, $sqlupdatestatus);
	
	if($result){
	  $message["success"] = "1";
      $message["message"] = "Account successfully updated";  
      
      echo json_encode($message);
	}
	
	else{
	  $message["success"] = "0";
      $message["message"] = "Account failed to update";  
      
      echo json_encode($message); 
	}


?>