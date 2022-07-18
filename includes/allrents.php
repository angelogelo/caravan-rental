<?php
define('HOST','localhost');
define('USER','u315516982_caravan_rental');
define('PASS','Vt9:iESO|sf');
define('DB','u315516982_caravan_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);

$sql = "SELECT rents.*, vehicle.vehicle_photo, vehicle.vehicle_name FROM tbl_rents rents, tbl_vehicle vehicle WHERE rents.vehicle_id = vehicle.id";
 
$res = mysqli_query($con,$sql);
 
$pendingRents = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingRents,array('id'=>$row[0],'booking_number'=>$row[1],'invoice_number'=>$row[2],'transaction_no'=>$row[3],'customer_id'=>$row[4],'driver_id'=>$row[5],'vehicle_id'=>$row[6],'package_amount'=>$row[7],'rent_days'=>$row[8],'total_amount'=>$row[9],'package_type'=>$row[10],'booking_date'=>$row[11],'pick_up_date'=>$row[12],'return_date'=>$row[13],'approved_date'=>$row[14],'location'=>$row[15],'mode_of_payment'=>$row[16], 'rent_status'=>$row[17],'reason'=>$row[18],'vehicle_photo'=>$row[19],'vehicle_name'=>$row[20]

));
}
 
echo json_encode(array("tbl_rent"=>$pendingRents));
 
mysqli_close($con);
 
?>