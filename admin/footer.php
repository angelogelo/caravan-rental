</div><!-- /.content-wrapper -->
	  <!-- Main Footer -->
	  <footer class="main-footer">
	    <!-- To the right -->
	    <!-- <div class="float-right d-none d-sm-inline">
	      Anything you want
	    </div> -->
	    <!-- Default to the left -->
	    <strong></strong>
	  </footer>
	</div>
	<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- Sweetalert -->
<script src="../assets/sweetalert/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<script src="../assets/chart.js/Chart.js"></script>
<script src="../assets/lightslider/src/js/lightslider.js"></script>
<!-- Select2 -->
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
</body>
</html>

<script>
	$(function(){

		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
		theme: 'bootstrap4'
		})

		$('#logoutButton').click(function(){
          var type = $(this).attr('data-type');
          if (type == "admin") {
            return window.location.replace('../includes/logout.php');

          }else {
            return window.location.replace('../includes/logout.php');
          }
        });

	});
</script>
