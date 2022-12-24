<?php

    include 'connection.php';

    $payment_id = $_POST['payment_id'];
    $balance = $_POST['balance'];
    $amount = $_POST['amount'];
    $customer_id = $_POST['customer_id'];

    $booking_id = $_POST['booking_id'];
    $transaction_no = $_POST['transaction_no'];
    $payment_type = $_POST['payment_type'];

    $update = $connection->query("UPDATE tbl_rents SET transaction_no = '$transaction_no' WHERE id = '$booking_id'");
    
    if($update === TRUE){

        $update_transaction_on_rents = $connection->query("UPDATE tbl_payment SET status = 1, confirmation_date = '$timeNow' WHERE id = '$payment_id'");

        include '../functions/send-email.php';

		$select = $connection->query("SELECT * FROM user WHERE id = '$customer_id'");
		$select_row = $select->fetch_array();

        $email = $select_row['email'];
        $name = $select_row['firstname'].' '.$select_row['lastname'];

		$to = $email;
		$subject = 'Payment Confirmation';

        if ($payment_type == 'Initial Payment'){
            $body = 'Hi, '.ucwords($name).'!<br><br>
            Your reservation to Caravan is now Confirmed. Your balance is Php '.$balance.'. <br>Please pay your remaining balance in cash, thank you and have a nice day!
            <br><br><br><br><br>
            This is an automatically generated email. Please do not reply to this email';
        }else{
            $body = 'Hi, '.ucwords($name).'!<br><br>
            Your reservation to Caravan is now Confirmed. Your balance is Php 0. Thank you and have a nice day!
            <br><br><br><br><br>
            This is an automatically generated email. Please do not reply to this email';
        }
        
		sendMail($to, $name, $subject, $body);
        
        echo "Added";
    }else{
        echo "Failed";
    }
   
?>