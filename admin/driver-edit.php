<?php
    $page = 'driver-edit';
    include 'header.php';

    $id = $_GET['id'];
    $driver = $connection->query("SELECT * FROM tbl_driver WHERE id = '$id'");
    $driver_row = $driver->fetch_array();
   
    if($_GET['id']){

        $driver_id = $_GET['id'];

        $fetchquery = "SELECT driver_restriction FROM driver_restriction WHERE driver_id = '$driver_id'";
        $fetchquery_run = mysqli_query($connection, $fetchquery);
        
        $dri_res = [];
        
        foreach($fetchquery_run as $fetchrow){
            $dri_res[] = $fetchrow['driver_restriction'];
        }
    }
?>

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border: 1px solid #007bff;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Driver</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data" id="driverEditForm">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center">
                                    <img id="picture_display" src="../drivers-photo/<?php echo $driver_row['driver_photo']; ?>" class="img-fluid rounded" style="width: 200px;">    
                                </li>
                                <li class="list-group-item">
                                    <label>Upload Driver Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="driver_photo" id="picture" class="custom-file-input form-control-sm" accept="image/*" multiple>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-warning card-outline">
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Update Status</b></span>
                                        
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Driver Name</b></span>
                                        <input type="text" name="driver_name" class="form-control form-control-sm" placeholder="Enter Driver Name" value="<?= $driver_row['driver_name']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Contact No.</b></span>
                                        <input type="number" name="contact_no" class="form-control form-control-sm" placeholder="Enter Contact No" value="<?= $driver_row['contact_no']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Birthdate</b></span>
                                        <input type="date" name="birthdate" class="form-control form-control-sm" value="<?= $driver_row['birthdate']; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>License No</b></span>
                                        <input type="text" name="license_no" class="form-control form-control-sm" placeholder="Enter License No" value="<?= $driver_row['license_no']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>License Expiry Date</b></span>
                                        <input type="date" name="license_expiry" class="form-control form-control-sm" value="<?= $driver_row['license_expiry']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Total Experience</b></span>
                                        <input type="number" name="total_exp" class="form-control form-control-sm" placeholder="Enter Total Experience" value="<?= $driver_row['total_exp']; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <span><b>Restriction Code</b></span>
                                        <!-- <input type="text" name="license_restriction" class="form-control form-control-sm" placeholder="Enter License Resctriction" required> -->
                                        <select name="license_restriction[]" class="form-control form-control-sm select2" data-placeholder="--- Select Restriction ---" required multiple style="width: 100%;">
                                            <?php
                                                $select = "SELECT * FROM tbl_restriction";
                                                $query_run = mysqli_query($connection, $select);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $row){
                                                        ?>
                                                            <option value="<?= $row['res_code'] ?>" <?= in_array($row['res_code'], $dri_res) ? 'selected':'' ?> ><?= $row['res_code'] ?> - <?= $row['res_details'] ?></option>
                                                        <?php
                                                    }
                                                }else{
                                                    
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Date of Joining</b></span>
                                        <input type="date" name="date_joining" class="form-control form-control-sm" value="<?= $driver_row['date_joining']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span><b>Address</b></span>
                                        <textarea class="form-control form-control-sm" name="address" id="" rows="4" placeholder="Address......" required> <?= $driver_row['address']; ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" value="<?= $id; ?>" name="driver_id">
                            <button type="submit" class="btn btn-primary btn-sm">Update Driver</button>
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

        $('#driverEditForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/driver-edit.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                console.log(data);
                    if (data === "Failed") {
                        swal({
                            title: "Failed to edit driver. Please try again later.!",
                            icon: "info"
                        });
                    }else if (data === "Exist") {
                        swal({
                            title: "Driver Has Been Exist!",
                            icon: "info"
                        });
                    }else {
                        swal({
                            title: "Driver Information has been updated!",
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