<?php
    $page = 'driver-archived';
    include 'header.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Driver Archived</h1>
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
                                        <th>Restriction Code</th>
                                        <th>License Exp Date</th>
                                        <th>Date of Joining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $number = 1;
                                      $driver = $connection->query("SELECT * FROM tbl_driver WHERE driver_status = 0 ORDER BY id DESC");
                                      while($driver_row = $driver->fetch_array()){

                                        $select = $connection->query("SELECT driver_restriction FROM driver_restriction WHERE driver_id = '".$driver_row['id']."'");
                                        
                                        
                                        if($driver_row['driver_status'] == 1){
                                          $status = '<span class="badge badge-success">Avaialable</span>';
                                        }elseif($driver_row['driver_status'] == 2){
                                          $status = '<span class="badge badge-danger">Not Avaialable</span>';
                                        }else{
                                            
                                        }

                                    ?>
                                    <tr class="deleteDriver" data-id="<?php echo $driver_row['id']; ?>">
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
				title: "Are you sure you want to unarchive this Driver?",
				icon: "info",
				buttons: {
					cancel: "Cancel",
					confirm: "Confirm"
				}
			}).then(function(event) {
				if (event == true) {
					$.ajax({
						url: "../includes/driver-delete-2.php",
						method: "POST",
						dataType: "TEXT",
						data: {
							id: id
						}, success: function(data) {
							console.log(data);
							if (data === "Deleted") {
								swal({
									title: "Driver has been unarchived!",
									icon: "info"
								}).then(function() {
									location.reload();
								});
							} else {
								swal({
									title: "Failed to unarchived this Driver!",
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
      let url = "https://caravan-rental-cars.online//admin/driver-edit.php";
      window.location.href= url+"?id="+id+"&status="+value;  
      //alert(url);
  }

</script>