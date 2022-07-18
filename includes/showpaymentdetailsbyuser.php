<?php
define('HOST','localhost');
define('USER','u315516982_caravan_rental');
define('PASS','Vt9:iESO|sf');
define('DB','u315516982_caravan_rental');


$con = mysqli_connect(HOST,USER,PASS,DB);
$Customer_ID = $_GET["customer_id"];
$sql = "SELECT payment.proof_of_payment, payment.payment_type payment.amount FROM tbl_payment payment WHERE
            payment.customer_id like '%$Customer_ID%'";
 
$res = mysqli_query($con,$sql);
 
$pendingPayment = array();
 
while($row = mysqli_fetch_array($res)){
array_push($pendingPayment,array('id'=>$row[0],'booking_number'=>$row[1],'invoice_number'=>$row[2]

));
}
 
echo json_encode(array("tbl_payment"=>$pendingPayment));
 
mysqli_close($con);
 
?>