<?php 
 
 /*
 * Created by Gifted
 * website: www.simplifiedcoding.net 
 * Retrieve Data From MySQL Database in Android
 */
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'id18669700_rental_cars');
 define('DB_PASS', 'N@<3+cD2>lhj=uKW');
 define('DB_NAME', 'id18669700_rental');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT id, driver_name, address, contact_no, driver_photo, total_exp, license_no FROM tbl_driver WHERE driver_status = 1");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 //$stmt->bind_result($product_id, $product_name,  $product_description, $product_price);
 $stmt->bind_result($driversId,$driversName, $driversAddress,  $driversMobile, $driversPhoto, $driversExp, $driversLicense);
 
 //$products = array(); 
 $drivers = array();
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Number'] = $driversId; 
 $temp['Name'] = $driversName; 
 $temp['Address'] = $driversAddress; 
 $temp['Mobile'] = $driversMobile; 
 $temp['drivers_photo'] = $driversPhoto; 
 $temp['drivers_exp'] = $driversExp; 
 $temp['drivers_license'] = $driversLicense; 
 array_push($drivers, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($drivers);