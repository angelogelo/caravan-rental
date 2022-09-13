<?php
    $page = 'reports';
    include 'header.php';
?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Reports</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            
            <div class="col-lg-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Vehicle</h3>
                    </div>
                    <form class="form-horizontal" method="GET" action="print-reports.php" enctype="multipart/form-data">
                        <div class="card-body">
                                
                            <div class="form-group">
                                <span><b>Vehicle</b></span>
                                <select class="form-control form-control-sm" name="vehicle_id" required>
                                    <option>--- Select Vehicle --</option>
                                    <?php
                                        $vehicle = $connection->query("SELECT * FROM tbl_vehicle");
                                        while($vehicle_row = $vehicle->fetch_array()){
                                    ?>
                                    <option value="<?php echo $vehicle_row['id']; ?>">
                                        <?php echo $vehicle_row['vehicle_name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <span><b>Start Date</b></span>
                                <input type="date" name="start" class="form-control form-control-sm" required>
                            </div>
                            
                            <div class="form-group">
                                <span><b>End Date</b></span>
                                <input type="date" name="end" class="form-control form-control-sm" required>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="add" class="btn btn-success btn-sm float-right"><i class="fas fa-save"></i> Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Driver</h3>
                    </div>
                    <form class="form-horizontal" method="GET" action="print-report-driver.php" enctype="multipart/form-data">
                        <div class="card-body">
                                
                            <div class="form-group">
                                <span><b>Vehicle</b></span>
                                <select class="form-control form-control-sm" name="driver_id" required>
                                    <option>--- Select Driver --</option>
                                    <?php
                                        $driver = $connection->query("SELECT * FROM tbl_driver");
                                        while($driver_row = $driver->fetch_array()){
                                    ?>
                                    <option value="<?php echo $driver_row['id']; ?>">
                                        <?php echo $driver_row['driver_name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <span><b>Start Date</b></span>
                                <input type="date" name="start" class="form-control form-control-sm" required>
                            </div>
                            
                            <div class="form-group">
                                <span><b>End Date</b></span>
                                <input type="date" name="end" class="form-control form-control-sm" required>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="add" class="btn btn-success btn-sm float-right"><i class="fas fa-save"></i> Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div><!-- /.row -->


    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>