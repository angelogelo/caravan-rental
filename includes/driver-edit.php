<?php

    include 'connection.php';

    $picture_tmp = $_FILES['driver_photo']['tmp_name'];
	$picture_name = $_FILES['driver_photo']['name'];
	$picture = time()."_".$picture_name;
    
    $driver_id = $_POST['driver_id'];
    $driver_name = $_POST['driver_name'];
    $contact_no = $_POST['contact_no'];
    $birthdate = $_POST['birthdate'];
    $license_no = $_POST['license_no'];
    $license_expiry = $_POST['license_expiry'];
    $total_exp = $_POST['total_exp'];
    $address = $_POST['address'];
    $date_joining = $_POST['date_joining'];
    $license_restriction = $_POST['license_restriction'];

    if($picture_tmp !== ""){
        if (move_uploaded_file($picture_tmp, '../drivers-photo/'.$picture)) {
            $update = $connection->query("UPDATE tbl_driver SET
                driver_photo = '$picture', 
                driver_name = '$driver_name',
                contact_no = '$contact_no',
                birthdate = '$birthdate',
                license_no = '$license_no',
                license_expiry = '$license_expiry',
                license_restriction = '$license_restriction',
                total_exp = '$total_exp',
                address = '$address',
                date_joining = '$date_joining'
            WHERE id = '$driver_id';
            ");
            if($update === TRUE){
                echo "Updated";
            }
        }else{
            echo "Failed";
        }
    }else{
        $update = $connection->query("UPDATE tbl_driver SET
            driver_name = '$driver_name',
            contact_no = '$contact_no',
            birthdate = '$birthdate',
            license_no = '$license_no',
            license_expiry = '$license_expiry',
            license_restriction = '$license_restriction',
            total_exp = '$total_exp',
            address = '$address',
            date_joining = '$date_joining'
        WHERE id = '$driver_id';
        ");
        if($update === TRUE){
            echo "Updated";
        }else{
            echo "Failed";
        }
    }

?>