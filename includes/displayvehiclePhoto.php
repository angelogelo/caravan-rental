<?php 
 
 /*
 * Created by Gifted
 * website: www.simplifiedcoding.net 
 * Retrieve Data From MySQL Database in Android
 */
 
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
 
 //creating a query
 $stmt = $conn->prepare("SELECT id, vehicle_id, vehicle_name, created_at FROM tbl_vehicle_photo");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 //$stmt->bind_result($product_id, $product_name,  $product_description, $product_price);
 $stmt->bind_result($id,$vehicle_id, $vehicle_name,  $created_at);
 
 //$products = array(); 
 $vehicle_photo = array();
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['id'] = $id; 
 $temp['vehicle_id'] = $vehicle_id; 
 $temp['vehicle_name'] = $vehicle_name; 
 $temp['created_at'] = $created_at; 
 array_push($vehicle_photo, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($vehicle_photo);