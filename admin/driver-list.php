<?php
    $page = 'driver-list';
    include 'header.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Driver List</h1>
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
                            <table id="driverListTable" class="table table-condensed table-hover table-sm text-sm">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort" >#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Contact No</th>
                                        <th>License No</th>
                                        <th>License Exp Date</th>
                                        <th>Date of Joining</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        <th style="width: 100px;">Update Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $number = 1;
                                      $driver = $connection->query("SELECT * FROM tbl_driver");
                                      while($driver_row = $driver->fetch_array()){
                                        
                                        if($driver_row['driver_status'] == 1){
                                          $status = '<span class="badge badge-success">Avaialable</span>';
                                        }else{
                                          $status = '<span class="badge badge-danger">Not Avaialable</span>';
                                        }

                                    ?>
                                    <tr>
                                        <td><?= $number++; ?></td>
                                        <td>
                                            <img src="../drivers-photo/<?php echo $driver_row['driver_photo']; ?>" class="profile-user-img img-fluid img-square" style="width: 50px;">
                                        </td>
                                        <td><?= $driver_row['driver_name']; ?></td>
                                        <td><?= $driver_row['contact_no']; ?></td>
                                        <td><?= $driver_row['license_no']; ?></td>
                                        <td><?= $driver_row['license_expiry']; ?></td>
                                        <td><?= $driver_row['date_joining']; ?></td>
                                        <td>
                                            <?= $status; ?>
                                        </td>
                                        <td>
                                          <button class="btn btn-success btn-xs view-driver" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $driver_row['id']; ?>"><i class="fas fa-eye"></i></button>
                                          <button class="btn btn-primary btn-xs edit-driver" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $driver_row['id']; ?>"><i class="fas fa-edit"></i></button>
                                          <button type="button" class="btn btn-danger btn-xs deleteDriver" data-id="<?php echo $driver_row['id']; ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <td>
                                          <select class="form-control form-control-border border-width-2 ml-10 form-control-sm text-sm" onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $driver_row['id'] ?>')" style="width: 125px;">
                                              <?php
                                                  if($driver_row['driver_status'] == 1){
                                              ?>
                                                  <option value="<?php echo $driver_row['driver_status']; ?>">Available</option>
                                                  <option value="2">Not Available</option>
                                              <?php
                                                  }else{
                                              ?>
                                                  <option value="<?php echo $driver_row['driver_status']; ?>">Not Available</option>
                                                  <option value="1">Available</option>
                                              <?php
                                                  }
                                              ?>
                                          </select>
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

    </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php' ?>

<script type="text/javascript">
  $(function(){

    $('#driverListTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      iDisplayLength: 25,
    });

    $(document).on('click', '.view-driver', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'drivers.php?id='+id;
    });

    $(document).on('click', '.edit-driver', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'driver-edit.php?id='+id;
    });

    $(document).on('click', '.deleteDriver', function() {
			var id = $(this).attr('data-id');
			swal({
				title: "Are you sure you want to delete this Driver?",
				text: "Driver related to this will be deleted as well. \n PROCEED WITH CAUTION!!!",
				icon: "info",
				buttons: {
					cancel: "Cancel",
					confirm: "Confirm"
				}
			}).then(function(event) {
				if (event == true) {
					$.ajax({
						url: "../includes/driver-delete.php",
						method: "POST",
						dataType: "TEXT",
						data: {
							id: id
						}, success: function(data) {
							console.log(data);
							if (data === "Deleted") {
								swal({
									title: "Driver has been deleted!",
									text: "You can't recover this deleted driver!",
									icon: "info"
								}).then(function() {
									location.reload();
								});
							} else {
								swal({
									title: "Failed to delete this Driver!",
									icon: "info"
								});
							}
						}
					})
				}
			});
		});

  });

  function status_update(value, id){
      //alert(id);
      let url = "http://127.0.0.1/caravan-rental/admin/driver-edit.php";
      window.location.href= url+"?id="+id+"&status="+value;  
      //alert(url);
  }

</script>