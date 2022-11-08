<?php
    $page = 'payment-list';
    include 'header.php';
?>

<style>
    .no-display{
        display: none;
    }
</style>

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
                    <div class="card-header border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Confirm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Refund</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Declined</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <div class="table-responsive">
                                    <table id="confirmTable" class="table table-condensed table-hover table-sm text-sm">
                                        <thead>
                                            <th class="no-display">#</th>
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
                                                $payment = $connection->query("SELECT * FROM tbl_payment WHERE status = 1 ORDER BY id ASC");
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
                                                <td class="no-display"><?= $payment_row['id']; ?></td>
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
                                                                                            <th>Total Amount</th>
                                                                                            <td><?= $booking_row['total_amount']; ?></td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Balance</th>
                                                                                            <td>
                                                                                                
                                                                                                <?php
                                                                                                $balance = $booking_row['total_amount'] - $payment_row['amount']; 
                                                                                                ?>
                                                                                                
                                                                                                <?= $balance; ?>
                                                                                                
                                                                                            </td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Payment Type</th>
                                                                                            <td><?= $payment_row['payment_type']; ?></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <input type="hidden" value="<?= $payment_row['payment_type']; ?>" name="payment_type">
                                                                            <input type="hidden" value="<?= $balance; ?>" name="balance">
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

                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                <div class="table-responsive">
                                <table id="refundTable" class="table table-condensed table-hover table-sm text-sm">
                                        <thead>
                                            <th class="no-display">#</th>
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
                                                $payment = $connection->query("SELECT * FROM tbl_payment WHERE status = 2 ORDER BY id ASC");
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
                                                <td class="no-display"><?= $payment_row['id']; ?></td>
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
                                                                                            <th>Total Amount</th>
                                                                                            <td><?= $booking_row['total_amount']; ?></td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Balance</th>
                                                                                            <td>
                                                                                                
                                                                                                <?php
                                                                                                $balance = $booking_row['total_amount'] - $payment_row['amount']; 
                                                                                                ?>
                                                                                                
                                                                                                <?= $balance; ?>
                                                                                                
                                                                                            </td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Payment Type</th>
                                                                                            <td><?= $payment_row['payment_type']; ?></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <input type="hidden" value="<?= $payment_row['payment_type']; ?>" name="payment_type">
                                                                            <input type="hidden" value="<?= $balance; ?>" name="balance">
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

                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <div class="table-responsive">
                                <table id="pendingTable" class="table table-condensed table-hover table-sm text-sm">
                                        <thead>
                                            <th class="no-display">#</th>
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
                                                $payment = $connection->query("SELECT * FROM tbl_payment WHERE status = 0 ORDER BY id ASC");
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
                                                <td class="no-display"><?= $payment_row['id']; ?></td>
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
                                                                                            <th>Total Amount</th>
                                                                                            <td><?= $booking_row['total_amount']; ?></td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Balance</th>
                                                                                            <td>
                                                                                                
                                                                                                <?php
                                                                                                $balance = $booking_row['total_amount'] - $payment_row['amount']; 
                                                                                                ?>
                                                                                                
                                                                                                <?= $balance; ?>
                                                                                                
                                                                                            </td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Payment Type</th>
                                                                                            <td><?= $payment_row['payment_type']; ?></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <input type="hidden" value="<?= $payment_row['payment_type']; ?>" name="payment_type">
                                                                            <input type="hidden" value="<?= $balance; ?>" name="balance">
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

                            <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                <div class="table-responsive">
                                <table id="declinedTable" class="table table-condensed table-hover table-sm text-sm">
                                        <thead>
                                            <th class="no-display">#</th>
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
                                                $payment = $connection->query("SELECT * FROM tbl_payment WHERE status = 3 ORDER BY id ASC");
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
                                                <td class="no-display"><?= $payment_row['id']; ?></td>
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
                                                                                            <th>Total Amount</th>
                                                                                            <td><?= $booking_row['total_amount']; ?></td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Balance</th>
                                                                                            <td>
                                                                                                
                                                                                                <?php
                                                                                                $balance = $booking_row['total_amount'] - $payment_row['amount']; 
                                                                                                ?>
                                                                                                
                                                                                                <?= $balance; ?>
                                                                                                
                                                                                            </td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <th>Payment Type</th>
                                                                                            <td><?= $payment_row['payment_type']; ?></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <input type="hidden" value="<?= $payment_row['payment_type']; ?>" name="payment_type">
                                                                            <input type="hidden" value="<?= $balance; ?>" name="balance">
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

                        </div><!-- /.tab-content -->

                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        
        </div>
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script>
    $(function(){

        $('#confirmTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
            "order": [ 0, 'desc' ],
        });

        $('#pendingTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
            "order": [ 0, 'desc' ],
        });

        $('#refundTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
            "order": [ 0, 'desc' ],
        });

        $('#declinedTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
            "order": [ 0, 'desc' ],
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