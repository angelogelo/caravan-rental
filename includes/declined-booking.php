<?php  
	
	include 'connection.php';
	
	$update_id = $_POST['update_id'];
    $reason = $_POST['reason'];
    $admin = 'Administrator';
    
    $customer_id = $_POST['customer_id'];

	$update = $connection->query("UPDATE tbl_rents SET rent_status = '2', reason = '$reason', cancelledBy = '$admin'  WHERE id = '$update_id'");
	
	if ($update === TRUE) {
	    
	    include '../functions/send-email.php';

		$select = $connection->query("SELECT * FROM user WHERE id = '$customer_id'");
		$select_row = $select->fetch_array();

        $email = $select_row['email'];
        $name = $select_row['firstname'].' '.$select_row['lastname'];

		$to = $email;
		$subject = 'Booking has been Cancel';
		
		$body = ' '.$reason.'<br><br>

                If you need to get in touch, you can email or message us via in app..!
            <br><br><br>';
		
		sendMail($to, $name, $subject, $body);
		
		echo "Declined";
	}else{
		echo "Failed";
	}

?>