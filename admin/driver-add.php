<?php
    $page = 'driver-add';
    include 'header.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Driver</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data" id="driverAddForm"> 
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center">
                                    <img id="picture_display" class="img-fluid rounded" src="#" style="display: none;">
                                </li>
                                <li class="list-group-item">
                                    <label>Upload Driver Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="driver_photo" id="picture" class="custom-file-input form-control-sm" accept="image/*" multiple required>
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
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Driver Name</b></span>
                                        <input type="text" name="driver_name" class="form-control form-control-sm" placeholder="Enter Driver Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Contact No.</b></span>
                                        <input type="text" pattern="\d*" name="contact_no" class="form-control form-control-sm" placeholder="Enter Contact No" maxlength="11" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Birthdate</b></span>
                                        <input type="date" name="birthdate" class="form-control form-control-sm" placeholder="Enter Year Model" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>License No</b></span>
                                        <input type="text" name="license_no" class="form-control form-control-sm" placeholder="Enter License No" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>License Expiry Date</b></span>
                                        <input type="date" name="license_expiry" class="form-control form-control-sm" placeholder="Enter Engine No" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Total Experience</b></span>
                                        <input type="number" name="total_exp" class="form-control form-control-sm" placeholder="Enter Total Experience" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Address</b></span>
                                        <textarea class="form-control form-control-sm" name="address" id="" rows="4" placeholder="Address......" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>License Restriction</b></span>
                                        <input type="text" name="license_restriction" class="form-control form-control-sm" placeholder="Enter License Resctriction" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Date of Joining</b></span>
                                        <input type="date" name="date_joining" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> | Add Driver</button>
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

        $('#driverAddForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/driver-add.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                console.log(data);
                    if (data === "Failed") {
                        swal({
                            title: "Failed to add new driver. Please try again later.!",
                            icon: "info"
                        });
                    }else if (data === "Exist") {
                        swal({
                            title: "Driver has been Exist!",
                            icon: "info"
                        });
                    }else {
                        swal({
                            title: "Driver has been added!",
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