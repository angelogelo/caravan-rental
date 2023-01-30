<?php 
 

 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'u847377087_caravan_rental');
 define('DB_PASS', '9*cq3>X64J:x');
 define('DB_NAME', 'u847377087_caravan_rental');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
$customer_id = $_POST['customer_id'];
 //creating a query
 $stmt = $conn->prepare("SELECT id, customer_id, photo, created_at FROM tbl_requirements_photo WHERE customer_id = '$customer_id'");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($id,$customer_id,$photo,$created_at);
 
 //$products = array(); 
 $drivers = array();
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['id'] = $id;
 $temp['customer_id'] = $customer_id;
 $temp['photo'] = $photo;
 $temp['created_at'] = $created_at;
 array_push($drivers, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($drivers);