<?php
define('HOST','localhost');
define('USER','u847377087_caravan_rental');
define('PASS','9*cq3>X64J:x');
define('DB','u847377087_caravan_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);
$Customer_ID = $_GET["customer_id"];
$sql = "SELECT requirements.id, requirements.customer_id, requirements.transactionno, requirements.photo, requirements.created_at FROM tbl_requirements_photo requirements WHERE requirements.customer_id like '%$Customer_ID%'";
 
$res = mysqli_query($con,$sql);
 
$pendingRents = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingRents,array('id'=>$row[0],'customer_id'=>$row[1],'transactionno'=>$row[2],'photo'=>$row[3],'created_at'=>$row[4]

));
}
 
echo json_encode(array("tbl_photo"=>$pendingRents));
 
mysqli_close($con);
 
?>