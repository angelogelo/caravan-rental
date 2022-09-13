<?php

    include 'connection.php';

    $picture_tmp = $_FILES['vehicle_photo']['tmp_name'];
	$picture_name = $_FILES['vehicle_photo']['name'];
	$picture = time()."_".$picture_name;

    $vehicle_id = $_POST['vehicle_id'];
    $vehicle_transmission = $_POST['vehicle_transmission'];
    $vehicle_name = $_POST['vehicle_name'];
    $year_model = $_POST['year_model'];
    $seat_capacity = $_POST['seat_capacity'];
    $manufactured_by = $_POST['manufactured_by'];
    $plate_number = $_POST['plate_number'];
    $vehicle_color = $_POST['vehicle_color'];
    $registration_expiry = $_POST['registration_expiry'];
    $regular_package = $_POST['regular_package'];
    $complete_package = $_POST['complete_package'];
    $status = $_POST['status'];

    if($picture_tmp !== ""){
        if (move_uploaded_file($picture_tmp, '../vehicles-photo/'.$picture)) {
            $update = $connection->query("UPDATE tbl_vehicle SET
                vehicle_photo = '$picture', 
                vehicle_transmission = '$vehicle_transmission',
                vehicle_name = '$vehicle_name',
                year_model = '$year_model',
                seat_capacity = '$seat_capacity',
                manufactured_by = '$manufactured_by',
                plate_number = '$plate_number',
                vehicle_color = '$vehicle_color',
                registration_expiry = '$registration_expiry',
                regular_package = '$regular_package',
                complete_package = '$complete_package',
                vehicle_status = '$status'
            WHERE id = '$vehicle_id';
            ");
            if($update === TRUE){
                echo "Updated";
            }
        }else{
            echo "Failed";
        }
    }else{
        $update = $connection->query("UPDATE tbl_vehicle SET
            vehicle_transmission = '$vehicle_transmission',
            vehicle_name = '$vehicle_name',
            year_model = '$year_model',
            seat_capacity = '$seat_capacity',
            manufactured_by = '$manufactured_by',
            plate_number = '$plate_number',
            vehicle_color = '$vehicle_color',
            registration_expiry = '$registration_expiry',
            regular_package = '$regular_package',
            complete_package = '$complete_package',
            vehicle_status = '$status'
        WHERE id = '$vehicle_id';
        ");
        if($update === TRUE){
            echo "Updated";
        }else{
            echo "Failed";
        }
    }
    

    // $vehicle_id = $_POST['vehicle_id'];
    // $vehicle_transmission = $_POST['vehicle_transmission'];
    // $vehicle_name = $_POST['vehicle_name'];
    // $year_model = $_POST['year_model'];
    // $seat_capacity = $_POST['seat_capacity'];
    // $manufactured_by = $_POST['manufactured_by'];
    // $plate_number = $_POST['plate_number'];
    // $vehicle_color = $_POST['vehicle_color'];
    // $registration_expiry = $_POST['registration_expiry'];
    // $price = $_POST['price'];

    // $update = $connection->query("UPDATE tbl_vehicle SET
    //     vehicle_transmission = '$vehicle_transmission',
    //     vehicle_name = '$vehicle_name',
    //     year_model = '$year_model',
    //     seat_capacity = '$seat_capacity',
    //     manufactured_by = '$manufactured_by',
    //     plate_number = '$plate_number',
    //     vehicle_color = '$vehicle_color',
    //     registration_expiry = '$registration_expiry',
    //     price = '$price'
    // WHERE id = '$vehicle_id';
    // ");

    // if($update === TRUE){
    //     echo "Updated";
    // }else{
    //     echo "Failed";
    // }
    
?>