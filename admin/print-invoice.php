<?php

    include '../includes/connection.php';

    $invoice_number = $_GET['invoice_number'];
    $booking = $connection->query("SELECT * FROM tbl_rents WHERE invoice_number = '$invoice_number'");
    $booking_row = $booking->fetch_array();

    $customer = $connection->query("SELECT * FROM user WHERE id = '".$booking_row['customer_id']."'");
    $customer_row = $customer->fetch_array();

    $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$booking_row['vehicle_id']."'");
    $vehicle_row = $vehicle->fetch_array();

    $payment = $connection->query("SELECT * FROM tbl_payment WHERE booking_id = '".$booking_row['id']."'");
    $payment_row = $payment->fetch_array();

    if ($booking_row['rent_status'] == 0) {
        $booking_status = '<span class="right badge badge-warning">Pending</span>';
    }else if ($booking_row['rent_status'] == 1){
        $booking_status = '<span class="badge badge-success">Approved</span>';
    }else {
        $booking_status = '<span class="badge badge-danger">Declined</span>';
    }

    $total_payment_balance = $booking_row['total_amount'] - $payment_row['amount'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Caravan Rental System | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
   <!-- Logo -->
   <link rel="icon" href="../assets/images/caravan.png">
   <style>
       .disclaimer{
           display: none;
       }
   </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Main content -->
            <section class="invoice">

                <div class="card">
                    <div class="card-body">

                        <div class="row invoice-row">
                            <h2 class="col-sm-12 invoice-col">
                                <address>
                                    <img src="../assets/images/caravan.png" style="width: 200px;">
                                    <strong>Caravan Rental Inc.</strong>
                                </address>
                            </h2>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <h5><strong>Invoice No.: <?= $invoice_number; ?></strong></h5>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h4><strong>Customer Information</strong></h4>
                            </div>
                            <div class="col-sm-4">
                                <h4><strong>Vehicle Information</strong></h4>
                            </div>
                            <div class="col-sm-4">
                                <h4>
                                    <small class="float-right"><strong>Booking Date: </strong> <?= date('M d,Y', strtotime($booking_row['booking_date'])); ?></small>
                                </h4>
                            </div>
                        </div>

                        

                        <!-- 1st Row-->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Name: <?= ucwords($customer_row['firstname'].' '.$customer_row['lastname']); ?></strong><br>
                                    Address: <?= $customer_row['address']; ?><br>
                                    Contact No: <?= $customer_row['contact_no']; ?><br>
                                    Email: <?= $customer_row['email']; ?><br>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Vehicle Name: <?= ucwords($vehicle_row['vehicle_name']); ?></strong><br>
                                    Seat Capacity: <?= $vehicle_row['seat_capacity']; ?><br>
                                </address>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <h4><strong>Booking Information</strong></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 table-resposive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pick Up Date</th>
                                            <th>Return Date</th>
                                            <th>Package Type</th>
                                            <th>Total Rent Days</th>
                                            <th>Rent per Day</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><?= date('M d, Y H:i a', strtotime($booking_row['pick_up_date'])); ?></td>
                                                <td><?= date('M d, Y H:i a', strtotime($booking_row['return_date'])); ?></td>
                                                <td><?= ucwords($booking_row['package_type']); ?></td>
                                                <td><?= $booking_row['rent_days']; ?></td>
                                                <td><?= $booking_row['package_amount']; ?></td>
                                                <td>₱ <?= $booking_row['total_amount']; ?></td>
                                            </tr>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <h4><strong>Payment Information</strong></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 table-resposive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Payment Method</th>
                                            <th>Transaction No</th>
                                            <th>Proof of Payment</th>
                                            <th>Payment Type</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><?= $booking_row['mode_of_payment']; ?></td>
                                                <td><?= $payment_row['transaction_no']; ?></td>
                                                <td><?= $payment_row['proof_of_payment']; ?></td>
                                                <td><?= $payment_row['payment_type']; ?></td>
                                                <td><?= $payment_row['amount']; ?></td>
                                                <td>
                                                    <?php echo "Confirmed" ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4><strong>Payment Summary</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>₱ <?= $booking_row['total_amount']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Partial/Full Payment</th>
                                            <td>₱ <?= $payment_row['amount']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Balance:</th>
                                            <td>
                                                ₱
                                                <?= $total_payment_balance; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                
                    </div><!-- /.card-body -->
                </div><!-- /.card -->

                
            </section><!-- /.content -->
        </div>
    </div><!-- ./wrapper -->

<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
