<?php
define('HOST','localhost');
define('USER','u847377087_caravan_rental');
define('PASS','9*cq3>X64J:x');
define('DB','u847377087_caravan_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);
$Customer_ID = $_GET["customer_id"];
$Vehicle_ID = $_GET["vehicle_id"];
$sql = "SELECT payment.id, payment.transaction_no, payment.payment_type, payment.amount, payment.confirmation_date, payment.created_at FROM tbl_payment payment WHERE payment.vehicle_id like '%$Vehicle_ID%' AND payment.customer_id like '%$Customer_ID%' ORDER BY payment.created_at DESC";
 
$res = mysqli_query($con,$sql);
 
$pendingRents = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingRents,array('id'=>$row[0],'transaction_no'=>$row[1],'payment_type'=>$row[2],'amount'=>$row[3],'confirmation_date'=>$row[4], 'created_at'=>$row[5], 

));
}
 
echo json_encode(array("tbl_payment"=>$pendingRents));
 
mysqli_close($con);
 
?>