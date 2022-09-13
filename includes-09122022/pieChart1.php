<?php

    include '../includes/connection.php';

    $rents = $connection->query("SELECT * FROM tbl_rents WHERE status = 'Approved'");
    $total_rents = $rents->num_rows;

    // $select_on_rent = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 'On Rent'");
    // $on_rent = $select_on_rent->num_rows;

    // $sql="SELECT * FROM tbl_vehicle";
	// $query=$connection->query($sql);
	// $vehicle = $query->num_rows;

?>