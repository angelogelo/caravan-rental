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
 $stmt = $conn->prepare("SELECT id, vehicle_photo, vehicle_transmission, vehicle_name, year_model, seat_capacity, manufactured_by, plate_number, vehicle_color, registration_expiry, regular_package, complete_package, vehicle_status FROM tbl_vehicle");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 
 $stmt->bind_result($vehiclesId,$vehiclesPhoto,$transmission, $vehicle_name, $year_model, $seat_capacity, $manufactured_by, $plate_number, $vehicle_color, $registration_expiry, $regular_package, $complete_package, $vehicle_status);
 
 
 $vehicles = array();
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['vehiclesId'] = $vehiclesId; 
 $temp['vehiclesPhoto'] = $vehiclesPhoto;
 $temp['transmission'] = $transmission;
 $temp['vehiclesName'] = $vehicle_name; 
 $temp['yearModel'] = $year_model;
 $temp['seatCapacity'] = $seat_capacity;
 $temp['manufacturedBy'] = $manufactured_by;
 $temp['vehiclesPlatenum'] = $plate_number; 
 $temp['vehicleColor'] = $vehicle_color; 
 $temp['registrationExpiry'] = $registration_expiry;
 $temp['regular_package'] = $regular_package;
 $temp['complete_package'] = $complete_package;
 $temp['vehicleStatus'] = $vehicle_status;
  
 array_push($vehicles, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($vehicles);