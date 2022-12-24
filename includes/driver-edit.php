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
    $res_input = $_POST['license_restriction'];

    if($picture_tmp !== ""){
        if (move_uploaded_file($picture_tmp, '../drivers-photo/'.$picture)) {
            $update = $connection->query("UPDATE tbl_driver SET
                driver_photo = '$picture', 
                driver_name = '$driver_name',
                contact_no = '$contact_no',
                birthdate = '$birthdate',
                license_no = '$license_no',
                license_expiry = '$license_expiry',
                total_exp = '$total_exp',
                address = '$address',
                date_joining = '$date_joining'
            WHERE id = '$driver_id';
            ");
            if($update === TRUE){

                $fetchquery = "SELECT * FROM driver_restriction WHERE driver_id = '$driver_id'";
                $fetchquery_run = mysqli_query($connection, $fetchquery);
                
                $dri_res = [];
                
                foreach($fetchquery_run as $fetchrow){
                    $dri_res[] = $fetchrow['driver_restriction'];
                }

                //Insert Data
                foreach($res_input as $inputValues){
                    if(!in_array($inputValues, $dri_res)){
                        $insert = $connection->query("INSERT INTO driver_restriction (driver_id, driver_restriction) VALUES ('$driver_id', '$inputValues')");
                    }
                }

                //Delete Data
                foreach($dri_res as $fetchedRow){
                    if(!in_array($fetchedRow, $res_input)){
                        $delete = $connection->query("DELETE FROM driver_restriction WHERE driver_id='$driver_id' AND driver_restriction='$fetchedRow'");
                    }
                }

                echo "Updated";
            }
        }else{
            echo "Failed";
        }
    }else{
        $update1 = $connection->query("UPDATE tbl_driver SET
            driver_name = '$driver_name',
            contact_no = '$contact_no',
            birthdate = '$birthdate',
            license_no = '$license_no',
            license_expiry = '$license_expiry',
            total_exp = '$total_exp',
            address = '$address',
            date_joining = '$date_joining'
        WHERE id = '$driver_id';
        ");
        if($update1 === TRUE){

            $fetchquery = "SELECT * FROM driver_restriction WHERE driver_id = '$driver_id'";
            $fetchquery_run = mysqli_query($connection, $fetchquery);
            
            $dri_res = [];
            
            foreach($fetchquery_run as $fetchrow){
                $dri_res[] = $fetchrow['driver_restriction'];
            }

            //Insert Data
            foreach($res_input as $inputValues){
                if(!in_array($inputValues, $dri_res)){
                    $insert = $connection->query("INSERT INTO driver_restriction (driver_id, driver_restriction) VALUES ('$driver_id', '$inputValues')");
                }
            }

            //Delete Data
            foreach($dri_res as $fetchedRow){
                if(!in_array($fetchedRow, $res_input)){
                    $delete = $connection->query("DELETE FROM driver_restriction WHERE driver_id='$driver_id' AND driver_restriction='$fetchedRow'");
                }
            }

            echo "Updated";
        }else{
            echo "Failed";
        }
    }

?>