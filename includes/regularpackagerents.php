<?php
define('HOST','localhost');
define('USER','id18669700_rental_cars');
define('PASS','N@<3+cD2>lhj=uKW');
define('DB','id18669700_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);
$Customer_ID = $_GET["customer_id"];
$sql = "SELECT rents.*, vehicle.vehicle_photo, vehicle.vehicle_transmission, vehicle.vehicle_name, vehicle.year_model, vehicle.seat_capacity, vehicle.manufactured_by,vehicle.plate_number, vehicle.vehicle_color, vehicle.registration_expiry, vehicle.price, vehicle.vehicle_status FROM tbl_rents rents, tbl_vehicle vehicle WHERE rents.vehicle_id = vehicle.id AND rents.customer_id like '%$Customer_ID%' AND rents.package = 'Regular Package'";
 
$res = mysqli_query($con,$sql);
 
$pendingRents = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingRents,array('id'=>$row[0],'customer_id'=>$row[1],'driver_id'=>$row[2],'vehicle_id'=>$row[3],'total_price'=>$row[4],'package'=>$row[5],'pick_up_date'=>$row[6],'return_date'=>$row[7],'location'=>$row[8],'mode_of_payment'=>$row[9],'rent_status'=>$row[10],'rent_days'=>$row[11],'approved_date'=>$row[12],'reason'=>$row[13],'created_at'=>$row[14],'vehicle_photo'=>$row[15],'vehicle_transmission'=>$row[16],'vehicle_name'=>$row[17],'year_model'=>$row[18],'seat_capacity'=>$row[19],'manufactured_by'=>$row[20],'plate_number'=>$row[21],'vehicle_color'=>$row[22],'registration_expiry'=>$row[23],'price'=>$row[24],'vehicle_status'=>$row[25]

));
}
 
echo json_encode(array("tbl_rent"=>$pendingRents));
 
mysqli_close($con);
 
?>