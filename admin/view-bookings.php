<?php
    $page = 'list-of-booking';
    include 'header.php';

    $id = $_GET['id'];
    $booking = $connection->query("SELECT * FROM tbl_rents WHERE id = '$id'");
    $booking_row = $booking->fetch_array();

    $customer = $connection->query("SELECT * FROM user WHERE id = '".$booking_row['customer_id']."'");
    $customer_row = $customer->fetch_array();

    $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$booking_row['vehicle_id']."'");
    $vehicle_row = $vehicle->fetch_array();

    $driver = $connection->query("SELECT * FROM tbl_driver WHERE id = '".$booking_row['driver_id']."'");
    // $driver_row = $driver->fetch_array();

    $payment = $connection->query("SELECT * FROM tbl_payment WHERE booking_id = '$id' AND status = 1");
    $payment_row = $payment->fetch_array();

    if ($booking_row['rent_status'] == 0) {
        $booking_status = '<span class="right badge badge-warning">Pending</span>';
    }else if ($booking_row['rent_status'] == 1){
        $booking_status = '<span class="badge badge-success">Approved</span>';
    }else {
        $booking_status = '<span class="badge badge-danger">Declined</span>';
    }

    $total_payment_balance = $booking_row['total_amount'] - $payment_row['amount'];

    $booking_status = $connection->query("SELECT * FROM tbl_rents WHERE id = '$id' AND rent_status = 1");

?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="callout callout-warning">
                    <h5><i class="fas fa-info"></i> Booking No:</h5>
                   <strong> #<?= $booking_row['booking_number']; ?></strong>
                </div>

                <!-- Main content -->
                <div class="callout callout-warning">
                    <!-- title row -->
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
                    </div><!-- info row -->

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


                    <?php if($payment->num_rows < 1){ ?>

                        <h6 class="text-danger"> No Payments has been made</h6>

                    <?php } else { ?>

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
                                                <?php
                                                    if ($payment_row['status'] == 0) {
                                                        $payment_status = '<span class="right badge badge-warning">Pending</span>';
                                                    }else if ($payment_row['status'] == 1){
                                                        $payment_status = '<span class="badge badge-success">Confirmed</span>';
                                                    }else if ($payment_row['status'] == 2){
                                                        $payment_status = '<span class="badge badge-secondary">Refund</span>';
                                                    }else {
                                                        $payment_status = '<span class="badge badge-danger">Cancelled</span>';
                                                    }
                                                ?>

                                                <?php echo $payment_status; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </thead>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="lead">Payment Methods</p>
                                <?php
                                    if($booking_row['mode_of_payment'] == 'Cash On Pickup'){
                                
                                ?>
                                    <img src="../assets/images/cash.jfif" style="height: 100px;">
                                <?php
                                    }else{
                                ?>
                                    <img src="../assets/images/gcash.png" style="height: 100px;">
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="col-lg-6">
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

                    <?php } ?>
                    
                    <?php if($payment->num_rows < 1){ ?>
                        
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#declineBooking<?php echo $booking_row['id']; ?>">
                                Cancel Booking
                            </button>

                            <div class="modal fade" id="declineBooking<?php echo $booking_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 mb-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="" method="POST" enctype="multipart/form-data" class="declinedBookingForm" id="declinedBookingForm<?php echo $booking_row['id']; ?>" data-id="<?php echo $booking_row['id']; ?>">

                                            <div class="modal-body mt-0">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <p class="h6">Are you sure you want to cancelled this booking?</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="">Reason</label>
                                                        <textarea name="reason" class="form-control" id="reason" cols="5" rows="5" required></textarea>
                                                    </div>
                                                </div>	
                                                <input type="hidden" name="update_id" id="update_id" value="<?php echo $booking_row['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                            </div><!-- /.modal-body -->
                                        </form><!-- /.form -->

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal-fade -->
                        </div>

                    <?php } elseif($booking_status->num_rows < 1){ ?>
                        <div class="text-center">
                            
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirmBooking<?php echo $booking_row['id']; ?>">
                                Confirm Booking
                            </button>
                            

                            <!-- approved modal-->
                            <div class="modal fade" id="confirmBooking<?php echo $booking_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <form action="" method="POST" enctype="multipart/form-data" class="confirmBookingForm" id="confirmBookingForm<?php echo $booking_row['id']; ?>" data-id="<?php echo $booking_row['id']; ?>">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <p class="h6">Are you sure you want to approve this booking reservation?</p>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="update_id" id="update_id" value="<?php echo $booking_row['id']; ?>">
                                                <input type="hidden" name="driver_id" id="update_id" value="<?php echo $driver_row['id']; ?>">
                                                <input type="hidden" name="vehicle_id" id="update_id" value="<?php echo $vehicle_row['id']; ?>">
                                                <input type="hidden" name="customer_id" id="update_id" value="<?php echo $booking_row['customer_id']; ?>">
                                                <input type="hidden" name="mop" value="<?php echo $booking_row['mode_of_payment']; ?>">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="margin-right: 10px;">Cancel</button>
                                                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                            </div><!-- /.modal-body -->
                                        </form><!-- /.form -->

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal-fade -->

                        </div>
                    <?php }else { ?>
                    <?php } ?>
                </div>  

            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php'; ?>

<script>
    $(function(){

        $(document).on('submit', '.confirmBookingForm', function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var formData = new FormData($('#confirmBookingForm'+id)[0]);
            $.ajax({
                url: "../includes/confirm-booking.php",
                method: "POST",
                dataType: "TEXT",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                //console.log(data);
                if (data == "Failed") {
                    swal({
                        title: "Failed to approved booking. Please try again later.",
                        icon: "error"
                    });
                }else {
                    swal({
                        title: "Booking has been approved.",
                        icon: "success"
                        }).then(function(){
                        location.reload();
                    });
                }
                }
            })
        });

        $(document).on('submit', '.declinedBookingForm', function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var formData = new FormData($('#declinedBookingForm'+id)[0]);
            $.ajax({
                url: "../includes/declined-booking.php",
                method: "POST",
                dataType: "TEXT",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                //console.log(data);
                if (data == "Failed") {
                    swal({
                        title: "Failed to declined booking. Please try again later.",
                        icon: "error"
                    });
                }else {
                    swal({
                        title: "Booking has been declined.",
                        icon: "success"
                        }).then(function(){
                        location.reload();
                    });
                }
                }
            })
        });

    });
</script>