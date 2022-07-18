<?php 
 
 /*
 * Created by Gifted
 * website: www.simplifiedcoding.net 
 * Retrieve Data From MySQL Database in Android
 */
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'u315516982_caravan_rental');
 define('DB_PASS', 'Vt9:iESO|sf');
 define('DB_NAME', 'u315516982_caravan_rental');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT rents.*, vehicle.vehicle_photo, vehicle.vehicle_name FROM tbl_rents rents, tbl_vehicle vehicle WHERE rents.vehicle_id = vehicle.id");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 
 $stmt->bind_result($id,$booking_number,$invoice_number, $transaction_no, $customer_id, $driver_id, $vehicle_id, $package_amount, $rent_days, $total_amount, $package_type, $booking_date, $pick_up_date, $return_date, $approved_date, $location,$mode_of_payment, $rent_status, $reason, $cancelledBy, $vehicle_photo, $vehicle_name);
 
 $allrent = array();
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['id'] = $id;
 $temp['booking_number'] = $booking_number;
 $temp['invoice_number'] = $invoice_number;
 $temp['transaction_no'] = $transaction_no; 
 $temp['customer_id'] = $customer_id;
 $temp['driver_id'] = $driver_id;
 $temp['vehicle_id'] = $vehicle_id;
 $temp['package_amount'] = $package_amount; 
 $temp['rent_days'] = $rent_days; 
 $temp['total_amount'] = $total_amount;
 $temp['package_type'] = $package_type;
 $temp['booking_date'] = $booking_date;
 $temp['pick_up_date'] = $pick_up_date;
 $temp['return_date'] = $return_date;
 $temp['approved_date'] = $approved_date;
 $temp['location'] = $location;
 $temp['mode_of_payment'] = $mode_of_payment;
 $temp['rent_status'] = $rent_status;
 $temp['reason'] = $reason;
  $temp['cancelledBy'] = $cancelledBy;
 $temp['vehicle_photo'] = $vehicle_photo;
 $temp['vehicle_name'] = $vehicle_name;
 array_push($allrent, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($allrent);