<?php
define('HOST','localhost');
define('USER','id18669700_rental_cars');
define('PASS','N@<3+cD2>lhj=uKW');
define('DB','id18669700_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);
$Customer_ID = $_GET["customer_id"];
$sql = "SELECT * FROM `tbl_rents` WHERE customer_id like '%$Customer_ID%'";
 
$res = mysqli_query($con,$sql);
 
$pendingRents = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingRents,array('id'=>$row[0],'customer_id'=>$row[1],'driver_id'=>$row[2],'vehicle_id'=>$row[3],'total_price'=>$row[4],'package'=>$row[5],'pick_up_date'=>$row[6],'return_date'=>$row[7],'location'=>$row[8],'mode_of_payment'=>$row[9],'rent_status'=>$row[10],'rent_days'=>$row[11],'created_at'=>$row[12]

));
}
 
echo json_encode(array("tbl_rents"=>$pendingRents));
 
mysqli_close($con);
 
?>