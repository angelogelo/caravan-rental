<?php

	session_start();

	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "caravan-rental";

    // $host = "localhost";
	// $username = "id18669700_rental_cars";
 	// $password = "N@<3+cD2>lhj=uKW";
	// $database = "id18669700_rental";

	$connection = new mysqli($host, $username, $password, $database);
	
	$code = substr(md5(mt_rand()), 0, 12);

	date_default_timezone_set('Asia/Manila');
	$timeNow = date('Y-m-d H:i:s', time());

	$regex = "/^[a-zA-Z]+$/";

	$select_available = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 0");
    $available = $select_available->num_rows;

    $select_on_rent = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 1");
    $on_rent = $select_on_rent->num_rows;

    $rents = $connection->query("SELECT * FROM tbl_rents WHERE rent_status = 1");
    $total_renter = $rents->num_rows;

    $customer = $connection->query("SELECT * FROM user WHERE type = 'customer'");
    $total_customer = $customer->num_rows;

	if (isset($_GET['id']) && isset($_GET['status'])) {  
        $id=$_GET['id'];  
        $status=$_GET['status'];  
        mysqli_query($connection,"update tbl_driver set driver_status='$status' where id='$id'");
       	header("location:../admin/driver-list.php");
        die();  
    }

?>