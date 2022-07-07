<?php
$conn=mysqli_connect("localhost","id18669700_rental_cars","N@<3+cD2>lhj=uKW");
mysqli_select_db($conn,"id18669700_rental");

$picture_tmp = $_FILES['proof_of_payment']['tmp_name'];
$picture_name = $_FILES['proof_of_payment']['name'];
$picture = time()."_".$picture_name;

$transaction_no = rand();
$booking_id = "1";
$customer_id = "1";
$payment_type = "1";
$amount = "1";


if (move_uploaded_file($picture_tmp, '../proof_of_payment/'.$picture)) {

    $insert = $connection->query("INSERT INTO tbl_payment (
        transaction_no, 
        proof_of_payment, 
        booking_id, 
        customer_id, 
        payment_type, 
        amount,
        created_at
    ) VALUES (
        '$transaction_no',
        '$picture',
        '$booking_id',
        '$customer_id',
        '$payment_type',
        '$amount',
        '$timeNow'
    )");

    echo "File Uploaded Successfully";

}else{
    echo "Image Failed";
}
?>