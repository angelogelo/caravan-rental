<?php
define('HOST','localhost');
define('USER','id18669700_rental_cars');
define('PASS','N@<3+cD2>lhj=uKW');
define('DB','id18669700_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);
$Customer_ID = $_GET["customer_id"];
$sql = "SELECT rents.*, vehicle.vehicle_photo, vehicle.vehicle_transmission, vehicle.vehicle_name, vehicle.year_model, vehicle.seat_capacity, vehicle.manufactured_by,vehicle.plate_number, vehicle.vehicle_color, vehicle.registration_expiry, vehicle.regular_package, vehicle.complete_package, vehicle.vehicle_status FROM tbl_rents rents, tbl_vehicle vehicle WHERE rents.vehicle_id = vehicle.id AND rents.customer_id like '%$Customer_ID%'";
 
$res = mysqli_query($con,$sql);
 
$pendingRents = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingRents,array('id'=>$row[0],'booking_number'=>$row[1],'invoice_number'=>$row[2],'transaction_no'=>$row[3],'customer_id'=>$row[4],'driver_id'=>$row[5],'vehicle_id'=>$row[6],'package_amount'=>$row[7],'rent_days'=>$row[8],'total_amount'=>$row[9],'package_type'=>$row[10],'booking_date'=>$row[11],'pick_up_date'=>$row[12],'return_date'=>$row[13],'approved_date'=>$row[14],'location'=>$row[15],'mode_of_payment'=>$row[16], 'rent_status'=>$row[17],'reason'=>$row[18],'vehicle_photo'=>$row[19],'vehicle_transmission'=>$row[20],'vehicle_name'=>$row[21],'year_model'=>$row[22],'seat_capacity'=>$row[23],'manufactured_by'=>$row[24],'plate_number'=>$row[25],'vehicle_color'=>$row[26],'registration_expiry'=>$row[27],'regular_package'=>$row[28],'complete_package'=>$row[29],'vehicle_status'=>$row[30]

));
}
 
echo json_encode(array("tbl_rent"=>$pendingRents));
 
mysqli_close($con);
 
?>