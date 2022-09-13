<?php

    include 'connection.php';

    //for single photo
    $singel_tmp = $_FILES['single_photo']['tmp_name'];
	$single_name = $_FILES['single_photo']['name'];
	$picture = time()."_".$single_name;

    //for multiple photo
    $picture_tmp = $_FILES['vehicle_photo']['tmp_name'];
	$picture_name = $_FILES['vehicle_photo']['name'];
    $picture_count = count($_FILES['vehicle_photo']['name']);

    //details
    $vehicle_transmission = $_POST['vehicle_transmission'];
    $vehicle_name = $_POST['vehicle_name'];
    $year_model = $_POST['year_model'];
    $seat_capacity = $_POST['seat_capacity'];
    $manufactured_by = $_POST['manufactured_by'];
    $plate_number = $_POST['plate_number'];
    $vehicle_color = $_POST['vehicle_color'];
    $registration_expiry = $_POST['registration_expiry'];
    $price = $_POST['price'];
    $regular = $_POST['regular_package'];
    $complete = $_POST['complete_package'];

    $vehicle_category = $_POST['vehicle_category'];

    if (move_uploaded_file($singel_tmp, '../vehicles-photo/'.$picture)) {

        // $insert = $connection->query("INSERT INTO tbl_vehicle (
        //     vehicle_photo
        // ) VALUES (
        //     '$picture'
        // )");

        $insert = $connection->query("INSERT INTO tbl_vehicle (
            vehicle_category,
            vehicle_photo,
            vehicle_transmission, 
            vehicle_name, 
            year_model,
            seat_capacity, 
            manufactured_by,
            plate_number,
            vehicle_color,
            registration_expiry,
            regular_package,
            complete_package
        ) VALUES (
            '$vehicle_category',
            '$picture',
            '$vehicle_transmission',
            '$vehicle_name',
            '$year_model',
            '$seat_capacity',
            '$manufactured_by',
            '$plate_number',
            '$vehicle_color',
            '$registration_expiry',
            '$regular',
            '$complete'
        )");

        $last_id = $connection->insert_id;

    }else{

        echo "Image Failed";
    }
    
    for($i = 0; $i < $picture_count; $i++){

        $fileName = $_FILES['vehicle_photo']['name'][$i];
        
        if (move_uploaded_file($picture_tmp[$i], '../vehicles-photo/'.$fileName)) {

            $insert_photo = $connection->query("INSERT INTO tbl_vehicle_photo (vehicle_id, vehicle_name) VALUES ('$last_id', '$fileName')");
            echo "Added";
        }

    }


?>