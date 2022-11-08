<?php
    $page = 'invoice_list';
    include 'header.php';
?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> Invoice List</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card card-outline card-warning">
                    <div class="card-body">
                        <table id="invoiceListTables" class="table table-condensed table-hover table-sm text-sm">
                            <thead>
                                <th class="display">#</th>
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>

                                <?php
                                    $invoice = $connection->query("SELECT * FROM tbl_invoice");
                                    while($invoice_row = $invoice->fetch_array()){

                                    $selectInvoice = $connection->query("SELECT * FROM tbl_rents WHERE invoice_number = '".$invoice_row['invoice_number']."'");
                                    $selectInvoiceRow = $selectInvoice->fetch_array();

                                    $customer = $connection->query("SELECT * FROM user WHERE id = '".$selectInvoiceRow['customer_id']."'");
                                    $customer_row = $customer->fetch_array();
                                ?>
                                <tr>
                                    <td class="display"><?= $invoice_row['id'];?></td>
                                    <td><?= $customer_row['firstname'];?> <?= $customer_row['lastname'];?></td>
                                    <td><?= $invoice_row['invoice_number'];?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs print-invoice" data-id="<?php echo $invoice_row['invoice_number']; ?>"><i class="fas fa-print"></i></button>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
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

        $('#invoiceListTables').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
            "order":[0,'desc']
        });

        $(document).on('click', '.print-invoice', function(){
            var invoice_number = $(this).attr('data-id');
            window.location.href = 'print-invoice.php?invoice_number='+invoice_number;
        });

        // $(document).on('click', '.edit-driver', function(){
        //     var id = $(this).attr('data-id');
        //     window.location.href = 'driver-edit.php?id='+id;
        // });

    });
</script>