<?php
    $page = 'vehicle-list';
    include 'header.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Vehicle List</h1>
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
                    <div class="card-header border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">SUV</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Van</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Cancelled</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                          <div class="table-responsive">
                              <table id="suvTable" class="table table-condensed table-hover table-sm text-sm">
                                  <thead>
                                      <tr>
                                          <th class="table-plus datatable-nosort" >#</th>
                                          <th>Photo</th>
                                          <th>Count</th>
                                          <th>Vehicle Name</th>
                                          <th>Transmission</th>
                                          <th>Model</th>
                                          <th>Registration Expiry</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $number = 1;
                                        $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_category = 'SUV'");
                                        while($vehicle_row = $vehicle->fetch_array()){

                                        if($vehicle_row['vehicle_status'] == 0){
                                          $status = '<span class="right badge badge-success">Available</span>';
                                        }else{
                                          $status = '<span class="right badge badge-danger">On Rent</span>';
                                        }
                                        $vehicle_id = $vehicle_row['id'];
                                        $count_vehicle = $connection->query("SELECT * FROM tbl_rents WHERE vehicle_id = '".$vehicle_id."'");
                                      ?>
                                      <tr>
                                          <td><?= $number++; ?></td>
                                          <td>
                                            <img src="../vehicles-photo/<?php echo $vehicle_row['vehicle_photo']; ?>" class="profile-user-img img-fluid img-square" style="width: 50px;">
                                          </td>
                                          <td><?= $count_vehicle->num_rows; ?></td>
                                          <td><?= $vehicle_row['vehicle_name']; ?></td>
                                          <td><?= $vehicle_row['vehicle_transmission']; ?></td>
                                          <td><?= $vehicle_row['year_model']; ?></td>
                                          <td><?= $vehicle_row['registration_expiry']; ?></td>
                                          <td><?= $status; ?></td>
                                          <td>
                                            <button class="btn btn-success btn-xs view-vehicle" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary btn-xs edit-vehicle" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs deleteVehicle" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fa fa-trash"></i></button>
                                          </td>
                                      </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                          <div class="table-responsive">
                              <table id="vanTable" class="table table-condensed table-hover table-sm text-sm">
                                  <thead>
                                      <tr>
                                          <th class="table-plus datatable-nosort" >#</th>
                                          <th>Photo</th>
                                          <th>Count</th>
                                          <th>Vehicle Name</th>
                                          <th>Transmission</th>
                                          <th>Model</th>
                                          <th>Registration Expiry</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $number = 1;
                                        $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_category = 'Van'");
                                        while($vehicle_row = $vehicle->fetch_array()){

                                        if($vehicle_row['vehicle_status'] == 0){
                                          $status = '<span class="right badge badge-success">Available</span>';
                                        }else{
                                          $status = '<span class="right badge badge-danger">On Rent</span>';
                                        }
                                        $vehicle_id = $vehicle_row['id'];
                                        $count_vehicle = $connection->query("SELECT * FROM tbl_rents WHERE vehicle_id = '".$vehicle_id."'");
                                      ?>
                                      <tr>
                                          <td><?= $number++; ?></td>
                                          <td>
                                            <img src="../vehicles-photo/<?php echo $vehicle_row['vehicle_photo']; ?>" class="profile-user-img img-fluid img-square" style="width: 50px;">
                                          </td>
                                          <td><?= $count_vehicle->num_rows; ?></td>
                                          <td><?= $vehicle_row['vehicle_name']; ?></td>
                                          <td><?= $vehicle_row['vehicle_transmission']; ?></td>
                                          <td><?= $vehicle_row['year_model']; ?></td>
                                          <td><?= $vehicle_row['registration_expiry']; ?></td>
                                          <td><?= $status; ?></td>
                                          <td>
                                            <button class="btn btn-success btn-xs view-vehicle" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary btn-xs edit-vehicle" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs deleteVehicle" data-id="<?php echo $vehicle_row['id']; ?>"><i class="fa fa-trash"></i></button>
                                          </td>
                                      </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                        </div>
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

    $('#suvTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      iDisplayLength: 25,
    });

    $('#vanTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      iDisplayLength: 25,
    });

    $(document).on('click', '.view-vehicle', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'vehicles.php?id='+id;
    });

    $(document).on('click', '.edit-vehicle', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'vehicle-edit.php?id='+id;
    });

    $(document).on('click', '.deleteVehicle', function() {
			var id = $(this).attr('data-id');
			swal({
				title: "Are you sure you want to delete this Vehicle?",
				text: "Vehicle related to this will be deleted as well. \n PROCEED WITH CAUTION!!!",
				icon: "info",
				buttons: {
					cancel: "Cancel",
					confirm: "Confirm"
				}
			}).then(function(event) {
				if (event == true) {
					$.ajax({
						url: "../includes/vehicle-delete.php",
						method: "POST",
						dataType: "TEXT",
						data: {
							id: id
						}, success: function(data) {
							console.log(data);
							if (data === "Deleted") {
								swal({
									title: "Vehicle has been deleted!",
									text: "You can't recover this deleted vehicle!",
									icon: "info"
								}).then(function() {
									location.reload();
								});
							} else {
								swal({
									title: "Failed to delete this Vehicle!",
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