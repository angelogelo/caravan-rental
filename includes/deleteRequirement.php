<?php 

    $host = "localhost";
	$username = "u847377087_caravan_rental";
 	$password = "9*cq3>X64J:x";
	$database = "u847377087_caravan_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$id = $_POST['id'];
	
	$sqlupdatestatus = "DELETE FROM tbl_requirements_photo WHERE id = '$id'";
	
	$result = mysqli_query($connection, $sqlupdatestatus);
	$row = mysqli_fetch_array($result);
	$target_dir = "../user-photo/".$row['photo'];
	unlink($target_dir);
	if($result){
	
	  $message["success"] = "1";
      $message["message"] = "Successfully deleted";  
      
      echo json_encode($message);
	}
	
	else{
	  $message["success"] = "0";
      $message["message"] = "Failed to delete";  
      
      echo json_encode($message); 
	}


?>