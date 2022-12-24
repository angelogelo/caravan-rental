<?php
    $page = 'vehicles';
    include 'header.php';

    $id = $_GET['id'];
    $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '$id'");
    $vehicle_row = $vehicle->fetch_array();

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Vehicle</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
    <form action="" method="POST" enctype="multipart/form-data" id="vehicleEditForm">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center">
                                    <img id="picture_display" src="../vehicles-photo/<?php echo $vehicle_row['vehicle_photo']; ?>" class="img-fluid rounded" style="width: 200px;">    
                                </li>
                                <li class="list-group-item">
                                    <label>Upload Vehicle Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="vehicle_photo" id="picture" class="custom-file-input form-control-sm" accept="image/*" multiple>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                        <div class="card card-warning card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="h6"><b>Transmission</b></p>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="vehicle_transmission" id="transAuto" class="custom-control-input" value="Automatic" <?php echo ($vehicle_row['vehicle_transmission'] == 'Automatic') ? 'checked' : null; ?> required>
                                                <label class="custom-control-label" for="transAuto">Automatic</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="vehicle_transmission" id="transManual" class="custom-control-input" value="Manual" <?php echo ($vehicle_row['vehicle_transmission'] == 'Manual') ? 'checked' : null; ?> required>
                                                <label class="custom-control-label" for="transManual">Manual</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span><b>Status</b></span>
                                            <select class="form-control form-control-sm" name="status" required>
                                                <option >-- Select Status --</option>
                                                <option value="0">Available</option>
                                                <option value="1">On Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span><b>Registration Expiry Date</b></span>
                                            <input type="date" name="registration_expiry" value="<?= $vehicle_row['registration_expiry']; ?>" class="form-control form-control-sm" placeholder="Enter Registration Expiry Date">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <span><b>Regular Package</b></span>
                                        <input type="text" name="regular_package" value="<?= $vehicle_row['regular_package']; ?>" class="form-control form-control-sm number-format" placeholder="0" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <span><b>Complete Package</b></span>
                                        <input type="text" name="complete_package" value="<?= $vehicle_row['complete_package']; ?>" class="form-control form-control-sm number-format" placeholder="0" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span><b>Vehicle Name</b></span>
                                            <input type="text" name="vehicle_name" value="<?= $vehicle_row['vehicle_name']; ?>" class="form-control form-control-sm" placeholder="Enter Vehicle Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span><b>Model</b></span>
                                            <input type="number" name="year_model" value="<?= $vehicle_row['year_model']; ?>" class="form-control form-control-sm" placeholder="Enter Year Model">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span><b>Seat Capacity</b></span>
                                            <input type="number" name="seat_capacity" value="<?= $vehicle_row['seat_capacity']; ?>" class="form-control form-control-sm" placeholder="Enter Seat Capacity">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span><b>Make</b></span>
                                            <input type="text" name="manufactured_by" value="<?= $vehicle_row['manufactured_by']; ?>" class="form-control form-control-sm" placeholder="Enter Manufactured By">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span><b>Vehicle Plate Number</b></span>
                                            <input type="text" name="plate_number" value="<?= $vehicle_row['plate_number']; ?>" class="form-control form-control-sm" placeholder="Enter Vehicle Plate Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <span><b>Vehicle Color</b></span>
                                            <input type="text" name="vehicle_color" value="<?= $vehicle_row['vehicle_color']; ?>" class="form-control form-control-sm" placeholder="Enter Vehicle Color">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" value="<?= $id; ?>" name="vehicle_id">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> | Update Vehicle</button>
                            </div>

                        </div><!-- /.card -->
                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </form><!-- /.form -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php' ?>
<script>
    $(function(){

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

        $('#vehicleEditForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/vehicle-edit.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                console.log(data);
                    if (data === "Failed") {
                        swal({
                            title: "Failed to edit vehicle. Please try again later.!",
                            icon: "info"
                        });
                    }else if (data === "Exist") {
                        swal({
                            title: "Vehicle Has Been Exist!",
                            icon: "info"
                        });
                    }else {
                        swal({
                            title: "Vehicle has been updated!",
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