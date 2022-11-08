<?php
    $page = 'vehicle-add';
    include 'header.php';
?>

<style>
    /* #preview{
      display: flex;
      width: 200px;
      height: 200px;
      border: 1px solid black;
      margin-top: -15px;
      flex-wrap: wrap;
      overflow-y: scroll;
    } */
    #preview img{
      width: 40%;
      height: 40%;
      margin-left: 5px;
      margin-right: 5px;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> Add Vehicle</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data" id="vehicleAddForm">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center">
                                    <img id="picture_display" class="img-fluid rounded" src="#" style="display: none; width: 40%; height: 40%;">
                                </li>
                                <li class="list-group-item">
                                    <label>Upload Display Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="single_photo" id="picture" class="custom-file-input form-control-sm" accept="image/*" required>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <label>Upload More Vehicle Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control-sm" name="vehicle_photo[]" id="fileImg" accept="image/*" required multiple onchange="preview();">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-lg-8">
                    <div class="card card-warning card-outline">
                        <div class="card-body">
                            <div id="preview">
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-warning card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p class="h6"><b>Transmission</b></p>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="vehicle_transmission" id="transAuto" class="custom-control-input" value="Automatic" required>
                                            <label class="custom-control-label" for="transAuto">Automatic</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="vehicle_transmission" id="transManual" class="custom-control-input" value="Manual" required>
                                            <label class="custom-control-label" for="transManual">Manual</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Category</b></span>
                                        <select name="vehicle_category" class="form-control form-control-sm">
                                            <option>--- Select Category ---</option>
                                            <option value="SUV">SUV</option>
                                            <option value="VAN">VAN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span><b>Registration Expiry Date</b></span>
                                        <input type="date" name="registration_expiry" id="disableDate" class="form-control form-control-sm" placeholder="Enter Registration Expiry Date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <span><b>Regular Package</b></span>
                                    <input type="text" name="regular_package" class="form-control form-control-sm number-format" placeholder="0" required>
                                </div>
                                <div class="col-lg-4">
                                    <span><b>Complete Package</b></span>
                                    <input type="text" name="complete_package" class="form-control form-control-sm number-format" placeholder="0" required>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <span><b>Rental Price</b></span>
                                        <input type="number" name="price" class="form-control form-control-sm" placeholder="Enter Rental Price" required>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Vehicle Name</b></span>
                                        <input type="text" name="vehicle_name" class="form-control form-control-sm" placeholder="Enter Vehicle Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Model</b></span>
                                        <input type="number" name="year_model" class="form-control form-control-sm" placeholder="Enter Year Model" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Seat Capacity</b></span>
                                        <input type="number" name="seat_capacity" class="form-control form-control-sm" placeholder="Enter Seat Capacity" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Manufactured By</b></span>
                                        <input type="text" name="manufactured_by" class="form-control form-control-sm" placeholder="Enter Manufactured By" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Vehicle Plate Number</b></span>
                                        <input type="text" name="plate_number" class="form-control form-control-sm" placeholder="Enter Vehicle Plate Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span><b>Vehicle Color</b></span>
                                        <input type="text" name="vehicle_color" class="form-control form-control-sm" placeholder="Enter Vehicle Color" required>
                                    </div>
                                </div>
                            </div><!-- /.row-->
                            <!-- <div class="row">
                                <div class="col-lg-2">
                                    <span><b>Regular Package</b></span>
                                    <input type="number" name="regular_package" class="form-control form-control-sm" placeholder="0" required>
                                </div>
                                <div class="col-lg-2">
                                    <span><b>Complete Package</b></span>
                                    <input type="number" name="complete_package" class="form-control form-control-sm" placeholder="0" required>
                                </div>
                            </div> -->
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> | Add Vehicle</button>
                        </div>
                    </div><!-- /.card -->
                </div><!-- /.col -->

            </div><!-- /.row -->
        </form><!-- /.form -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php' ?>

<script type="text/javascript">

    function preview(){
        var totalFiles = $('#fileImg').get(0).files.length;
        for(var i = 0; i < totalFiles; i++){
          $('#preview').append("<img src = '"+URL.createObjectURL(event.target.files[i])+"'>");
        }
      }

</script>

<script>
    $(function(){

        bsCustomFileInput.init();

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

        $('#vehicleAddForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/vehicle-add.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                console.log(data);
                    if (data === "Failed") {
                        swal({
                            title: "Failed to add new vehicle. Please try again later.!",
                            icon: "info"
                        });
                    }else if (data === "Exist") {
                        swal({
                            title: "Vehicle Has Been Exist!",
                            icon: "info"
                        });
                    }else {
                        swal({
                            title: "Vehicle has been added!",
                            icon: "success"
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            })
        });

        $('input.number-format').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }
            $(this).val(function(index, value) {
                value = value.replace(/,/g,'');
                return numberWithCommas(value);
            });
        });

        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        //disable past date
        var dtToday = new Date();
    
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;

        $('#disableDate').attr('min', maxDate);


    });
</script>