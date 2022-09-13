<?php

    include 'connection.php';

    $picture_tmp = $_FILES['driver_photo']['tmp_name'];
	$picture_name = $_FILES['driver_photo']['name'];
	$picture = time()."_".$picture_name;

    $driver_name = $_POST['driver_name'];
    $contact_no = $_POST['contact_no'];
    $birthdate = $_POST['birthdate'];
    $license_no = $_POST['license_no'];
    $license_expiry = $_POST['license_expiry'];
    $total_exp = $_POST['total_exp'];
    $address = $_POST['address'];
    $date_joining = $_POST['date_joining'];
    $license_restriction = $_POST['license_restriction'];

    if (move_uploaded_file($picture_tmp, '../drivers-photo/'.$picture)) {

        $insert = $connection->query("INSERT INTO tbl_driver (
            driver_photo, 
            driver_name, 
            contact_no, 
            birthdate, 
            license_no, 
            license_expiry,
            license_restriction,
            total_exp,
            address,
            date_joining
        ) VALUES (
            '$picture',
            '$driver_name',
            '$contact_no',
            '$birthdate',
            '$license_no',
            '$license_expiry',
            '$license_restriction',
            '$total_exp',
            '$address',
            '$date_joining'
        )");

    }else{
        echo "Image Failed";
    }
?>