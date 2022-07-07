<?php
    $page = 'payment-list';
    include 'header.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Payment List</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card card-outline card-warning">
                    <div class="card-body">
                        <table id="paymentTables" class="table table-condensed table-hover table-sm text-sm">
                            <thead>
                                <th>Transcation #</th>
                                <th>Booking #</th>
                                <th>Customer Name</th>
                                <th>Payment Type</th>
                                <th>Mode of Payment</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <?php
                                    $payment = $connection->query("SELECT * FROM tbl_payment");
                                    while($payment_row = $payment->fetch_array()){

                                        $booking = $connection->query("SELECT * FROM tbl_rents WHERE id = '".$payment_row['booking_id']."'");
                                        $booking_row = $booking->fetch_array();

                                        $customer = $connection->query("SELECT * FROM user WHERE id = '".$payment_row['customer_id']."'");
                                        $customer_row = $customer->fetch_array();

                                        if ($payment_row['status'] == 0) {
                                            $status = '<span class="right badge badge-warning">Pending</span>';
                                        }else if ($payment_row['status'] == 1){
                                            $status = '<span class="badge badge-success">Confirm</span>';
                                        }else if ($payment_row['status'] == 2){
                                            $status = '<span class="badge badge-secondary">Refund</span>';
                                        }else {
                                            $status = '<span class="badge badge-danger">Declined</span>';
                                        }
                                ?>
                                <tr>
                                    <td><?= $payment_row['transaction_no']; ?></td>
                                    <td><?= $booking_row['booking_number']; ?></td>
                                    <td><?= ucwords($customer_row['firstname'].' '.$customer_row['lastname']); ?></td>
                                    <td><?= $payment_row['payment_type']; ?></td>
                                    <td><?= $booking_row['mode_of_payment']; ?></td>
                                    <td><?= $payment_row['amount']; ?></td>
                                    <td><?= $status; ?></td>
                                    <td>
                                        <?php
                                            if($booking_row['mode_of_payment'] == 'GCash' AND $payment_row['status'] == 0){
                                        ?>
                                            <button class="btn btn-primary btn-xs" title="View Proof of Payment" data-toggle="modal" data-target="#confirmation-modal"><i class="fas fa-eye"></i></button>

                                            <div class="modal fade" id="confirmation-modal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Payment Information</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" post="method" id="paymentConfirmation">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <table class="table">
                                                                            <tr>
                                                                                <th>Proof of Payment</th>
                                                                                <td>
                                                                                    <center>
                                                                                    <img class="img-fluid" src="../proof-of-payment/<?php echo $payment_row['proof_of_payment']; ?>" style="width: 70%;">
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Amount</th>
                                                                                <td><?= $payment_row['amount']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Payment Type</th>
                                                                                <td><?= $payment_row['payment_type']; ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                                <input type="hidden" value="<?= $payment_row['booking_id']; ?>" name="booking_id">
                                                                <input type="hidden" value="<?= $payment_row['transaction_no']; ?>" name="transaction_no">
                                                                <input type="hidden" value="<?= $payment_row['id']; ?>" name="payment_id">
                                                                <input type="hidden" value="<?= $payment_row['amount']; ?>" name="amount">
                                                                <input type="hidden" value="<?= $payment_row['customer_id']; ?>" name="customer_id">

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="submit" class="btn btn-success btn-sm">Confirm Payment</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                        <?php } else { ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script>
    $(function(){

        $('#paymentTables').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
        });

        $(document).on('click', '.print-invoice', function(){
            var id = $(this).attr('data-id');
            window.location.href = 'print-invoice.php?id='+id;
        });

        // $(document).on('click', '.edit-driver', function(){
        //     var id = $(this).attr('data-id');
        //     window.location.href = 'driver-edit.php?id='+id;
        // });

        $('#paymentConfirmation').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/payment-confirmation.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                console.log(data);
                    if (data === "Failed") {
                        swal({
                            title: "Failed to confirm payment. Please try again later.!",
                            icon: "info"
                        });
                    }else if (data === "Exist") {
                        swal({
                            title: "Payment has been Exist!",
                            icon: "info"
                        });
                    }else {
                        swal({
                            title: "Payment has been confirm!",
                            icon: "success"
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            })
        });

    });
</script>