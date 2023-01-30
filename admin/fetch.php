<?php

    include '../includes/connection.php';
    
    $k = $_POST['x'];
    $select = $connection->query("SELECT * FROM tbl_vehicle_maintainability WHERE vehicle = '".$k."'");
    while($row = $select->fetch_array()){
            $data['make'] = $row['make'];
            $data['body'] = $row['body_type'];
    }

    echo json_encode($data);
?>