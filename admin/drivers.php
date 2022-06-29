<?php
    $page = 'drivers';
    include 'header.php';

    $id = $_GET['id'];
    $driver = $connection->query("SELECT * FROM tbl_driver WHERE id = '$id'");
    $driver_row = $driver->fetch_array();
?>

<style>
    .list-group-item{
        padding:5px 15px;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="nav-icon fas fa-user-secret"></i> Driver Information</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-4">
                <div class="card card-warning card-outline">
                    <div class="card-body box-profile">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item text-center">
                                <img id="picture_display" src="../drivers-photo/<?php echo $driver_row['driver_photo']; ?>" class="img-fluid rounded" style="width: 200px;">    
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card card-warning card-outline card-tabs">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item text-sm" >
                                <a class="nav-link active" href="#tab1" data-toggle="tab">Driver Info</a>
                            </li>
                            <li class="nav-item text-sm">
                                <a class="nav-link" href="#tab2" data-toggle="tab">Bookings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="tab1">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Driver Name</b>
                                        <span class="float-right">
                                            <?= $driver_row['driver_name']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Contact No</b>
                                        <span class="float-right">
                                            <?= $driver_row['contact_no']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Birthdate</b>
                                        <span class="float-right">
                                            <?= $driver_row['birthdate']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>License No</b>
                                        <span class="float-right">
                                            <?= $driver_row['license_no']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>License Expiry</b>
                                        <span class="float-right">
                                            <?= $driver_row['license_expiry']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Experience</b>
                                        <span class="float-right">
                                            <?= $driver_row['total_exp']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Address</b>
                                        <span class="float-right">
                                            <?= $driver_row['address']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Date of Joining</b>
                                        <span class="float-right">
                                            <?= $driver_row['date_joining']; ?>
                                        </span>
                                    </li>
                                </ul>
                            </div><!-- tab-pane-->
                            <div class="tab-pane" id="tab2">
                                <table id="bookingsTable" class="table table-condensed table-hover table-sm text-sm">
                                    <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort" >#</th>
                                            <th>Vehicle</th>
                                            <th>Customer</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Booking Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $number = 1;
                                            $bookings = $connection->query("SELECT * FROM tbl_rents WHERE driver_id = '$id'");
                                            while($bookings_row = $bookings->fetch_array()){

                                                $customer = $connection->query("SELECT * FROM user WHERE id = '".$bookings_row['customer_id']."'");
                                                $customer_row = $customer->fetch_array();

                                                $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$bookings_row['vehicle_id']."'");
                                                $vehicle_row = $vehicle->fetch_array();
                                        ?>
                                        <tr>
                                            <td><?= $number++; ?></td>
                                            <td><?= $vehicle_row['vehicle_name']; ?></td>
                                            <td><?= $customer_row['firstname'].' '.$customer_row['lastname']; ?></td>
                                            <td><?= $number++; ?></td>
                                            <td><?= $bookings_row['location']; ?></td>
                                            <td><?= $bookings_row['total_price']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div><!-- tab-pane-->
                        </div><!-- tab-content-->
                    </div><!-- /.card-body -->

                </div><!-- /.card -->
            </div>
        </div>

    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script type="text/javascript">
  $(function(){

    $('#bookingsTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#picture_display').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#picture").change(function(){
        $('#picture_display').show();
        readURL(this);
    });

    $(document).on('submit', '.editPhotoForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#editPhotoForm'+id)[0]);

      $.ajax({
        url: "../includes/updatePhoto.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update photo. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "Photo has been successfully updated.",
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