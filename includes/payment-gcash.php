<?php
$conn=mysqli_connect("localhost","u315516982_caravan_rental","Vt9:iESO|sf");
mysqli_select_db($conn,"u315516982_caravan_rental");

$picture_tmp = $_FILES['proof_of_payment']['tmp_name'];
$picture_name = $_FILES['proof_of_payment']['name'];
$picture = time()."_".$picture_name;

$transaction_no = "";
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