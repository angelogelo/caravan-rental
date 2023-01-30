<?php
    require_once "db.php";
    
    $result = mysqli_query($link, "SELECT * FROM annc_tbl WHERE archived = 0 ORDER BY date_uploaded DESC LIMIT 6");
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jsonresult[] = $row;
        }
        print(json_encode($jsonresult));
    } else {
        echo "no record";
    }
    
    mysqli_close($link);

?>