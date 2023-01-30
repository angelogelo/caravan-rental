<?php
    $page = 'dashboard';
    include 'header.php';

    //chart for availability of vehicle
    $select_available = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 0");
    $available = $select_available->num_rows;

    $select_on_rent = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 1");
    $on_rent = $select_on_rent->num_rows;
?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php $driver = $connection->query("SELECT * FROM tbl_driver"); ?>
                        <h3><?= $driver->num_rows; ?></h3>
                        <p>Total Drivers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <?php $customer = $connection->query("SELECT * FROM tbl_rents"); ?>
                        <h3><?= $customer->num_rows; ?></h3>
                        <p>Total Customers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <?php $bookings = $connection->query("SELECT * FROM tbl_rents"); ?>
                        <h3><?= $bookings->num_rows; ?></h3>
                        <p>Total of Bookings</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-light">
                    <div class="inner">
                        <?php 
                            $total = $connection->query("SELECT SUM(amount) as `total_amount` FROM tbl_payment WHERE status = 1");
                            $count = $total->fetch_array();
                        ?>
                        
                            <?php
                                if($count['total_amount'] > 1){
                            ?>
                               <h3>
                                    <?= number_format($count['total_amount'], 2);"." ?>
                                </h3>
                            <?php
                                }else{
                            ?>
                                <h3>0</h3>
                            <?php } ?>
                            
                        
                        <p>Total Earnings this Month</p>
                    </div>
                    <div class="icon">
                        <i class="fas">₱</i>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Availability of Vehicle</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">User and Renter</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline card-warning">
                    <div class="card-body">
                        <table id="locationTable" class="table table-bordered table-hover text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>Destination</th>
                                    <th class="no-sort">Total (Bookings in this Area)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $location = $connection->query("SELECT * FROM tbl_location");
                                    while($location_row = $location->fetch_array()){
                                        $locate = $location_row['location'];
                                        $rent_location = $connection->query("SELECT * FROM tbl_rents WHERE location = '$locate'");
                                ?>
                                    <tr>
                                        <td><?= $location_row['location']; ?></td>
                                        <td><?= $rent_location->num_rows; ?></td>
                                    </tr>
                                <?php   }   ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>
<?php //include '../includes/pieChart.php' ?>

<script>
  $(function () {
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : <?php echo $on_rent; ?>,
        color    : '#005069',
        highlight: '#005069',
        label    : 'On Rent'
      },
      {
        value    : <?php echo $available; ?>,
        color    : '#00D5A1',
        highlight: '#00D5A1',
        label    : 'Available Vehicle'
      },
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

    $('#locationTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        order: [[1, 'desc']],
    });

  });
</script>

<script>
    $(function(){

        var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
        {
            value    : <?php echo $total_renter; ?>,
            color    : '#76b5c5',
            highlight: '#76b5c5',
            label    : 'Total Renter'
        },
        {
            value    : <?php echo $total_customer; ?>,
            color    : '#e28743',
            highlight: '#e28743',
            label    : 'Total User'
        },
        ]
        var pieOptions     = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke    : true,
        //String - The colour of each segment stroke
        segmentStrokeColor   : '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth   : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps       : 100,
        //String - Animation easing effect
        animationEasing      : 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate        : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale         : false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive           : true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio  : true,
        //String - A legend template
        legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)

    });
</script>