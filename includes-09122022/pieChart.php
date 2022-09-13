<?php

    include '../includes/connection.php';

    $select_available = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 0");
    $available = $select_available->num_rows;

    $select_on_rent = $connection->query("SELECT * FROM tbl_vehicle WHERE vehicle_status = 1");
    $on_rent = $select_on_rent->num_rows;

    $rents = $connection->query("SELECT * FROM tbl_rents WHERE rent_status = 'Approved'");
    $total_rents = $rents->num_rows;

    $customer = $connection->query("SELECT * FROM tbl_rents");
    $total_customer = $customer->num_rows;

?>