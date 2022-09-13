<?php

$connect = mysqli_connect("localhost","u315516982_caravan_rental","Vt9:iESO|sf","u315516982_caravan_rental");

if(isset($_POST['proof_of_payment']) &&
    isset($_POST['booking_id']) &&
    isset($_POST['customer_id']) &&
    isset($_POST['payment_type']) &&
    isset($_POST['amount'])) 
    
{
    $timeNow = date('Y-m-d H:i:s', time());
    $target_dir = "proof-of-payment/";
    $proof_of_payment = $_POST['proof_of_payment'];
    $imageStore = rand()."_".time().".jpg";
    $target_dir = $target_dir."/".$imageStore;
    file_put_contents($target_dir, base64_decode($proof_of_payment));

	$transaction_no = rand();
	$booking_id = $_POST['booking_id'];
	$customer_id = $_POST['customer_id'];
	$payment_type = $_POST['payment_type'];
	$amount = $_POST['amount'];
	$created_at = $_POST['created_at']; 
	
    $result = array();
    $select = "INSERT INTO tbl_payment (transaction_no, proof_of_payment, booking_id, customer_id, payment_type, amount, created_at)
    VALUES ('$transaction_no', '$imageStore', '$booking_id', '$customer_id', ' $payment_type', '$amount', '$timeNow')";
    $response = mysqli_query($connect, $select);
    
    if($response)
    {
      $message["success"] = "1";
      $message["message"] = "Payment Details Uploaded";  
       echo json_encode($message);
    }
    else{
         $message["success"] = "0";
      $message["message"] = "Failed to update payment details";  
       echo json_encode($message);
    }
}


?>