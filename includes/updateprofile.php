<?php 

    $host = "localhost";
	$username = "id18669700_rental_cars";
 	$password = "N@<3+cD2>lhj=uKW";
	$database = "id18669700_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phonenumber = $_POST['phonenumber'];
	$email = $_POST['email'];
	$address = $_POST['user_address'];
	$verification_status = $_POST['verification_status'];
	
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