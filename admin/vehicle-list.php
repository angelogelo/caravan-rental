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
					<div class="card-header">
						<div class="card-tools">
							<select class="form-control" id="selectFilter">
								<option value="0">-- Select Bodytype --</option>
								<?php
									$select = $connection->query("SELECT vehicle_category FROM tbl_vehicle GROUP BY vehicle_category");
									while($row = $select->fetch_array()){
								?>
									<option value="<?= $row['vehicle_category']; ?>"><?= $row['vehicle_category']; ?></option>
								<?php
									}
								?>
							</select>
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