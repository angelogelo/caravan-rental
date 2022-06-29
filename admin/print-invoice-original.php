<?php
    $page = 'print-invoice';
    include 'header.php';

    $invoice_number = $_GET['invoice_number'];
    $invoice = $connection->query("SELECT * FROM tbl_invoice WHERE invoice_number = '$invoice_number'");
    $invoice_row = $invoice->fetch_array();

?>


<section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <h4>
                        <i class="fas fa-globe"> CARAVAN RENTAL Inc.</i>
                        <small class="float-right">Date: <?= date('M d, Y', strtotime($timeNow)); ?></small>
                    </h4>
                </div>
            </div>

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Caravan Rental Inc.</strong><br>
                        Mapandan, Pangasinan <br>
                        Phone: 1234567890 <br>
                        Email: caravan_renta0001@gmail.com
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?= $customer_row['firstname'].' '.$customer_row['lastname']; ?></strong><br>
                        Mapandan, Pangasinan <br>
                        Phone: <?= $customer_row['phonenumber']; ?>  <br>
                        Email: <?= $customer_row['email']; ?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #<?= $invoice_row['invoice_number']; ?></b>
                </div>
            </div>

            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <th>Qty</th>
                        <th>Vehicle Name</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?= $vehicle_row['vehicle_name']; ?></td>
                            <td>₱ <?= $rent_row['total_price']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <p class="lead">Payment Methods:</p>
                    <?php
                        if($rent_row['mode_of_payment'] == 'Cash On Pickup'){
                    
                    ?>
                        <img src="../assets/images/cash.jfif" style="height: 50px;">
                    <?php
                        }else{
                    ?>
                        <img src="../assets/images/gcash.png" style="height: 50px;">
                    <?php
                        }
                    ?>
                </div>

                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th>Total:</th>
                            <td>₱ <?= $rent_row['total_price']; ?></td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<?php include 'footer.php' ?>