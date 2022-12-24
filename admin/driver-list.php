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
                  <div class="card-header">
                    <div class="card-tools">
                      <select class="form-control" id="selectFilter">
                        <option value="0">-- Select Restriction Code --</option>
                        <option value="A">A - Motorcycle</option>
                        <option value="A1">A1 - TRICYCLE</option>
                        <option value="B">B - UP TO 5000 KGS GVW/8 SEATS</option>
                        <option value="B1">B1 - UP TO 5000 KGS GVW/9 SEATS</option>
                        <option value="B2">B2 - GOODS < 3500 KGS GVW</option>
                        <option value="C">C - GOODS > 3500 KGS GVW</option>
                        <option value="D">D - BUS > 5000 KGS GVW/9 OR MORE SEATS</option>
                        <option value="BE">BE - TRAILERS < 3500 KG</option>
                        <option value="CE">CE - ARTICULATED C > 3500 KGS COMBINED GVW</option>
                      </select>
                    </div>
                  </div>
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
                                        <th>Restriction Code</th>
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

                                        $select = $connection->query("SELECT driver_restriction FROM driver_restriction WHERE driver_id = '".$driver_row['id']."'");
                                        
                                        
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
                                        <td>
                                          <?php
                                            foreach($select as $res){
                                              echo $res['driver_restriction'];
                                              echo ", ";
                                            }    
                                          ?>
                                        </td>
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

    let tableSettings = {
        'paging': true,
        'iDisplayLength': 100,
        'ordering': true,
        'deferRender': true,
        'bserverSide': true, //still giving an error
        'retrieve': true
    };

    var table = $('#driverListTable').DataTable(tableSettings);

    $("#selectFilter").change(function () { 
        if (this.value == 0) {
          table.columns().search('').draw();
        } else {
          table.columns().columns(5).search(this.value).draw();
        }
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
      let url = "http://localhost/admin/driver-edit.php";
      window.location.href= url+"?id="+id+"&status="+value;  
      //alert(url);
  }

</script>