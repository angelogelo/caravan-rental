<?php
    $page = 'list-of-booking';
    include 'header.php';
?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">List of Bookings</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-warning card-outline">
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table id="bookingTable" class="table table-hover table-striped table-sm text-sm">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort" >Booking #</th>
                                        <th>Customer Name</th>
                                        <th>Vehicle</th>
                                        <th>Pick Up Date</th>
                                        <th>Return Date</th>
                                        <th>Mode of Payment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $rent = $connection->query("SELECT * FROM tbl_rents ORDER BY id ASC");
                                        while($rent_row = $rent->fetch_array()){

                                            $customer = $connection->query("SELECT * FROM user WHERE id = '".$rent_row['customer_id']."'");
                                            $customer_row = $customer->fetch_array();

                                            $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$rent_row['vehicle_id']."'");
                                            $vehicle_row = $vehicle->fetch_array();

                                            $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$rent_row['vehicle_id']."'");
                                            $vehicle_row = $vehicle->fetch_array();

                                            if ($rent_row['rent_status'] == 0) {
                                                $status = '<span class="right badge badge-warning">Pending</span>';
                                            }else if ($rent_row['rent_status'] == 1){
                                                $status = '<span class="badge badge-success">Approved</span>';
                                            }else {
                                                $status = '<span class="badge badge-danger">Cancelled</span>';
                                            }
                                    ?>
                                    <tr>
                                        <td><?= $rent_row['booking_number']; ?></td>
                                        <td><?= ucwords($customer_row['firstname'].' '.$customer_row['lastname']); ?></td>
                                        <td><?= $vehicle_row['vehicle_name']; ?></td>
                                        <td><?= date('F d, Y', strtotime($rent_row['pick_up_date'])); ?></td>
                                        <td><?= date('F d, Y', strtotime($rent_row['return_date'])); ?></td>
                                        <td><?= $rent_row['mode_of_payment']; ?></td>
                                        <td><?= $status; ?></td>
                                        <td>
                                           
                                            <?php if($rent_row['rent_status'] == 0 AND $rent_row['mode_of_payment'] == 'GCash') {?>
                                                <button class="btn btn-primary btn-xs view-booking" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $rent_row['id']; ?>"><i class="fas fa-eye"></i></button>
                                            <?php } ?>

                                            <?php if($rent_row['rent_status'] == 0 AND $rent_row['mode_of_payment'] == 'Cash On Pickup') {?>
                                                <button class="btn btn-primary btn-xs view-booking" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $rent_row['id']; ?>"><i class="fas fa-eye"></i></button>
                                                
                                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#payment-modal<?php echo $rent_row['id']; ?>"><i class="fas fa-cash-register"></i></button>
                                                
                                                <div class="modal fade" id="payment-modal<?php echo $rent_row['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Payment Information</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" post="method" id="paymentAddForm" id="payment-modal<?php echo $rent_row['id']; ?>">
                                                                <div class="modal-body">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Amount to pay: <?= $rent_row['total_amount']; ?></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Amount</label>
                                                                                <input type="number" name="amount" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <input type="hidden" value="<?= $rent_row['id']; ?>" name="booking_id">
                                                                    <input type="text" value="<?= $rent_row['customer_id']; ?>" name="customer_id">
                                                                    <input type="text" value="<?= $rent_row['total_amount']; ?>" name="total_amount">

                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div><!-- /.table-responsive -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.column -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php'; ?>

<script>
    $(function(){

        $('#bookingTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
        });

        $(document).on('click', '.view-booking', function(){
            var id = $(this).attr('data-id');
            window.location.href = 'view-bookings.php?id='+id;
        });

        $('#paymentAddForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/payment-add.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                console.log(data);
                    if (data === "Failed") {
                        swal({
                            title: "Failed to add payment. Please try again later.!",
                            icon: "info"
                        });
                    }else if (data === "Error") {
                        swal({
                            title: "Already Pay!",
                            icon: "info"
                        });
                    }else {
                        swal({
                            title: "Payment has been added!",
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