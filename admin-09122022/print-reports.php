<?php

    include '../includes/connection.php';
    $vehicle_id = $_GET['vehicle_id'];

    $vehicle = $connection->query("SELECT * FROM tbl_vehicle WHERE id = '$vehicle_id'");
    $vehicle_row = $vehicle->fetch_array();

    $startDate = $_GET['start'];
    $date = date('F j, Y', strtotime($startDate));
    $start_date = $date;


    $endDate = $_GET['end'];
    $endDate = $endDate." 23:59:59";
    $format = date('F j, Y', strtotime($endDate));
    $end_date = $format;

    $rent = $connection->query("SELECT * FROM tbl_rents WHERE vehicle_id = '$vehicle_id' AND ((booking_date >= '$start_date') AND (booking_date <= '$end_date'))");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Reports</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Logo -->
    <link rel="icon" href="../assets/images/caravan.png">
</head>
<body onafterprint="closeWindow()">
    <br><br>
    <div class="container">

    <div class="form-group row">
      <div class="col-md-12 text-center">
        <h3><b><?php echo $vehicle_row['vehicle_name']; ?></b></h3>
      </div>
    </div>

        <div class="row">
            <div class="form-group">
                <h6>Date: <?php echo $start_date; ?> - <?php echo $end_date; ?></h6>
            </div>

            <table class="table table-hover table-striped">
                <thead class="bg-success text-white">
                  <tr>
                    <th>#</th>
                    <th>Vehicle ID</th>
                    <th>Vehicle Name</th>
                    <th>Total Amount</th>
                    <th>Booking Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php

                    $startDate = $_GET['start'];
                    $date = date('d-m-Y H:i:s', strtotime($startDate));
                    $start_date = $date;


                    $endDate = $_GET['end'];
                    $endDate = $endDate." 23:59:59";
                    $format = date('d-m-Y H:i:s', strtotime($endDate));
                    $end_date = $format;

                    $number = 1;
                    $vehicle_id = $_GET['vehicle_id'];
                    $rent = $connection->query("SELECT * FROM tbl_rents WHERE vehicle_id = '$vehicle_id' AND ((booking_date >= '$start_date') AND (booking_date <= '$end_date'))");
                    while($rent_row = $rent->fetch_array()){
                ?>
                <tr>
                    <td><?= $number++; ?></td>
                    <td><?= $vehicle_row['vehicle_name']; ?></td>
                    <td><?= $rent_row['total_amount']; ?></td>
                    <td><?= $rent_row['package_type']; ?></td>
                    <td><?= $rent_row['booking_date']; ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // setTimeout(function() {
        // window.print();
        // }, 1000);
        
        // function closeWindow() {
        // window.close();
        // }
    </script>
</body>
</html>