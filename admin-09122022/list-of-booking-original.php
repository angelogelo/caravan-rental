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
</div>
<!-- /.content-header -->

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
                                        <th class="table-plus datatable-nosort" >#</th>
                                        <th>Customer Name</th>
                                        <th>Total Price</th>
                                        <th>Booking Date</th>
                                        <th>Processed Date</th>
                                        <th>Processed Remarks</th>
                                        <th>Mode of Payment</th>
                                        <th>Rent Status</th>
                                        <th style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $number = 1;
                                    $rent = $connection->query("SELECT * FROM tbl_rents");
                                    while($rent_row = $rent->fetch_array()){

                                      $customer = $connection->query("SELECT * FROM user WHERE id = '".$rent_row['customer_id']."'");
                                      $customer_row = $customer->fetch_array();

                                      $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$rent_row['vehicle_id']."'");
                                      $vehicle_row = $vehicle->fetch_array();

                                      $driver = $connection->query("SELECT * FROM tbl_driver WHERE id = '".$rent_row['driver_id']."'");
                                      $driver_row = $driver->fetch_array();

                                      if ($rent_row['rent_status'] == "0") {

                                        $status = '<span class="right badge badge-warning">Pending</span>';

                                      }else if ($rent_row['rent_status'] == "1"){

                                        $status = '<span class="badge badge-success">Approved</span>';

                                      }else {

                                        $status = '<span class="badge badge-danger">Declined</span>';

                                      }
                                  ?>
                                  <tr>
                                      <td><?= $number++; ?></td>
                                      <td><?= $customer_row['firstname'].' '.$customer_row['lastname']; ?></td>
                                      <td><?= $vehicle_row['price']; ?></td>
                                      <td><?= $rent_row['created_at']; ?></td>
                                      <td><?= $rent_row['approved_date']; ?></td>
                                      <td><?= $rent_row['reason']; ?></td>
                                      <td><?= $rent_row['mode_of_payment']; ?></td>
                                      <td><?= $status; ?></td>
                                      <td>
                                        <button class="btn btn-primary btn-xs viewVehicle" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $rent_row['id']; ?>"><i class="fas fa-eye"></i></button>
                                      
                                        <?php
                                          if ($rent_row['rent_status'] == 0) {
                                            ?>
                                            <!-- approved button -->
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#approvedReservation<?php echo $rent_row['id']; ?>"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Click to Approved"></i></button>

                                            <!-- approved modal-->
                                            <div class="modal fade" id="approvedReservation<?php echo $rent_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">

                                                  <form action="" method="POST" enctype="multipart/form-data" class="approvedReservationForm" id="approvedReservationForm<?php echo $rent_row['id']; ?>" data-id="<?php echo $rent_row['id']; ?>">

                                                  <div class="modal-body">
                                                    <div class="form-group row">
                                                      <div class="col-md-12">
                                                        <p class="h6">Are you sure you want to approve this booking reservation?</p>
                                                      </div>
                                                    </div>   
                                                  </div>

                                                  <div class="modal-footer">
                                                    <input type="hidden" name="update_id" id="update_id" value="<?php echo $rent_row['id']; ?>">
                                                    <input type="hidden" name="driver_id" id="update_id" value="<?php echo $driver_row['id']; ?>">
                                                    <input type="hidden" name="vehicle_id" id="update_id" value="<?php echo $vehicle_row['id']; ?>">
                                                    <input type="hidden" name="customer_id" id="update_id" value="<?php echo $rent_row['customer_id']; ?>">
                                                    <input type="hidden" name="mop" value="<?php echo $rent_row['mode_of_payment']; ?>">
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                                  </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>

                                            <!-- rejected button -->
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#declinedReservation<?php echo $rent_row['id']; ?>"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Click to Declined"></i></button>

                                            <!-- rejection modal-->
                                            <div class="modal fade" id="declinedReservation<?php echo $rent_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form action="" method="POST" class="declinedReservationForm" id="declinedReservationForm<?php echo $rent_row['id']; ?>" data-id="<?php echo $rent_row['id']; ?>" enctype="multipart/form-data">

                                                  <div class="modal-body">
                                                    <div class="form-group row">
                                                      <div class="col-md-12">
                                                        <p class="h6">Are you sure you want to reject this booking reservation?</p>
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <div class="col-md-12">
                                                        <label for="">Reason</label>
                                                        <textarea name="reason" class="form-control" id="reason" cols="5" rows="5" required></textarea>
                                                      </div>
                                                    </div>							      	   
                                                  </div>

                                                  <div class="modal-footer">
                                                    <input type="hidden" name="update_id" id="update_id" value="<?php echo $rent_row['id']; ?>">
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> Cancel</button>
                                                    <button type="submit" class="btn btn-danger btn-sm"> Decline</button>
                                                  </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                            <?php
                                          }else{
                                            ?>
                                            <?php
                                          }
                                        ?>
                                        
                                      </td>
                                  </tr>

                                  <div class="modal fade" id="viewVehicle<?php echo $rent_row['id']; ?>">
                                    <div class="modal-dialog modal-xl">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">
                                            <i class="fas fa-info-circle"></i> Booking Information
                                          </h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="card-body">
                                        <h3>Invoice #: </h3>
                                          <div class="row">
                                            <div class="col-lg-4">
                                              <div class="card card-warning card-outline">
                                                <div class="card-header">
                                                  <h4 class="card-title">Vehicle Details</h4>
                                                </div>
                                                <div class="card-body box-profile">
                                                  <div class="form-group">
                                                    <div class="text-center">
                                                    <?php  
                                                      if ($vehicle_row['vehicle_photo'] == "none" || $vehicle_row['vehicle_photo'] == NULL) {
                                                        ?>
                                                          <img src="../vehicles-photo/no_image.png" class="img-fluid">
                                                        <?php
                                                      }else {
                                                        ?>
                                                          <img src="../vehicles-photo/<?= $vehicle_row['vehicle_photo']; ?>" class="img-fluid">
                                                        <?php
                                                      }
                                                    ?>
                                                    </div>

                                                    <h3 class="profile-username text-center" style="font-size: 20px;"></h3>

                                                    <ul class="list-group list-group-unbordered mb-3">
                                                      <li class="list-group-item">
                                                        <b>Rent Status</b>
                                                        <a class="float-right">
                                                          <?php  
                                                            if ($rent_row['rent_status'] == "0") {
                                                              ?>
                                                                <span class="right badge badge-warning">Pending</span>
                                                              <?php
                                                            }else if ($rent_row['rent_status'] == "1"){
                                                              ?>
                                                                <span class="badge badge-success">Approved</span>
                                                              <?php
                                                            }else {
                                                              ?>
                                                                <span class="badge badge-danger">Declined</span>
                                                              <?php
                                                            }
                                                          ?>
                                                        </a>
                                                      </li>
                                                      <li class="list-group-item">
                                                          <b>Plate Number</b>
                                                          <span class="float-right"><?= $vehicle_row['plate_number']; ?></span>
                                                      </li>
                                                      <li class="list-group-item">
                                                          <b>Transmission</b>
                                                          <span class="float-right"><?= $vehicle_row['vehicle_transmission']; ?></span>
                                                      </li>
                                                      <li class="list-group-item">
                                                          <b>Seat Capacity</b>
                                                          <span class="float-right"><?= $vehicle_row['seat_capacity']; ?></span>
                                                      </li>
                                                      <li class="list-group-item">
                                                          <b>Destination</b>
                                                          <span class="float-right"><?= $rent_row['location']; ?></span>
                                                      </li>
                                                    </ul>
                                                  </div>
                                                </div>
                                              </div><!-- /.card-body -->
                                            </div><!-- /.col -->
                                                            
                                            <div class="col-lg-4">
                                              <div class="card card-warning card-outline">
                                                <div class="card-header">
                                                  <h4 class="card-title">Customer Details</h4>
                                                </div>
                                                <div class="card-body">
                                                  
                                                  <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                      <b>Customer name</b>
                                                      <span class="float-right"><?= $customer_row['firstname'].' '.$customer_row['lastname']; ?></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                      <b>Contact No</b>
                                                      <span class="float-right"><?= $customer_row['phonenumber']; ?></span>
                                                    </li>
                                                  </ul>

                                                </div><!-- /.card-body -->
                                              </div><!-- /.card -->
                                            </div><!-- /.col -->

                                            <div class="col-lg-4">
                                              <div class="card card-warning card-outline">
                                                <div class="card-header">
                                                  <h4 class="card-title">Driver Details</h4>
                                                </div>
                                                <div class="card-body">
                                                  
                                                  <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                      <b>Driver name</b>
                                                      <span class="float-right"><?= $driver_row['driver_name']; ?></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                      <b>Contact No</b>
                                                      <span class="float-right"><?= $driver_row['contact_no']; ?></span>
                                                    </li>
                                                  </ul>

                                                </div><!-- /.card-body -->
                                              </div><!-- /.card -->
                                            </div><!-- /.col -->

                                          </div><!-- /.row -->
                                        </div><!-- /.modal-body -->
                                      </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                  </div><!-- /.modal -->
                                  <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script type="text/javascript">
  $(function(){

    $(document).on('click', '.viewVehicle', function(){
      var id = $(this).attr('data-id');
      $('#viewVehicle'+id).modal('show');
    });

    $(document).on('click', '.approved_booking', function(){
      var id = $(this).attr('data-id');
      $('#approved_booking'+id).modal('show');
    });

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

    $(document).on('submit', '.approvedReservationForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#approvedReservationForm'+id)[0]);
      $.ajax({
        url: "../includes/approved-reservation.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          //console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to approved reservation. Please try again later.",
              icon: "error"
            });
          }else {
            swal({
              title: "Reservation has been approved.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    $(document).on('submit', '.declinedReservationForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#declinedReservationForm'+id)[0]);
      $.ajax({
        url: "../includes/declined-reservation.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          //console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to reject reservation. Please try again later.",
              icon: "error"
            });
          }else {
            swal({
              title: "Reservation has been declined.",
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