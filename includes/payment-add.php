<?php

    include 'connection.php';

    $amount = $_POST['amount'];
    $payment_type = 'Full Payment';
    $transaction_no = rand();
    $booking_id = $_POST['booking_id'];
    $customer_id = $_POST['customer_id'];
    $status = 1;
    $total_amount = $_POST['total_amount'];
    
    // if($amount < $total_amount){
    
    //     $select = $connection->query("SELECT * FROM tbl_payment WHERE booking_id = '".$booking_id."'");
        
    //     if($select->num_rows < 1){
    //         $insert = $connection->query("INSERT INTO tbl_payment (transaction_no, booking_id, customer_id, payment_type, amount, status, confirmation_date, created_at) VALUES ('$transaction_no','$booking_id', '$customer_id', '$payment_type', '$amount', '$status', '$timeNow', '$timeNow')");
    //         if($insert === TRUE){
    //             echo "Added";
    //         }else{
    //             echo "Failed";
    //         }
    //     }else{
    //       echo "Error";
    //     }
        
    // }else{
    //   echo "Limit";
    // }
    
     $select = $connection->query("SELECT * FROM tbl_payment WHERE booking_id = '".$booking_id."'");
     
    if($select->num_rows < 1){
        if($amount == $total_amount){
            
            $insert = $connection->query("INSERT INTO tbl_payment (transaction_no, booking_id, customer_id, payment_type, amount, status, confirmation_date, created_at) VALUES ('$transaction_no','$booking_id', '$customer_id', '$payment_type', '$amount', '$status', '$timeNow', '$timeNow')");
            echo "Added";
        }else{
            echo "Limit";    
        }
    }else{
        echo "Failed";
    }

    
   
?>