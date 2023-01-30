<?php
    $page = 'vehicle-maintainability';
    include 'header.php';
?>

<style>
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
        <h1 class="m-0">Vehicle Name</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-warning">
                      <div class="card-header">
                        <div class="card-tools">
                          <button class="btn btn-outline-warning" data-toggle="modal" data-target="#add-modal"><i class="fas fa-plus"></i>  Add Vehicle Name</button>
                        </div>
                      </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="vehicleTable" class="table table-condensed table-hover table-sm text-sm">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort" >#</th>
                                        <th>Make</th>
                                        <th>Vehicle</th>
                                        <th>Body Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $number = 1;
                                    $maint = $connection->query("SELECT * FROM tbl_vehicle_maintainability");
                                    while($maint_row = $maint->fetch_array()){
                                  ?>
                                  <tr>
                                      <td><?= $number++; ?></td>
                                      <td><?= $maint_row['make']; ?></td>
                                      <td><?= $maint_row['vehicle']; ?></td>
                                      <td><?= $maint_row['body_type']; ?></td>
                                      <td>
                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal<?= $maint_row['id']; ?>" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-xs deleteMainti" data-id="<?php echo $maint_row['id']; ?>"><i class="fa fa-trash"></i></button>
                                      </td>
                                  </tr>

                                  <div class="modal fade" id="editModal<?= $maint_row['id']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Vehicle Name </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST" class="editMaintiForm" id="editMaintiForm<?= $maint_row['id']; ?>" data-id="<?= $maint_row['id']; ?>" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                      <div class="col-lg-12">
                                                        <div class="form-group">
                                                          <label for="">Make</label>    
                                                          <input type="text" class="form-control form-control-sm" name="make" value="<?= $maint_row['make']; ?>">
                                                        </div>
                                                      </div>

                                                      <div class="col-lg-12">
                                                        <div class="form-group">
                                                          <label for="">Vehicle</label>
                                                          <input type="text" class="form-control form-control-sm" name="vehicle" value="<?= $maint_row['vehicle']; ?>">
                                                        </div>
                                                      </div>

                                                      <div class="col-lg-12">
                                                        <div class="form-group">
                                                          <label><b>Body Type</b></label>
                                                          <select name="body_type" class="form-control form-control-sm">
                                                              <option>--- Select Body Type ---</option>
                                                              <option value="SUV">SUV</option>
                                                              <option value="VAN">VAN</option>
                                                          </select>
                                                        </div>
                                                      </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <input type="hidden" name="update_id" value="<?= $maint_row['id']; ?>">
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                                                </div>
                                            </form>
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
            </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<div class="modal fade" id="add-modal">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Vehicle Name </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="" method="POST" enctype="multipart/form-data" id="vehicleAddForm">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="">Make</label>
                        <input type="text" class="form-control form-control-sm" name="make">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="">Vehicle</label>
                        <input type="text" class="form-control form-control-sm" name="vehicle">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="form-group">
                        <label><b>Body Type</b></label>
                        <select name="body_type" class="form-control form-control-sm">
                            <option>--- Select Body Type ---</option>
                            <option value="SUV">SUV</option>
                            <option value="VAN">VAN</option>
                        </select>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success btn-sm">Save changes</button>
              </div>
          </form>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include 'footer.php' ?>

<script type="text/javascript">
  $(function(){

    $('#vehicleTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      iDisplayLength: 25,
    });

    $('#vehicleAddForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "../includes/vehicle-maintainability-add.php",
            method: "POST",
            dataType: "TEXT",
            contentType: false,
            processData: false,
            data: formData,
            success: function(data){
            console.log(data);
                if (data === "Failed") {
                    swal({
                        title: "Failed to add new vehicle maintainability. Please try again later.!",
                        icon: "info"
                    });
                }else if (data === "Exist") {
                    swal({
                        title: "Vehicle Name Has Been Exist!",
                        icon: "info"
                    });
                }else {
                    swal({
                        title: "Vehicle Name has been added!",
                        icon: "success"
                    }).then(function() {
                        location.reload();
                    });
                }
            }
        })
    });

    $(document).on('submit', '.editMaintiForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#editMaintiForm'+id)[0]);

      $.ajax({
        url: "../includes/vehicle-mainti-edit.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Nothing to Update") {
            swal({
              title: "No information to be updated.",
              icon: "warning"
            });
          }else if (data == "Failed") {
            swal({
              title: "Failed to add edit Name. Please try again later.",
              icon: "error"
            });
          }else {
            swal({
              title: "Vehicle Name has updated.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    $(document).on('click', '.deleteMainti', function() {
			var id = $(this).attr('data-id');
			swal({
				title: "Are you sure you want to delete this Vehicle Name?",
				text: "Vehicle related to this will be deleted as well. \n PROCEED WITH CAUTION!!!",
				icon: "info",
				buttons: {
					cancel: "Cancel",
					confirm: "Confirm"
				}
			}).then(function(event) {
				if (event == true) {
					$.ajax({
						url: "../includes/vehicle-mainti-delete.php",
						method: "POST",
						dataType: "TEXT",
						data: {
							id: id
						}, success: function(data) {
							console.log(data);
							if (data === "Deleted") {
								swal({
									title: "Vehicle Maintainability has been deleted!",
									text: "You can't recover this deleted vehicle!",
									icon: "info"
								}).then(function() {
									location.reload();
								});
							} else {
								swal({
									title: "Failed to delete this Vehicle Maintainability!",
									icon: "info"
								});
							}
						}
					})
				}
			});
		});

  });
</script>