<?php
    $page = 'vehicles';
    include 'header.php';

    $id = $_GET['id'];
    $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '$id'");
    $vehicle_row = $vehicle->fetch_array();

    $picture = $connection->query("SELECT * FROM tbl_vehicle_photo WHERE vehicle_id = '$id'");
?>

<style>
    .list-group-item{
        padding:5px 15px;
    }

    ul{
        list-style: none outside none;
        padding-left: 0;
        margin: 0;
    }
    .demo .item{
        margin-bottom: 60px;
    }
    .content-slider li{
        background-color: #ed3020;
        text-align: center;
        color: #FFF;
    }
    .content-slider h3 {
        margin: 0;
        padding: 70px 0;
    }
    .demo{
        width: 1000px;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="nav-icon fas fa-car"></i> Vehicle Information</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            
        </div>

        <div class="row">
            <div class="col-lg-5">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Vehicle Photo</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ChangePhoto">
                                <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Photo Edit"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="col-lg-12 product-image-thumbs">
                            <?php
                                //$vehicle_picture = $connection->query("SELECT * FROM tbl_vehicle_photo WHERE vehicle_id = '$id'");
                                //while($vehicle_picture_row = $vehicle_picture->fetch_array()){
                            ?>
                            <div class="product-image-thumb">
                                <img src="../vehicles-photo/<?php //echo $vehicle_picture_row['vehicle_name']; ?>" alt="Product Image">
                            </div>
                            <?php //} ?>
                        </div> -->
                        
                        <div class="clearfix" style="max-width:474px;">
                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                <?php
                                    $vehicle_picture = $connection->query("SELECT * FROM tbl_vehicle_photo WHERE vehicle_id = '$id'");
                                    while($vehicle_picture_row = $vehicle_picture->fetch_array()){
                                ?>
                                <li class="text-center" data-thumb="../vehicles-photo/<?php echo $vehicle_picture_row['vehicle_name']; ?>"> 
                                    <img style='margin:0;width:100%; height:300px' src="../vehicles-photo/<?php echo $vehicle_picture_row['vehicle_name']; ?>" />
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card card-warning card-outline card-tabs">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item text-sm" >
                                <a class="nav-link active" href="#tab1" data-toggle="tab">Basic Info</a>
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
                                        <b>Vehicle Name</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['vehicle_name']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Seat Capacity</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['seat_capacity']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Year Model</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['year_model']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Manufactured By</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['manufactured_by']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Plate Number</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['plate_number']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Vehicle Color</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['vehicle_color']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Registration Expiry</b>
                                        <span class="float-right">
                                            <?= $vehicle_row['registration_expiry']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Regular Package</b>
                                        <span class="float-right">
                                            ₱ <?= $vehicle_row['regular_package']; ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Complete Package</b>
                                        <span class="float-right">
                                            ₱ <?= $vehicle_row['complete_package']; ?>
                                        </span>
                                    </li>
                                </ul>
                            </div><!-- tab-pane-->
                            <div class="tab-pane" id="tab2">
                                <table id="bookingsTable" class="table table-condensed table-hover table-sm text-sm">
                                    <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort" >#</th>
                                            <th>Driver</th>
                                            <th>Customer</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Booking Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $number = 1;
                                            $bookings = $connection->query("SELECT * FROM tbl_rents WHERE vehicle_id = '$id'");
                                            while($bookings_row = $bookings->fetch_array()){

                                                $customer = $connection->query("SELECT * FROM user WHERE id = '".$bookings_row['customer_id']."'");
                                                $customer_row = $customer->fetch_array();

                                                $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '".$bookings_row['vehicle_id']."'");
                                                $vehicle_row = $vehicle->fetch_array();

                                                $driver = $connection->query("SELECT * FROM tbl_driver WHERE id = '".$bookings_row['driver_id']."'");
                                                $driver_row = $driver->fetch_array();
                                        ?>
                                        <tr>
                                            <td><?= $number++; ?></td>
                                            <td><?= $driver_row['driver_name']; ?></td>
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


<div class="modal fade" id="ChangePhoto">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-info-circle"></i> Vehicle Photo List
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <table class="table table-sm text-sm">
                <thead>
                    <th>Picture</th>            
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                        $photo = $connection->query("SELECT * FROM tbl_vehicle_photo WHERE vehicle_id = '$id'");
                        $number = 1;
                        while($photo_row = $photo->fetch_array()){
                    ?>
                    <tr>
                        <td>
                        <?php
                            if ($photo_row['vehicle_name'] == "none" || $photo_row['vehicle_name'] == NULL) {
                        ?>
                        <?php
                            }else{
                        ?>
                            <img src="../vehicles-photo/<?php echo $photo_row['vehicle_name']; ?>" class="img-fluid rounded" style="width: 50px; height: 50px; margin-right: auto; margin-left: auto; display: block;">
                        <?php
                            }
                        ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editPhoto<?php echo $photo_row['id']; ?>">
                                <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to Edit"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editPhoto<?php echo $photo_row['id']; ?>">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <i class="fas fa-info-circle"></i> Change Photo
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST" class="editPhotoForm" id="editPhotoForm<?php echo $photo_row['id']; ?>" data-id="<?php echo $photo_row['id']; ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" name="file" id="file" class="custom-file-input form-control-sm" accept="image/*">
                                                    <label class="custom-file-label">Choose File</label>
                                                </div>
                                            </div>      
                                        </div>
                                    </div><!--modal-body-->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="update_id" value="<?= $photo_row['id']; ?>">
                                        <button type="submit" name="submit" class="btn btn-success btn-sm">Update</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <?php } ?>
                </tbody>
            </table>

        </div><!--modal-body-->
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






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

<script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:<?php echo $picture->num_rows; ?>,
                slideMargin: 0,
                speed:1000,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});
    </script>